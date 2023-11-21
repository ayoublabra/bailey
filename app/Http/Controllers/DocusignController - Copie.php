<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DocuSign\eSign\Configuration;
use DocuSign\eSign\Api\EnvelopesApi;
use DocuSign\eSign\Client\ApiClient;
use Exception;
use Session;
use DocuSign\eSign\Api\AccountsApi;
use DocuSign\eSign\Api\BulkEnvelopesApi;
use DocuSign\eSign\Api\GroupsApi;
use DocuSign\eSign\Api\TemplatesApi;
use DocuSign\eSign\Client\ApiException;
use DocuSign\eSign\Model\RecipientViewRequest;
use DocuSign\eSign\Model\CarbonCopy;
use DocuSign\eSign\Model\Document;
use DocuSign\eSign\Model\EnvelopeDefinition;
use DocuSign\eSign\Model\Signer;
use DocuSign\eSign\Client\Auth\OAuth;
use \DocuSign\eSign\ObjectSerializer;
use Firebase\JWT\JWT;
use DB;
use Carbon;
use Auth;
use App\Models\DigitalContract;
use App\Models\Contract;
use App\Models\Operator;
use DateTime;

class DocusignController extends Controller
{   
    private $signer_client_id = 1000; 

    private $args;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('docusign.connect');
    }

    public function connectDocusign()
    {
        $rsa_private_key=file_get_contents(storage_path("jwt/private.key"),true); 
        $expires_in = 60;

        if ((int)$expires_in > 60) {
            $expires_in = 60;
        }
        $now = time();

        $claim = [
            "iss"=> "a47b337d-6341-4bb0-b1e6-a11285361274",//cle d intergration //good
            // "sub"=> "c8b15191-8cf0-4cff-859a-bb5045036574",
            "sub"=> "030a0a2d-8bce-41e9-9645-869e3e6df793",
            "aud"=> "account.docusign.com",
            "iat"=> $now, 
            "exp"=> $now+86400,
            "scope"=> "signature impersonation" 
        ];


        $jwt = JWT::encode($claim, $rsa_private_key, 'RS256');
        // var_dump($jwt); die;
        $grant_type='urn:ietf:params:oauth:grant-type:jwt-bearer';
        $url = "https://account.docusign.com/oauth/token";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
        "Accept: application/json",
        "Content-Type: application/x-www-form-urlencoded",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $data = "assertion=".$jwt."&grant_type=".$grant_type;
        
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);
        curl_close($curl);

        // dd($resp);

        return json_decode($resp);
    }

    public function callback(Request $request)
    {
        $code = $request->code;
        $client_id = "a47b337d-6341-4bb0-b1e6-a11285361274";
        $client_secret = "";

        $integrator_and_secret_key = "Basic " . utf8_decode(base64_encode("{$client_id}:{$client_secret}"));

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://account.docusign.com/oauth/token');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        $post = array(
            'grant_type' => 'authorization_code',
            'code' => $code,
        );
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

        $headers = array();
        $headers[] = 'Cache-Control: no-cache';
        $headers[] = "authorization: $integrator_and_secret_key";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        $decodedData = json_decode($result);
        $request->session()->put('docusign_auth_code', $decodedData->access_token);
        // dd($decodedData->access_token);
    
        return redirect()->route('docusign')->with('success', 'Docusign Succesfully Connected');
    }

    public function signDocument(Request $request)
    {       
        
        try{
            $userid = Auth::user()->id;

            $operatorid= Operator::select('last_name','first_name')->where('user_id',$userid)->first('id');

            $lettrefirst=substr($operatorid->last_name, 0, 1)??null;

            $num = rand(1000, 9999);
    
            $yy=date("Y");
            $mm=date('m');

            $val1="";
            $val2="";
            $xvalues=explode(',', $request->xvalue);
            if(count($xvalues)==2){
                foreach ($xvalues as $key => $value) {
                    if($key==0){
                        $val1=$value;
                    }else if($key==1){
                        $val2=$value;
                    }
                }
            }else{
                foreach ($xvalues as $key => $value) {
                    $val1=$value;
                }
            }

            $right_val=$val1." ".$val2;

            $array = explode(',', $request->typeselected);
            if(in_array('101', $array) && in_array('102', $array)){
                // $template="c1fa04b2-7acf-43c3-a2f4-c354c27b42dd";
                $template="694b4c8e-a9b5-4d02-a567-f39e18c1f88c";
            }else if(in_array('101', $array) || in_array('102', $array)){
                // $template="c1fa04b2-7acf-43c3-a2f4-c354c27b42dd";
                $template="694b4c8e-a9b5-4d02-a567-f39e18c1f88c";
            }else if(in_array('104', $array)){
                // $template="18091d9f-ef63-4247-8a0b-4b6f8b1fc627";
                $template="944c42cd-e558-47c3-adff-b334c48d32c6";
            }

            $this->args = $this->getTemplateArgs();
            
            $args = $this->args;

            // dd($this->args['ds_access_token']);

            $envelope_args = $args["envelope_args"];
            
            # Create the envelope request object
            // $envelope_definition = $this->make_envelope($args["envelope_args"],$this->args['ds_access_token']);
            // $template_id=$envelope_definition->templateId;

            $url = "https://eu.docusign.net/restapi/v2.1/accounts/"."3df36e73-cd9f-49cb-b337-9519ea7239c4"."/envelopes";//good

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            $headers = array(
                "Accept: application/json",
                "Authorization: Bearer ".$this->args['ds_access_token'],
                "Content-Type: application/json",
            );

            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

            $data = '{
                "emailBlurb": "Create an envelope with a templateId",
                "emailSubject": "Template",
                "compositeTemplates": [
                    {
                        "serverTemplates": [
                            {
                                "sequence": "1",
                                "templateId": "'.$template.'"
                            }
                        ],
                        "inlineTemplates": [
                            {
                                "recipients": {
                                    "signers": [
                                        {
                                            "email": "'.$request->mail.'",
                                            "name": "'.$request->fname.'",
                                            "recipientId": "2",
                                            "roleName": "signer",
                                            "tabs": {
                                                "signHereTabs": [
                                                    {
                                                        "anchorString": "test",
                                                        "anchorUnits": "pixels",
                                                        "anchorXOffset": "200",
                                                        "anchorYOffset": "10"
                                                    }
                                                ],
                                                "textTabs": [
                                                    {
                                                        "tabLabel": "fname",
                                                        "value": "'.$request->fname.'"
                                                    },
                                                    {
                                                        "tabLabel": "lname",
                                                        "value": "'.$request->lname.'"
                                                    },
                                                    {
                                                        "tabLabel": "datebird",
                                                        "value":  "'.date("d/m/Y", strtotime($request->datebirth)).'"
                                                    },
                                                    {
                                                        "tabLabel": "address",
                                                        "value": "'.$request->adresse.'"
                                                    },
                                                    {
                                                        "tabLabel": "city",
                                                        "value": "'.$request->city.'"
                                                    },
                                                    {
                                                        "tabLabel": "cp",
                                                        "value": "'.$request->cp.'"
                                                    },
                                                    {
                                                        "tabLabel": "mail",
                                                        "value": "'.$request->mail.'"
                                                    },
                                                    {
                                                        "tabLabel": "phone",
                                                        "value": "'.$request->phone.'"
                                                    },
                                                    {
                                                        "tabLabel": "sysdate",
                                                        "value": "'.date('d/m/Y').'"
                                                    },
                                                    {
                                                        "tabLabel": "bic",
                                                        "value": "'.$request->bic.'"
                                                    },
                                                    {
                                                        "tabLabel": "iban",
                                                        "value": "'.$request->iban.'"
                                                    },
                                                    {
                                                        "tabLabel": "besoin1",
                                                        "value": "'.$request->besoin1.'"
                                                    },
                                                    {
                                                        "tabLabel": "besoin2",
                                                        "value": "'.$request->besoin2.'"
                                                    },
                                                    {
                                                        "tabLabel": "besoin3",
                                                        "value": "'.$request->besoin3.'"
                                                    },
                                                    {
                                                        "tabLabel": "distributeur",
                                                        "value": "Bailey"
                                                    },
                                                    {
                                                        "tabLabel": "conseiller",
                                                        "value": "'.$operatorid->first_name.' '.$lettrefirst.'"
                                                    },
                                                    {
                                                        "tabLabel": "numvalidation",
                                                        "value": "'.$val1.'"
                                                    },
                                                    {
                                                        "tabLabel": "numvalidation1",
                                                        "value": "'.$val2.'"
                                                    },
                                                    {
                                                        "tabLabel": "pdl",
                                                        "value": "'.$request->pdl.'"
                                                    },
                                                    {
                                                        "tabLabel": "pce",
                                                        "value": "'.$request->pce.'"
                                                    },
                                                    {
                                                        "tabLabel": "fournisseurpdl",
                                                        "value": "'.$request->fournisseurpdl.'"
                                                    },
                                                    {
                                                        "tabLabel": "fournisseurpce",
                                                        "value": "'.$request->pce.'"
                                                    },
                                                    {
                                                        "tabLabel": "gender",
                                                        "value": "'.$request->gender.'"
                                                    },
                                                    {
                                                        "tabLabel": "comment",
                                                        "value": "'.$request->comment.'"
                                                    },
                                                    {
                                                        "tabLabel": "option1",
                                                        "value": "'.$request->option1.'"
                                                    },
                                                    {
                                                        "tabLabel": "option2",
                                                        "value": "'.$request->option2.'"
                                                    },
                                                    {
                                                        "tabLabel": "bgtxt1",
                                                        "value": "'.$request->bgtxt1.'"
                                                    },
                                                    {
                                                        "tabLabel": "bgtxt2",
                                                        "value": "'.$request->bgtxt2.'"
                                                    },
                                                    {
                                                        "tabLabel": "code",
                                                        "value": "'.$request->code.'"
                                                    },
                                                    {
                                                        "tabLabel": "dateenvoie",
                                                        "value":  "'.date("d/m/Y H:i:s"  , strtotime("+1 hours", strtotime($request->dateenvoie))).'"
                                                    },
                                                    {
                                                        "tabLabel": "cerft",
                                                        "value": "√ Je certifie être le titulaire de l\'Iban/Bic suivant"
                                                    },
                                                    {
                                                        "tabLabel": "reccurent",
                                                        "value": "Le √ '.$request->reccurent.'"
                                                    }
                                                ]
                                            }
                                        }
                                    ]
                                },
                                "sequence": "2"
                            }
                        ]
                    }
                ],
                "status": "sent"
            }';

            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

            //for debug only!
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            
            $resp = curl_exec($curl);
            curl_close($curl);

            $result=json_decode($resp,true);

            if($result){
                return response()->json([
                    'success' => true,
                    'message' => "Vous avez reçu par email votre bulletin d'adhésion à signer par Docusign",
                    'result' => $result
                ]);
            }

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e
            ]);
        }     
    }

    public function getEnvelopeApi(): EnvelopesApi
    {   
        $this->config = new Configuration();
        $this->config->setHost($this->args['base_path']);
        $this->config->addDefaultHeader('Authorization', 'Bearer ' . $this->args['ds_access_token']);    
        $this->apiClient = new ApiClient($this->config);

        return new EnvelopesApi($this->apiClient);
    }

    private function getTemplateArgs()
    {   
        $tokenresult = $this->connectDocusign();
        $tokenvalue = $tokenresult->access_token;

        $envelope_args = [
            'signer_client_id' => $this->signer_client_id,
            'ds_return_url' => route('docusign')
        ];
        $args = [
            'account_id' => "3df36e73-cd9f-49cb-b337-9519ea7239c4",
            'base_path' => "https://www.docusign.net/restapi",
            'ds_access_token' => $tokenvalue,
            'envelope_args' => $envelope_args
        ];
        return $args;
        
    }

    public function getContractState(){
        $curl = curl_init();
        
        $contracts=DigitalContract::select('id','contract_number','company_id','envelopeId')->where('is_signed',0) ->whereNotNull('envelopeId')->get();
        
        $this->args = $this->getTemplateArgs();
            
        $args = $this->args;

        $long = strtotime(date("Y-m-d H:i:s")); 

        foreach ($contracts as $key => $value) {
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://eu.docusign.net/restapi/v2.1/accounts/'."3df36e73-cd9f-49cb-b337-9519ea7239c4".'/envelopes/'.$value->envelopeId,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    "Authorization: Bearer ".$this->args['ds_access_token'],
                    'Cookie: BIGipServerpool_DR1_Demo_API=!TBvsaa3wHzgn1Lz2SkWZuTyeoL7a6UbLhjYdM4GWH2b7vykmyTStb9bx0qLvlf0K9dLvfqjMM/nWPhE='
                ),
            ));

            $response = curl_exec($curl);
    
            $result=json_decode($response);

            if (isset($result->status)) {
                if($result->status=="completed"){
                    $contract = DigitalContract::where('id', $value->id)->first();
                    $contract->is_signed = 1;
                    $contract->state = "Bulletin Signé";
                    $contract->updated_at=$long;
                    $contract->update();

                    $existingContract = Contract::where('contract_number', $value->contract_number)
                        ->where('company_id', $value->company_id)
                        ->first();

                    if ($existingContract) {
                        continue;
                    }else{
                        $row = new Contract();

                        $row->contract_number =  (isset($contract->contract_number)) ? $contract->contract_number : null; 
                        $row->company_id =  (isset($contract->company_id)) ? $contract->company_id : null;
                        $row->iban =  (isset($contract->iban)) ? $contract->iban : null;
                        $row->bic_swift =  (isset($contract->bic_swift)) ? $contract->bic_swift : null; 
                        $row->operator_id =  (isset($contract->operator_id)) ? $contract->operator_id : null; 
                        $row->status =  (isset($contract->status)) ? $contract->status : null;
                        $row->step =  (isset($contract->step)) ? $contract->step : null;
                        $row->date =  (isset($contract->date)) ? $contract->date : null; 
                        $row->pdl_number =  (isset($contract->pdl_number)) ? $contract->pdl_number : null; 
                        $row->service_provider_id =  (isset($contract->service_provider_id)) ? $contract->service_provider_id : null; 
                        $row->landline_phone =  (isset($contract->landline_phone)) ? $contract->landline_phone : null; 
                        $row->mobile_phone =  (isset($contract->mobile_phone)) ? $contract->mobile_phone : null; 
                        $row->type_of_building =  (isset($contract->type_of_building)) ? $contract->type_of_building : null; 
                        $row->address =  (isset($contract->address)) ? $contract->address : null;
                        $row->postal_code =  (isset($contract->postal_code)) ? $contract->postal_code : null; 
                        $row->city_name =  (isset($contract->city_name)) ? $contract->city_name : null; 
                        $row->city_id = (isset($contract->city_id)) ? $contract->city_id : null;
                        $row->day_id =  (isset($contract->day_id)) ? $contract->day_id : null; 
                        $row->sage_number = (isset($contract->sage_number)) ? $contract->sage_number : null; 
                        $row->status_updated_at = (isset($contract->status_updated_at)) ? $contract->status_updated_at : null;  
                        $row->excel_row = (isset($contract->excel_row)) ? $contract->excel_row : null;   
                        $row->created_by =  (isset($contract->created_by)) ? $contract->created_by : null; 
                        $row->updated_by =  (isset($contract->updated_by)) ? $contract->updated_by : null; 
                        $row->created_at =  (isset($contract->created_at)) ? $contract->created_at : null;
                        $row->updated_at =  (isset($contract->updated_at)) ? $contract->updated_at : null; 
                        $row->signed =  (isset($contract->signed)) ? $contract->signed : null;
                        $row->signed_date = $long;   
                        $row->envelopeId =  (isset($contract->envelopeId)) ? $contract->envelopeId : null; 
                        $row->email =  (isset($contract->email)) ? $contract->email : null; 
                        $row->group = (isset($contract->group)) ? $contract->group : null;   
                        $row->data =(isset($contract->data)) ? $contract->data : null;    
                        $row->save();
                    }
                    
                    // if($row->id!=null){
                    //     $contract->is_saved = 1;
                    //     $contract->save();
                    // }

                }
            }
            

            // curl_close($curl);
        }
    }
}