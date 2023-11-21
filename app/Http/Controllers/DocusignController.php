<?php

namespace App\Http\Controllers;

use App\Models\Client;
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
use App\Models\Contract;
use App\Models\Naissance;
use App\Models\Operator;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
            "sub"=> "c8b15191-8cf0-4cff-859a-bb5045036574",
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
        try {
            $userid = Auth::user()->id;

            $operatorid = Operator::select('last_name', 'first_name')
                ->where('user_id', $userid)
                ->first('id');

            $lettrefirst = substr($operatorid->last_name, 0, 1) ?? null;

            $num = rand(1000, 9999);
            $civilitee='';
            if ($request->civilite==1) {
                $civilitee='Monsieur';
            } else {
                $civilitee='Madame';
            }
            
            $yy = date('Y');
            $mm = date('m');

            $val1 = '';
            $val2 = '';
           

            $right_val = $val1 . ' ' . $val2;

            $array = explode(',', $request->typeselected);
            if (in_array('101', $array) && in_array('102', $array)) {
                // $template="c1fa04b2-7acf-43c3-a2f4-c354c27b42dd";
                $template = '694b4c8e-a9b5-4d02-a567-f39e18c1f88c';
            } elseif (in_array('101', $array) || in_array('102', $array)) {
                // dd("hannnnnnnni");
                // $template="c1fa04b2-7acf-43c3-a2f4-c354c27b42dd";
                $template = '694b4c8e-a9b5-4d02-a567-f39e18c1f88c';
            } elseif (in_array('104', $array)) {
                // $template="18091d9f-ef63-4247-8a0b-4b6f8b1fc627";
                $template = '944c42cd-e558-47c3-adff-b334c48d32c6';
            }elseif (in_array('105', $array)) {
                // $template="18091d9f-ef63-4247-8a0b-4b6f8b1fc627";
                $template = 'ea09cc2c-224c-47c4-b007-da7cf580452e';
            }

            $this->args = $this->getTemplateArgs();
            // dd($this->args);
            $args = $this->args;

            // dd($this->args['ds_access_token']);

            $envelope_args = $args['envelope_args'];
            // dd($this->args['ds_access_token']);

            # Create the envelope request object
            // $envelope_definition = $this->make_envelope($args["envelope_args"],$this->args['ds_access_token']);
            // $template_id=$envelope_definition->templateId;

            $url = 'https://eu.docusign.net/restapi/v2.1/accounts/' . '3df36e73-cd9f-49cb-b337-9519ea7239c4' . '/envelopes';

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            $headers = ['Accept: application/json', 'Authorization: Bearer ' . $this->args['ds_access_token'], 'Content-Type: application/json'];

            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            
            $civilitee='';
            // dd($request->gender);
            if ($request->gender==1) {
                $civilitee='M';
            } else {
                $civilitee='Mme';
            }
            // dd($civilitee);
            if ($request->typeselected == 104) {
                $data = '{
                    "emailBlurb": "Create an envelope with a templateId",
                    "emailSubject": "Mon Assurance PGE:'. $request->fname .'",
                    "compositeTemplates": [
                        {
                            "serverTemplates": [
                                {
                                    "sequence": "1",
                                    "templateId": "' . $template . '"
                                }
                            ],
                            "inlineTemplates": [
                                {
                                    "recipients": {
                                        "signers": [
                                            {
                                                "email": "' . $request->mail . '",
                                                "name": "' . $request->fname . '",
                                                "recipientId": "2",
                                                "roleName": "signer",
                                                "tabs": {
                                                    "signHereTabs": [
                                                        {
                                                            "xPosition": "96",
                                                            "yPosition": "730",
                                                            "tabLabel": "signature1",
                                                            "documentId": "1",
                                                            "pageNumber": "4"
                                                        },
                                                        {
                                                            "xPosition": "342",
                                                            "yPosition": "563",
                                                            "documentId": "1",
                                                            "tabLabel": "signature3",
                                                            "pageNumber": "10"
                                                        },
                                                        {
                                                            "xPosition": "466",
                                                            "yPosition": "770",
                                                            "documentId": "1",
                                                            "tabLabel": "signature4",
                                                            "pageNumber": "10"
                                                        }
                                                    ],
                                                    "textTabs": [
                                                        {
                                                            "xPosition": "50",
                                                            "yPosition": "353",
                                                            "documentId": "1",
                                                            "pageNumber": "3",
                                                            "tabLabel": "fname",
                                                            "value": "' . $request->fname . '"
                                                        },
                                                        {
                                                            "xPosition": "374",
                                                            "yPosition": "734",
                                                            "documentId": "1",
                                                            "pageNumber": "7",
                                                            "tabLabel": "fname2",
                                                            "value": "' . $request->fname . '"
                                                        },
                                                        {
                                                            "xPosition": "180",
                                                            "yPosition": "727",
                                                            "documentId": "1",
                                                            "pageNumber": "10",
                                                            "tabLabel": "fname4",
                                                            "value": "' . $request->fname . '"
                                                        },
                                                        {
                                                            "xPosition": "58",
                                                            "yPosition": "134",
                                                            "documentId": "1",
                                                            "pageNumber": "10",
                                                            "tabLabel": "fname3",
                                                            "value": "' . $request->fname . '"
                                                        },
                                                        {
                                                            "xPosition": "256",
                                                            "yPosition": "355",
                                                            "documentId": "1",
                                                            "pageNumber": "3",
                                                            "tabLabel": "lname",
                                                            "value": "' . $request->lname . '"
                                                        },
                                                        {
                                                            "xPosition": "459",
                                                            "yPosition": "734",
                                                            "documentId": "1",
                                                            "pageNumber": "7",
                                                            "tabLabel": "lname2",
                                                            "value": "' . $request->lname . '"
                                                        },
                                                        {
                                                            "xPosition": "254",
                                                            "yPosition": "134",
                                                            "documentId": "1",
                                                            "pageNumber": "10",
                                                            "tabLabel": "lname3",
                                                            "value": "' . $request->lname . '"
                                                        },
                                                        {
                                                            "xPosition": "375",
                                                            "yPosition": "728",
                                                            "documentId": "1",
                                                            "pageNumber": "10",
                                                            "tabLabel": "lname4",
                                                            "value": "' . $request->lname . '"
                                                        },
                                                        {
                                                            "xPosition": "522",
                                                            "yPosition": "355",
                                                            "documentId": "1",
                                                            "pageNumber": "3",
                                                            "tabLabel": "datebird",
                                                            "value": "' . date("d/m/Y", strtotime($request->datebirth)) . '"
                                                        },
                                                        {
                                                            "xPosition": "452",
                                                            "yPosition": "134",
                                                            "documentId": "1",
                                                            "pageNumber": "10",
                                                            "tabLabel": "datebird2",
                                                            "value": "' . date("d/m/Y", strtotime($request->datebirth)) . '"
                                                        },
                                                        {
                                                            "xPosition": "61",
                                                            "yPosition": "370",
                                                            "documentId": "1",
                                                            "pageNumber": "3",
                                                            "tabLabel": "address",
                                                            "value": "' . $request->adresse . '"
                                                        },
                                                        {
                                                            "xPosition": "348",
                                                            "yPosition": "755",
                                                            "documentId": "1",
                                                            "pageNumber": "7",
                                                            "tabLabel": "address2",
                                                            "value": "' . $request->adresse . '"
                                                        },
                                                        {
                                                            "xPosition": "71",
                                                            "yPosition": "154",
                                                            "documentId": "1",
                                                            "pageNumber": "10",
                                                            "tabLabel": "address3",
                                                            "value": "' . $request->adresse . '"
                                                        },
                                                        {
                                                            "xPosition": "191",
                                                            "yPosition": "744",
                                                            "documentId": "1",
                                                            "pageNumber": "10",
                                                            "tabLabel": "address4",
                                                            "value": "' . $request->adresse . '"
                                                        },
                                                        {
                                                            "xPosition": "280",
                                                            "yPosition": "371",
                                                            "documentId": "1",
                                                            "pageNumber": "3",
                                                            "tabLabel": "city",
                                                            "value": "' . $request->city . '"
                                                        },
                                                        {
                                                            "xPosition": "41",
                                                            "yPosition": "691",
                                                            "documentId": "1",
                                                            "pageNumber": "4",
                                                            "tabLabel": "city2",
                                                            "value": "' . $request->city . '"
                                                        },
                                                        {
                                                            "xPosition": "451",
                                                            "yPosition": "78",
                                                            "documentId": "1",
                                                            "pageNumber": "10",
                                                            "tabLabel": "xvalue",
                                                            "value": "' . $request->xvalue . '"
                                                        },
                                                        {
                                                            "xPosition": "468",
                                                            "yPosition": "775",
                                                            "documentId": "1",
                                                            "pageNumber": "7",
                                                            "tabLabel": "city3",
                                                            "value": "' . $request->city . '"
                                                        },
                                                        {
                                                            "xPosition": "58",
                                                            "yPosition": "175",
                                                            "documentId": "1",
                                                            "pageNumber": "10",
                                                            "tabLabel": "city4",
                                                            "value": "' . $request->city . '"
                                                        },
                                                        {
                                                            "xPosition": "59",
                                                            "yPosition": "571",
                                                            "documentId": "1",
                                                            "pageNumber": "10",
                                                            "tabLabel": "city5",
                                                            "value": "' . $request->city . '"
                                                        },
                                                        {
                                                            "xPosition": "195",
                                                            "yPosition": "776",
                                                            "documentId": "1",
                                                            "pageNumber": "10",
                                                            "tabLabel": "city6",
                                                            "value": "' . $request->city . '"
                                                        },
                                                        {
                                                            "xPosition": "40",
                                                            "yPosition": "707",
                                                            "documentId": "1",
                                                            "pageNumber": "4",
                                                            "tabLabel": "sysdate",
                                                            "value": "' . date('d/m/Y') . '"
                                                        },
                                                        {
                                                            "xPosition": "216",
                                                            "yPosition": "657",
                                                            "documentId": "1",
                                                            "pageNumber": "10",
                                                            "tabLabel": "cerft",
                                                            "value": "√ Je certifie être le titulaire de l\'Iban/Bic suivant "
                                                        },
                                                        {
                                                            "xPosition": "365",
                                                            "yPosition": "795",
                                                            "documentId": "1",
                                                            "pageNumber": "7",
                                                            "tabLabel": "sysdate2",
                                                            "value": "' . date('d/m/Y') . '"
                                                        },
                                                        {
                                                            "xPosition": "411",
                                                            "yPosition": "114",
                                                            "documentId": "1",
                                                            "pageNumber": "10",
                                                            "tabLabel": "sysdate3",
                                                            "value": "' . date('d/m/Y') . '"
                                                        },
                                                        {
                                                            "xPosition": "529",
                                                            "yPosition": "570",
                                                            "documentId": "1",
                                                            "pageNumber": "10",
                                                            "tabLabel": "sysdate4",
                                                            "value": "' . date('d/m/Y') . '"
                                                        },
                                                        {
                                                            "xPosition": "183",
                                                            "yPosition": "787",
                                                            "documentId": "1",
                                                            "pageNumber": "10",
                                                            "tabLabel": "sysdate5",
                                                            "value": "' . date('d/m/Y') . '"
                                                        },
                                                        {
                                                            "xPosition": "492",
                                                            "yPosition": "372",
                                                            "documentId": "1",
                                                            "pageNumber": "3",
                                                            "tabLabel": "cp",
                                                            "value": "' . $request->cp . '"
                                                        },
                                                        {
                                                            "xPosition": "363",
                                                            "yPosition": "775",
                                                            "documentId": "1",
                                                            "pageNumber": "7",
                                                            "tabLabel": "cp2",
                                                            "value": "' . $request->cp . '"
                                                        },
                                                        {
                                                            "xPosition": "512",
                                                            "yPosition": "154",
                                                            "documentId": "1",
                                                            "pageNumber": "10",
                                                            "tabLabel": "cp3",
                                                            "value": "' . $request->cp . '"
                                                        },
                                                        {
                                                            "xPosition": "47",
                                                            "yPosition": "387",
                                                            "documentId": "1",
                                                            "pageNumber": "3",
                                                            "tabLabel": "mail",
                                                            "value": "' . $request->mail . '"
                                                        },
                                                        {
                                                            "xPosition": "64",
                                                            "yPosition": "194",
                                                            "documentId": "1",
                                                            "pageNumber": "10",
                                                            "tabLabel": "mail2",
                                                            "value": "' . $request->mail . '"
                                                        },
                                                        {
                                                            "xPosition": "411",
                                                            "yPosition": "387",
                                                            "documentId": "1",
                                                            "pageNumber": "3",
                                                            "tabLabel": "phone",
                                                            "value": "' . $request->phone . '"
                                                        },
                                                        {
                                                            "xPosition": "470",
                                                            "yPosition": "174",
                                                            "documentId": "1",
                                                            "pageNumber": "10",
                                                            "tabLabel": "phone2",
                                                            "value": "' . $request->phone . '"
                                                        },
                                                        {
                                                            "xPosition": "242",
                                                            "yPosition": "758",
                                                            "documentId": "1",
                                                            "pageNumber": "10",
                                                            "tabLabel": "phone3",
                                                            "value": "' . $request->phone . '"
                                                        },
                                                        {
                                                            "xPosition": "177",
                                                            "yPosition": "673",
                                                            "documentId": "1",
                                                            "pageNumber": "10",
                                                            "tabLabel": "bic",
                                                            "value": "' .($request->bic !== null ? $request->bic : "--") . '"
                                                        },
                                                        {
                                                            "xPosition": "182",
                                                            "yPosition": "688",
                                                            "documentId": "1",
                                                            "pageNumber": "10",
                                                            "tabLabel": "iban",
                                                            "value": "' . $request->iban . '"
                                                        },
                                                        {
                                                            "xPosition": "34",
                                                            "yPosition": "454",
                                                            "documentId": "1",
                                                            "pageNumber": "3",
                                                            "tabLabel": "besoin1",
                                                            "value": "' . $request->besoin1 . '"
                                                        },
                                                        {
                                                            "xPosition": "34",
                                                            "yPosition": "492",
                                                            "documentId": "1",
                                                            "pageNumber": "3",
                                                            "tabLabel": "besoin2",
                                                            "value": "' . $request->besoin2 . '"
                                                        },
                                                        {
                                                            "xPosition": "34",
                                                            "yPosition": "531",
                                                            "documentId": "1",
                                                            "pageNumber": "3",
                                                            "tabLabel": "besoin3",
                                                            "value": "' . $request->besoin3 . '"
                                                        },
                                                        {
                                                            "xPosition": "78",
                                                            "yPosition": "77",
                                                            "documentId": "1",
                                                            "pageNumber": "10",
                                                            "tabLabel": "distributeur",
                                                            "value": "Bailey Assurances"
                                                        },
                                                        {
                                                            "xPosition": "246",
                                                            "yPosition": "77",
                                                            "documentId": "1",
                                                            "pageNumber": "10",
                                                            "tabLabel": "conseiller",
                                                            "value": "' . $operatorid->first_name . ' ' . $lettrefirst . '"
                                                        },
                                                        {
                                                            "xPosition": "63",
                                                            "yPosition": "107",
                                                            "documentId": "1",
                                                            "pageNumber": "10",
                                                            "tabLabel": "gender",
                                                            "value": "' . $civilitee . '"
                                                        },
                                                        {
                                                            "xPosition": "69",
                                                            "yPosition": "553",
                                                            "documentId": "1",
                                                            "pageNumber": "3",
                                                            "tabLabel": "comment",
                                                            "value": "' . ($request->comment !== null ? $request->comment : "--") . '"
                                                        },
                                                        {
                                                            "xPosition": "51",
                                                            "yPosition": "766",
                                                            "documentId": "1",
                                                            "pageNumber": "4",
                                                            "tabLabel": "code",
                                                            "value": "' . ($request->code !== null ? $request->code : "--") . '"
                                                        },
                                                        {
                                                            "xPosition": "51",
                                                            "yPosition": "784",
                                                            "documentId": "1",
                                                            "pageNumber": "4",
                                                            "tabLabel": "dateenvoie",
                                                            "value":  "' . date("d/m/Y H:i:s", strtotime("+1 hours", strtotime($request->dateenvoie))) . '"
                                                        },
                                                        {
                                                            "xPosition": "216",
                                                            "yPosition": "657",
                                                            "documentId": "1",
                                                            "pageNumber": "10",
                                                            "tabLabel": "cerft",
                                                            "value": "√ Je certifie être le titulaire de l\'Iban/Bic suivant"
                                                        },
                                                        {
                                                            "xPosition": "42",
                                                            "yPosition": "776",
                                                            "documentId": "1",
                                                            "pageNumber": "10",
                                                            "tabLabel": "reccurent",
                                                            "value": "Le √ ' . $request->reccurent . '"
                                                        },
                                                    ],
                                                    "checkboxTabs": [
                                                        {
                                                            "tabLabel": "checkbox",
                                                            "xPosition": "30",
                                                            "yPosition": "529",
                                                            "documentId": "1",
                                                            "pageNumber": "10",
                                                            "required":true,
                                                            "tabGroupLabels": [
                                                            "checkbox group"
                                                    ]
                                                        }
                                                    ],
                                                    "tabGroups": [
                                                        {
                                                            "groupLabel": "checkbox group",
                                                            "groupRule": "SelectAtLeast",
                                                            "minimumRequired": "1",
                                                            "maximumAllowed": "1",
                                                            "validationMessage": "Please check to indicate your agreement",
                                                            "tabScope": "document",
                                                            "pageNumber": "10",
                                                            "documentId": "1"
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
            }else if($request->typeselected == 101 || $request->typeselected== 102 ) {
                $data = '{
                    "emailBlurb": "Create an envelope with a templateId",
                    "emailSubject": "Mon Assurance Facture:'. $civilitee .' '.$request->fname.'",
                    "compositeTemplates": [
                        {
                            "serverTemplates": [
                                {
                                    "sequence": "1",
                                    "templateId": "' . $template . '"
                                }
                            ],
                            "inlineTemplates": [
                                {
                                    "recipients": {
                                        "signers": [
                                            {
                                                "email": "' . $request->mail . '",
                                                "name": "' . $request->fname . '",
                                                "recipientId": "2",
                                                "roleName": "signer",
                                                "tabs": {
                                                    "signHereTabs": [
                                                        {
                                                            "xPosition": "93",
                                                            "yPosition": "726",
                                                            "tabLabel": "signature1",
                                                            "documentId": "1",
                                                            "pageNumber": "4"
                                                        },
                                                        {
                                                            "xPosition": "317",
                                                            "yPosition": "521",
                                                            "tabLabel": "signature2",
                                                            "documentId": "1",
                                                            "pageNumber": "9"
                                                        },
                                                        {
                                                            "xPosition": "439",
                                                            "yPosition": "772",
                                                            "tabLabel": "signature3",
                                                            "documentId": "1",
                                                            "pageNumber": "9"
                                                        }
                                                    ],
                                                    "textTabs": [
                                                        {
                                                            "xPosition": "51",
                                                            "yPosition": "369",
                                                            "documentId": "1",
                                                            "pageNumber": "3",
                                                            "tabLabel": "fname",
                                                            "value": "' . $request->fname . '"
                                                        },
                                                        {
                                                            "xPosition": "373",
                                                            "yPosition": "737",
                                                            "documentId": "1",
                                                            "pageNumber": "6",
                                                            "tabLabel": "fname2",
                                                            "value": "' . $request->fname . '"
                                                        },
                                                        {
                                                            "xPosition": "59",
                                                            "yPosition": "135",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "fname3",
                                                            "value": "' . $request->fname . '"
                                                        },
                                                        {
                                                            "xPosition": "182",
                                                            "yPosition": "727",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "fname4",
                                                            "value": "' . $request->fname . '"
                                                        },
                                                        {
                                                            "xPosition": "255",
                                                            "yPosition": "369",
                                                            "documentId": "1",
                                                            "pageNumber": "3",
                                                            "tabLabel": "lname",
                                                            "value": "' . $request->lname . '"
                                                        },
                                                        {
                                                            "xPosition": "455",
                                                            "yPosition": "737",
                                                            "documentId": "1",
                                                            "pageNumber": "6",
                                                            "tabLabel": "lname2",
                                                            "value": "' . $request->lname . '"
                                                        },
                                                        {
                                                            "xPosition": "261",
                                                            "yPosition": "134",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "lname3",
                                                            "value": "' . $request->lname . '"
                                                        },
                                                        {
                                                            "xPosition": "374",
                                                            "yPosition": "726",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "lname4",
                                                            "value": "' . $request->lname . '"
                                                        },
                                                        {
                                                            "xPosition": "521",
                                                            "yPosition": "370",
                                                            "documentId": "1",
                                                            "pageNumber": "3",
                                                            "tabLabel": "datebird",
                                                            "value": "' . date("d/m/Y", strtotime($request->datebirth)) . '"
                                                        },
                                                        {
                                                            "xPosition": "457",
                                                            "yPosition": "134",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "datebird2",
                                                            "value": "' . date("d/m/Y", strtotime($request->datebirth)) . '"
                                                        },
                                                        {
                                                            "xPosition": "59",
                                                            "yPosition": "384",
                                                            "documentId": "1",
                                                            "pageNumber": "3",
                                                            "tabLabel": "address",
                                                            "value": "' . $request->adresse . '"
                                                        },
                                                        {
                                                            "xPosition": "347",
                                                            "yPosition": "756",
                                                            "documentId": "1",
                                                            "pageNumber": "6",
                                                            "tabLabel": "address2",
                                                            "value": "' . $request->adresse . '"
                                                        },
                                                        {
                                                            "xPosition": "71",
                                                            "yPosition": "155",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "address3",
                                                            "value": "' . $request->adresse . '"
                                                        },
                                                        {
                                                            "xPosition": "191",
                                                            "yPosition": "743",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "address4",
                                                            "value": "' . $request->adresse . '"
                                                        },
                                                        {
                                                            "xPosition": "282",
                                                            "yPosition": "385",
                                                            "documentId": "1",
                                                            "pageNumber": "3",
                                                            "tabLabel": "city",
                                                            "value": "' . $request->city . '"
                                                        },
                                                        {
                                                            "xPosition": "43",
                                                            "yPosition": "692",
                                                            "documentId": "1",
                                                            "pageNumber": "4",
                                                            "tabLabel": "city2",
                                                            "value": "' . $request->city . '"
                                                        },
                                                        {
                                                            "xPosition": "453",
                                                            "yPosition": "778",
                                                            "documentId": "1",
                                                            "pageNumber": "6",
                                                            "tabLabel": "city3",
                                                            "value": "' . $request->city . '"
                                                        },
                                                        {
                                                            "xPosition": "57",
                                                            "yPosition": "175",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "city4",
                                                            "value": "' . $request->city . '"
                                                        },
                                                        {
                                                            "xPosition": "57",
                                                            "yPosition": "532",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "city5",
                                                            "value": "' . $request->city . '"
                                                        },
                                                        {
                                                            "xPosition": "195",
                                                            "yPosition": "775",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "city6",
                                                            "value": "' . $request->city . '"
                                                        },
                                                        {
                                                            "xPosition": "38",
                                                            "yPosition": "709",
                                                            "documentId": "1",
                                                            "pageNumber": "4",
                                                            "tabLabel": "sysdate",
                                                            "value": "' . date('d/m/Y') . '"
                                                        },
                                                        {
                                                            "xPosition": "366",
                                                            "yPosition": "797",
                                                            "documentId": "1",
                                                            "pageNumber": "6",
                                                            "tabLabel": "sysdate2",
                                                            "value": "' . date('d/m/Y') . '"
                                                        },
                                                        {
                                                            "xPosition": "413",
                                                            "yPosition": "115",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "sysdate3",
                                                            "value": "' . date('d/m/Y') . '"
                                                        },
                                                        {
                                                            "xPosition": "514",
                                                            "yPosition": "531",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "sysdate4",
                                                            "value": "' . date('d/m/Y') . '"
                                                        },
                                                        {
                                                            "xPosition": "184",
                                                            "yPosition": "789",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "sysdate5",
                                                            "value": "' . date('d/m/Y') . '"
                                                        },
                                                        {
                                                            "xPosition": "494",
                                                            "yPosition": "385",
                                                            "documentId": "1",
                                                            "pageNumber": "3",
                                                            "tabLabel": "cp",
                                                            "value": "' . $request->cp . '"
                                                        },
                                                        {
                                                            "xPosition": "365",
                                                            "yPosition": "777",
                                                            "documentId": "1",
                                                            "pageNumber": "6",
                                                            "tabLabel": "cp2",
                                                            "value": "' . $request->cp . '"
                                                        },
                                                        {
                                                            "xPosition": "513",
                                                            "yPosition": "155",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "cp3",
                                                            "value": "' . $request->cp . '"
                                                        },
                                                        {
                                                            "xPosition": "47",
                                                            "yPosition": "401",
                                                            "documentId": "1",
                                                            "pageNumber": "3",
                                                            "tabLabel": "mail",
                                                            "value": "' . $request->mail . '"
                                                        },
                                                        {
                                                            "xPosition": "63",
                                                            "yPosition": "194",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "mail2",
                                                            "value": "' . $request->mail . '"
                                                        },
                                                        {
                                                            "xPosition": "409",
                                                            "yPosition": "400",
                                                            "documentId": "1",
                                                            "pageNumber": "3",
                                                            "tabLabel": "phone",
                                                            "value": "' . $request->phone . '"
                                                        },
                                                        {
                                                            "xPosition": "470",
                                                            "yPosition": "175",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "phone2",
                                                            "value": "' . $request->phone . '"
                                                        },
                                                        {
                                                            "xPosition": "243",
                                                            "yPosition": "759",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "phone3",
                                                            "value": "' . $request->phone . '"
                                                        },
                                                        {
                                                            "xPosition": "177",
                                                            "yPosition": "673",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "bic",
                                                            "value": "' . ($request->bic !== null ? $request->bic : "--") . '"
                                                        },
                                                        {
                                                            "xPosition": "183",
                                                            "yPosition": "689",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "iban",
                                                            "value": "' . $request->iban . '"
                                                        },
                                                        {
                                                            "xPosition": "47",
                                                            "yPosition": "464",
                                                            "documentId": "1",
                                                            "pageNumber": "3",
                                                            "tabLabel": "besoin1",
                                                            "value": "' . $request->besoin1 . '"
                                                        },
                                                        {
                                                            "xPosition": "47",
                                                            "yPosition": "502",
                                                            "documentId": "1",
                                                            "pageNumber": "3",
                                                            "tabLabel": "besoin2",
                                                            "value": "' . $request->besoin2 . '"
                                                        },
                                                        {
                                                            "xPosition": "45",
                                                            "yPosition": "543",
                                                            "documentId": "1",
                                                            "pageNumber": "3",
                                                            "tabLabel": "besoin3",
                                                            "value": "' . $request->besoin3 . '"
                                                        },
                                                        {
                                                            "xPosition": "77",
                                                            "yPosition": "80",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "distributeur",
                                                            "value": "Bailey Assurances"
                                                        },
                                                        {
                                                            "xPosition": "248",
                                                            "yPosition": "80",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "conseiller",
                                                            "value": "' . $operatorid->first_name . ' ' . $lettrefirst . '"
                                                        },
                                                        {
                                                            "xPosition": "452",
                                                            "yPosition": "79",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "xvalue",
                                                            "value": "' . $request->xvalue . '"
                                                        },
                                                        {
                                                            "xPosition": "58",
                                                            "yPosition": "109",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "gender",
                                                            "value": "' . $civilitee . '"
                                                        },
                                                        {
                                                            "xPosition": "68",
                                                            "yPosition": "570",
                                                            "documentId": "1",
                                                            "pageNumber": "3",
                                                            "tabLabel": "comment",
                                                            "value": "' . ($request->comment !== null ? $request->comment : "--") . '"
                                                        },
                                                        {
                                                            "xPosition": "14",
                                                            "yPosition": "802",
                                                            "documentId": "1",
                                                            "pageNumber": "6",
                                                            "tabLabel": "option1",
                                                            "value": "' . ($request->option1 !== null ? $request->option1 : "--") . '"
                                                        },
                                                        {
                                                            "xPosition": "57",
                                                            "yPosition": "601",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "option11",
                                                            "value": "' .($request->option1 !== null ? $request->option1 : "--") . '"
                                                        },
                                                        {
                                                            "xPosition": "170",
                                                            "yPosition": "802",
                                                            "documentId": "1",
                                                            "pageNumber": "6",
                                                            "tabLabel": "option2",
                                                            "value": "' . ($request->option2 !== null ? $request->option2 : "--") . '"
                                                        },
                                                        {
                                                            "xPosition": "397",
                                                            "yPosition": "599",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "option22",
                                                            "value": "' .($request->option2 !== null ? $request->option2 : "--") . '"
                                                        },
                                                        {
                                                            "xPosition": "43",
                                                            "yPosition": "211",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "bgtxt1",
                                                            "value": "' . ($request->bgtxt1 !== null ? $request->bgtxt1 : "--") . '"
                                                        },
                                                        {
                                                            "xPosition": "44",
                                                            "yPosition": "226",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "bgtxt2",
                                                            "value": "' . ($request->bgtxt2 !== null ? $request->bgtxt2 : "--") . '"
                                                        },
                                                        {
                                                            "xPosition": "55",
                                                            "yPosition": "767",
                                                            "documentId": "1",
                                                            "pageNumber": "4",
                                                            "tabLabel": "code",
                                                            "value": "' . ($request->code !== null ? $request->code : "--") . '"
                                                        },
                                                        {
                                                            "xPosition": "52",
                                                            "yPosition": "786",
                                                            "documentId": "1",
                                                            "pageNumber": "4",
                                                            "tabLabel": "dateenvoie",
                                                            "value":  "' . date("d/m/Y H:i:s", strtotime("+1 hours", strtotime($request->dateenvoie))) . '"
                                                        },
                                                        {
                                                            "xPosition": "218",
                                                            "yPosition": "658",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "cerft",
                                                            "value": "√ Je certifie être le titulaire de l\'Iban/Bic suivant"
                                                        },
                                                        {
                                                            "xPosition": "40",
                                                            "yPosition": "776",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "reccurent",
                                                            "value": "Le √ ' . $request->reccurent . '"
                                                        },
                                                    ],
                                                    "checkboxTabs": [
                                                        {
                                                          "tabLabel": "checkbox",
                                                          "xPosition": "29",
                                                          "yPosition": "489",
                                                          "documentId": "1",
                                                          "pageNumber": "9",
                                                          "required":true,
                                                          "tabGroupLabels": [
                                                            "checkbox group"
                                                          ]
                                                        },
                                                    ],
                                                    "tabGroups": [
                                                        {
                                                          "groupLabel": "checkbox group",
                                                          "groupRule": "SelectAtLeast",
                                                          "minimumRequired": "1",
                                                          "maximumAllowed": "1",
                                                          "validationMessage": "Please check to indicate your agreement",
                                                          "tabScope": "document",
                                                          "documentId": "1",
                                                          "pageNumber": "9"
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
            }else if($request->typeselected == 105){
                $nbr_pers_a_charger =-1;
                if ( empty($request->nbr_pers_a_charger) ) {
                    $nbr_pers_a_charger=0;
                }else {
                    $nbr_pers_a_charger=$request->nbr_pers_a_charger;
                }
                $monsieur='';
                $madame='';
                if ($request->gender==1) {
                    $monsieur='√';
                } else {
                    $madame='√';
                }
           
                if ($request->gender==1) {
                    $data = '{
                        "emailBlurb": "Create an envelope with a templateId",
                        "emailSubject": "Mon Assurance GFO:'.$civilitee.' '.$request->fname.'",
                        "compositeTemplates": [
                            {
                                "serverTemplates": [
                                    {
                                        "sequence": "1",
                                        "templateId": "' . $template . '"
                                    }
                                ],
                                "inlineTemplates": [
                                    {
                                        "recipients": {
                                            "signers": [
                                                {
                                                    "email": "' . $request->mail . '",
                                                    "name": "' . $request->fname . '",
                                                    "recipientId": "2",
                                                    "roleName": "signer",
                                                    "tabs": {
                                                        "signHereTabs": [
                                                            {
                                                                "xPosition": "116",
                                                                "yPosition": "702",
                                                                "tabLabel": "signature1",
                                                                "documentId": "1",
                                                                "pageNumber": "6"
                                                            },
                                                            {
                                                                "xPosition": "382",
                                                                "yPosition": "600",
                                                                "tabLabel": "signature3",
                                                                "documentId": "1",
                                                                "pageNumber": "24"
                                                            }
                                                        ],
                                                        "textTabs": [
                                                            {
                                                                "xPosition": "63",
                                                                "yPosition": "215",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "fname",
                                                                "value": "' . $request->fname . '"
                                                            },
                                                            {
                                                                "xPosition": "371",
                                                                "yPosition": "238",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "age",
                                                                "value": "' . $request->age . '"
                                                            },
                                                            {
                                                                "xPosition": "88",
                                                                "yPosition": "160",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "fname6",
                                                                "value": "' . $request->fname . '"
                                                            },
                                                            {
                                                                "xPosition": "390",
                                                                "yPosition": "161",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "fname7",
                                                                "value": "' . $request->nom_naissance . '"
                                                            },
                                                            {
                                                                "xPosition": "330",
                                                                "yPosition": "214",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "lname",
                                                                "value": "' . $request->lname . '"
                                                            },
                                                            {
                                                                "xPosition": "99",
                                                                "yPosition": "173",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "lname4",
                                                                "value": "' . $request->lname . '"
                                                            },
                                                            {
                                                                "xPosition": "111",
                                                                "yPosition": "239",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "datebird",
                                                                "value": "' . date("d/m/Y", strtotime($request->datebird)) . '"
                                                            },
                                                            {
                                                                "xPosition": "391",
                                                                "yPosition": "173",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "datebird3",
                                                                "value": "' . date("d/m/Y", strtotime($request->datebird)) . '"
                                                            },
                                                            {
                                                                "xPosition": "410",
                                                                "yPosition": "198",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "commune",
                                                                "value": "' . $request->commune_naissance . '"
                                                            },
                                                            {
                                                                "xPosition": "75",
                                                                "yPosition": "263",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "address",
                                                                "value": "' . $request->adresse . '"
                                                            },
                                                            {
                                                                "xPosition": "154",
                                                                "yPosition": "186",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "address3",
                                                                "value": "' . $request->adresse . '"
                                                            },
                                                            {
                                                                "xPosition": "118",
                                                                "yPosition": "572",
                                                                "documentId": "1",
                                                                "pageNumber": "6",
                                                                "tabLabel": "city",
                                                                "value": "' . $request->city . '"
                                                            },
                                                            {
                                                                "xPosition": "118",
                                                                "yPosition": "210",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "city5",
                                                                "value": "' . $request->city . '"
                                                            },
                                                            {
                                                                "xPosition": "345",
                                                                "yPosition": "530",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "city6",
                                                                "value": "' . $request->city . '"
                                                            },
                                                            {
                                                                "xPosition": "339",
                                                                "yPosition": "570",
                                                                "documentId": "1",
                                                                "pageNumber": "6",
                                                                "tabLabel": "sysdate",
                                                                "value": "' . date('d/m/Y') . '"
                                                            },
                                                            {
                                                                "xPosition": "328",
                                                                "yPosition": "547",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "sysdate3",
                                                                "value": "' . date('d/m/Y') . '"
                                                            },
                                                            {
                                                                "xPosition": "118",
                                                                "yPosition": "198",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "cp2",
                                                                "value": "' . $request->cp . '"
                                                            },
                                                            {
                                                                "xPosition": "70",
                                                                "yPosition": "312",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "mail",
                                                                "value": "' . $request->mail . '"
                                                            },
                                                            {
                                                                "xPosition": "90",
                                                                "yPosition": "353",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "statu_famille",
                                                                "value": "' . $request->statu_famille . '"
                                                            },
                                                            {
                                                                "xPosition": "149",
                                                                "yPosition": "367",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "avec_enfant",
                                                                "value": "' . $request->avec_enfant . '"
                                                            },
                                                            {
                                                                "xPosition": "219",
                                                                "yPosition": "378",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "nbr_pers_a_charger",
                                                                "value": "' . $nbr_pers_a_charger . '"
                                                            },
                                                            {
                                                                "xPosition": "90",
                                                                "yPosition": "425",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "situation_pro",
                                                                "value": "' . $request->situation_pro . '"
                                                            },
                                                            {
                                                                "xPosition": "377",
                                                                "yPosition": "223",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "mail3",
                                                                "value": "' . $request->mail . '"
                                                            },
                                                            {
                                                                "xPosition": "95",
                                                                "yPosition": "288",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "phone",
                                                                "value": "' . $request->phone . '"
                                                            },
                                                            {
                                                                "xPosition": "132",
                                                                "yPosition": "223",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "phone3",
                                                                "value": "' . $request->phone . '"
                                                            },
                                                            {
                                                                "xPosition": "336",
                                                                "yPosition": "492",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "bic",
                                                                "value": "' . ($request->bic !== null ? $request->bic : "--") . '"
                                                            },
                                                            {
                                                                "xPosition": "343",
                                                                "yPosition": "478",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "iban",
                                                                "value": "' . $request->iban . '"
                                                            },
                                                            {
                                                                "xPosition": "145",
                                                                "yPosition": "527",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "besoin1",
                                                                "value": "' . $request->besoin1 . '"
                                                            },
                                                            {
                                                                "xPosition": "172",
                                                                "yPosition": "540",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "besoin2",
                                                                "value": "' . $request->besoin2 . '"
                                                            },
                                                            {
                                                                "xPosition": "247",
                                                                "yPosition": "552",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "besoin3",
                                                                "value": "' . $request->besoin3 . '"
                                                            },
                                                            {
                                                                "xPosition": "266",
                                                                "yPosition": "565",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "besoin4",
                                                                "value": "' . $request->besoin4 . '"
                                                            },
                                                            {
                                                                "xPosition": "209",
                                                                "yPosition": "577",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "besoin5",
                                                                "value": "' . $request->besoin5 . '"
                                                            },
                                                            {
                                                                "xPosition": "157",
                                                                "yPosition": "589",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "besoin6",
                                                                "value": "' . $request->besoin6 . '"
                                                            },
                                                            {
                                                                "xPosition": "163",
                                                                "yPosition": "602",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "besoin7",
                                                                "value": "' . $request->besoin7 . '"
                                                            },
                                                            {
                                                                "xPosition": "130",
                                                                "yPosition": "615",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "besoin8",
                                                                "value": "' . $request->besoin8 . '"
                                                            },
                                                            {
                                                                "xPosition": "237",
                                                                "yPosition": "626",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "besoin9",
                                                                "value": "' . $request->besoin9 . '"
                                                            },
                                                            {
                                                                "xPosition": "286",
                                                                "yPosition": "665",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "besoin10",
                                                                "value": "' . $request->besoin10 . '"
                                                            },
                                                            {
                                                                "xPosition": "224",
                                                                "yPosition": "676",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "besoin11",
                                                                "value": "' . $request->besoin11 . '"
                                                            },
                                                            {
                                                                "xPosition": "327",
                                                                "yPosition": "687",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "besoin12",
                                                                "value": "' . $request->besoin12 . '"
                                                            },
                                                            {
                                                                "xPosition": "422",
                                                                "yPosition": "699",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "besoin13",
                                                                "value": "' . $request->besoin13 . '"
                                                            },
                                                            {
                                                                "xPosition": "91",
                                                                "yPosition": "736",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "etre_couvert",
                                                                "value": "' . $request->etre_couvert .'"
                                                            },
                                                            
                                                            {
                                                                "xPosition": "282",
                                                                "yPosition": "760",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "montant_de_cotisation",
                                                                "value": "' . $request->montant_de_cotisation . '"
                                                            },
                                                            {
                                                                "xPosition": "390",
                                                                "yPosition": "210",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "pays",
                                                                "value": "' .$request->pays_naissance . '"
                                                            },
                                                            {
                                                                "xPosition": "423",
                                                                "yPosition": "186",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "departement",
                                                                "value": "' .$request->departement_naissance . '"
                                                            },
                                                            {
                                                                "xPosition": "61",
                                                                "yPosition": "147",
                                                                "tabLabel": "gender",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "groupName": "gender",
                                                                "value": "' .$monsieur . '"
                                                            },
                                                            {
                                                                "xPosition": "127",
                                                                "yPosition": "601",
                                                                "documentId": "1",
                                                                "pageNumber": "6",
                                                                "tabLabel": "code",
                                                                "value": "' . $request->code . '"
                                                            },
                                                            {
                                                                "xPosition": "150",
                                                                "yPosition": "623",
                                                                "documentId": "1",
                                                                "pageNumber": "6",
                                                                "tabLabel": "dateenvoi",
                                                                "value":  "' . date("d/m/Y H:i:s", strtotime("+1 hours", strtotime($request->dateenvoie))) . '"
                                                            },
                                                            {
                                                                "xPosition": "186",
                                                                "yPosition": "266",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "etre_couvert2",
                                                                "value": "' . $request->etre_couvert .' euros"
                                                            },
                                                            {
                                                                "xPosition": "140",
                                                                "yPosition": "435",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "montant_de_cotisation2",
                                                                "value": "' . $request->montant_de_cotisation . '"
                                                            },
                                                            {
                                                                "xPosition": "358",
                                                                "yPosition": "658",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "code2",
                                                                "value": "' . $request->code . '"
                                                            },
                                                            {
                                                                "xPosition": "378",
                                                                "yPosition": "676",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "dateenvoi2",
                                                                "value":  "' . date("d/m/Y H:i:s", strtotime("+1 hours", strtotime($request->dateenvoie))) . '"
                                                            },
                                                    
                                                        
                                                            
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
                }else if($request->gender==2){
                    $data = '{
                        "emailBlurb": "Create an envelope with a templateId",
                        "emailSubject": "Mon Assurance GFO:'.$civilitee.' '.$request->fname.'",
                        "compositeTemplates": [
                            {
                                "serverTemplates": [
                                    {
                                        "sequence": "1",
                                        "templateId": "' . $template . '"
                                    }
                                ],
                                "inlineTemplates": [
                                    {
                                        "recipients": {
                                            "signers": [
                                                {
                                                    "email": "' . $request->mail . '",
                                                    "name": "' . $request->fname . '",
                                                    "recipientId": "2",
                                                    "roleName": "signer",
                                                    "tabs": {
                                                        "signHereTabs": [
                                                            {
                                                                "xPosition": "116",
                                                                "yPosition": "702",
                                                                "tabLabel": "signature1",
                                                                "documentId": "1",
                                                                "pageNumber": "6"
                                                            },
                                                            {
                                                                "xPosition": "382",
                                                                "yPosition": "600",
                                                                "tabLabel": "signature3",
                                                                "documentId": "1",
                                                                "pageNumber": "24"
                                                            }
                                                        ],
                                                        "textTabs": [
                                                            {
                                                                "xPosition": "63",
                                                                "yPosition": "215",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "fname",
                                                                "value": "' . $request->fname . '"
                                                            },
                                                            {
                                                                "xPosition": "371",
                                                                "yPosition": "238",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "age",
                                                                "value": "' . $request->age . '"
                                                            },
                                                            {
                                                                "xPosition": "88",
                                                                "yPosition": "160",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "fname6",
                                                                "value": "' . $request->fname . '"
                                                            },
                                                            {
                                                                "xPosition": "390",
                                                                "yPosition": "161",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "fname7",
                                                                "value": "' . $request->nom_naissance . '"
                                                            },
                                                            {
                                                                "xPosition": "330",
                                                                "yPosition": "214",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "lname",
                                                                "value": "' . $request->lname . '"
                                                            },
                                                            {
                                                                "xPosition": "99",
                                                                "yPosition": "173",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "lname4",
                                                                "value": "' . $request->lname . '"
                                                            },
                                                            {
                                                                "xPosition": "111",
                                                                "yPosition": "239",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "datebird",
                                                                "value": "' . date("d/m/Y", strtotime($request->datebird)) . '"
                                                            },
                                                            {
                                                                "xPosition": "391",
                                                                "yPosition": "173",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "datebird3",
                                                                "value": "' . date("d/m/Y", strtotime($request->datebird)) . '"
                                                            },
                                                            {
                                                                "xPosition": "410",
                                                                "yPosition": "198",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "commune",
                                                                "value": "' . $request->commune_naissance . '"
                                                            },
                                                            {
                                                                "xPosition": "75",
                                                                "yPosition": "263",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "address",
                                                                "value": "' . $request->adresse . '"
                                                            },
                                                            {
                                                                "xPosition": "154",
                                                                "yPosition": "186",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "address3",
                                                                "value": "' . $request->adresse . '"
                                                            },
                                                            {
                                                                "xPosition": "118",
                                                                "yPosition": "572",
                                                                "documentId": "1",
                                                                "pageNumber": "6",
                                                                "tabLabel": "city",
                                                                "value": "' . $request->city . '"
                                                            },
                                                            {
                                                                "xPosition": "118",
                                                                "yPosition": "210",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "city5",
                                                                "value": "' . $request->city . '"
                                                            },
                                                            {
                                                                "xPosition": "345",
                                                                "yPosition": "530",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "city6",
                                                                "value": "' . $request->city . '"
                                                            },
                                                            {
                                                                "xPosition": "339",
                                                                "yPosition": "570",
                                                                "documentId": "1",
                                                                "pageNumber": "6",
                                                                "tabLabel": "sysdate",
                                                                "value": "' . date('d/m/Y') . '"
                                                            },
                                                            {
                                                                "xPosition": "328",
                                                                "yPosition": "547",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "sysdate3",
                                                                "value": "' . date('d/m/Y') . '"
                                                            },
                                                            {
                                                                "xPosition": "118",
                                                                "yPosition": "198",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "cp2",
                                                                "value": "' . $request->cp . '"
                                                            },
                                                            {
                                                                "xPosition": "70",
                                                                "yPosition": "312",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "mail",
                                                                "value": "' . $request->mail . '"
                                                            },
                                                            {
                                                                "xPosition": "90",
                                                                "yPosition": "353",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "statu_famille",
                                                                "value": "' . $request->statu_famille . '"
                                                            },
                                                            {
                                                                "xPosition": "149",
                                                                "yPosition": "367",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "avec_enfant",
                                                                "value": "' . $request->avec_enfant . '"
                                                            },
                                                            {
                                                                "xPosition": "219",
                                                                "yPosition": "378",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "nbr_pers_a_charger",
                                                                "value": "' . $nbr_pers_a_charger . '"
                                                            },
                                                            {
                                                                "xPosition": "90",
                                                                "yPosition": "425",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "situation_pro",
                                                                "value": "' . $request->situation_pro . '"
                                                            },
                                                            {
                                                                "xPosition": "377",
                                                                "yPosition": "223",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "mail3",
                                                                "value": "' . $request->mail . '"
                                                            },
                                                            {
                                                                "xPosition": "95",
                                                                "yPosition": "288",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "phone",
                                                                "value": "' . $request->phone . '"
                                                            },
                                                            {
                                                                "xPosition": "132",
                                                                "yPosition": "223",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "phone3",
                                                                "value": "' . $request->phone . '"
                                                            },
                                                            {
                                                                "xPosition": "336",
                                                                "yPosition": "492",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "bic",
                                                                "value": "' . ($request->bic !== null ? $request->bic : "--") . '"
                                                            },
                                                            {
                                                                "xPosition": "343",
                                                                "yPosition": "478",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "iban",
                                                                "value": "' . $request->iban . '"
                                                            },
                                                            {
                                                                "xPosition": "145",
                                                                "yPosition": "527",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "besoin1",
                                                                "value": "' . $request->besoin1 . '"
                                                            },
                                                            {
                                                                "xPosition": "172",
                                                                "yPosition": "540",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "besoin2",
                                                                "value": "' . $request->besoin2 . '"
                                                            },
                                                            {
                                                                "xPosition": "247",
                                                                "yPosition": "552",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "besoin3",
                                                                "value": "' . $request->besoin3 . '"
                                                            },
                                                            {
                                                                "xPosition": "266",
                                                                "yPosition": "565",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "besoin4",
                                                                "value": "' . $request->besoin4 . '"
                                                            },
                                                            {
                                                                "xPosition": "209",
                                                                "yPosition": "577",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "besoin5",
                                                                "value": "' . $request->besoin5 . '"
                                                            },
                                                            {
                                                                "xPosition": "157",
                                                                "yPosition": "589",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "besoin6",
                                                                "value": "' . $request->besoin6 . '"
                                                            },
                                                            {
                                                                "xPosition": "163",
                                                                "yPosition": "602",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "besoin7",
                                                                "value": "' . $request->besoin7 . '"
                                                            },
                                                            {
                                                                "xPosition": "130",
                                                                "yPosition": "615",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "besoin8",
                                                                "value": "' . $request->besoin8 . '"
                                                            },
                                                            {
                                                                "xPosition": "237",
                                                                "yPosition": "626",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "besoin9",
                                                                "value": "' . $request->besoin9 . '"
                                                            },
                                                            {
                                                                "xPosition": "286",
                                                                "yPosition": "665",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "besoin10",
                                                                "value": "' . $request->besoin10 . '"
                                                            },
                                                            {
                                                                "xPosition": "224",
                                                                "yPosition": "676",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "besoin11",
                                                                "value": "' . $request->besoin11 . '"
                                                            },
                                                            {
                                                                "xPosition": "327",
                                                                "yPosition": "687",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "besoin12",
                                                                "value": "' . $request->besoin12 . '"
                                                            },
                                                            {
                                                                "xPosition": "422",
                                                                "yPosition": "699",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "besoin13",
                                                                "value": "' . $request->besoin13 . '"
                                                            },
                                                            {
                                                                "xPosition": "91",
                                                                "yPosition": "736",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "etre_couvert",
                                                                "value": "' . $request->etre_couvert .'"
                                                            },
                                                            
                                                            {
                                                                "xPosition": "282",
                                                                "yPosition": "760",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "montant_de_cotisation",
                                                                "value": "' . $request->montant_de_cotisation . '"
                                                            },
                                                            {
                                                                "xPosition": "390",
                                                                "yPosition": "210",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "pays",
                                                                "value": "' .$request->pays_naissance . '"
                                                            },
                                                            {
                                                                "xPosition": "423",
                                                                "yPosition": "186",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "departement",
                                                                "value": "' .$request->departement_naissance . '"
                                                            },
                                                            {
                                                                "xPosition": "111",
                                                                "yPosition": "147",
                                                                "tabLabel": "gender",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "groupName": "gender",
                                                                "value": "' .$madame . '"
                                                            },
                                                            {
                                                                "xPosition": "127",
                                                                "yPosition": "601",
                                                                "documentId": "1",
                                                                "pageNumber": "6",
                                                                "tabLabel": "code",
                                                                "value": "' . $request->code . '"
                                                            },
                                                            {
                                                                "xPosition": "150",
                                                                "yPosition": "623",
                                                                "documentId": "1",
                                                                "pageNumber": "6",
                                                                "tabLabel": "dateenvoi",
                                                                "value":  "' . date("d/m/Y H:i:s", strtotime("+1 hours", strtotime($request->dateenvoie))) . '"
                                                            },
                                                            {
                                                                "xPosition": "186",
                                                                "yPosition": "266",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "etre_couvert2",
                                                                "value": "' . $request->etre_couvert .' euros"
                                                            },
                                                            {
                                                                "xPosition": "140",
                                                                "yPosition": "435",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "montant_de_cotisation2",
                                                                "value": "' . $request->montant_de_cotisation . '"
                                                            },
                                                            {
                                                                "xPosition": "358",
                                                                "yPosition": "658",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "code2",
                                                                "value": "' . $request->code . '"
                                                            },
                                                            {
                                                                "xPosition": "378",
                                                                "yPosition": "676",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "dateenvoi2",
                                                                "value":  "' . date("d/m/Y H:i:s", strtotime("+1 hours", strtotime($request->dateenvoie))) . '"
                                                            },
                                                    
                                                        
                                                            
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

                }
                
               
            }else{
                $data = '{
                    "emailBlurb": "Create an envelope with a templateId",
                    "emailSubject": "Mon Assurance Facture:'. $civilitee .' '.$request->fname.'",
                    "compositeTemplates": [
                        {
                            "serverTemplates": [
                                {
                                    "sequence": "1",
                                    "templateId": "' . $template . '"
                                }
                            ],
                            "inlineTemplates": [
                                {
                                    "recipients": {
                                        "signers": [
                                            {
                                                "email": "' . $request->mail . '",
                                                "name": "' . $request->fname . '",
                                                "recipientId": "2",
                                                "roleName": "signer",
                                                "tabs": {
                                                    "signHereTabs": [
                                                        {
                                                            "xPosition": "93",
                                                            "yPosition": "726",
                                                            "tabLabel": "signature1",
                                                            "documentId": "1",
                                                            "pageNumber": "4"
                                                        },
                                                        {
                                                            "xPosition": "317",
                                                            "yPosition": "521",
                                                            "tabLabel": "signature2",
                                                            "documentId": "1",
                                                            "pageNumber": "9"
                                                        },
                                                        {
                                                            "xPosition": "439",
                                                            "yPosition": "772",
                                                            "tabLabel": "signature3",
                                                            "documentId": "1",
                                                            "pageNumber": "9"
                                                        }
                                                    ],
                                                    "textTabs": [
                                                        {
                                                            "xPosition": "51",
                                                            "yPosition": "369",
                                                            "documentId": "1",
                                                            "pageNumber": "3",
                                                            "tabLabel": "fname",
                                                            "value": "' . $request->fname . '"
                                                        },
                                                        {
                                                            "xPosition": "373",
                                                            "yPosition": "737",
                                                            "documentId": "1",
                                                            "pageNumber": "6",
                                                            "tabLabel": "fname2",
                                                            "value": "' . $request->fname . '"
                                                        },
                                                        {
                                                            "xPosition": "59",
                                                            "yPosition": "135",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "fname3",
                                                            "value": "' . $request->fname . '"
                                                        },
                                                        {
                                                            "xPosition": "182",
                                                            "yPosition": "727",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "fname4",
                                                            "value": "' . $request->fname . '"
                                                        },
                                                        {
                                                            "xPosition": "255",
                                                            "yPosition": "369",
                                                            "documentId": "1",
                                                            "pageNumber": "3",
                                                            "tabLabel": "lname",
                                                            "value": "' . $request->lname . '"
                                                        },
                                                        {
                                                            "xPosition": "455",
                                                            "yPosition": "737",
                                                            "documentId": "1",
                                                            "pageNumber": "6",
                                                            "tabLabel": "lname2",
                                                            "value": "' . $request->lname . '"
                                                        },
                                                        {
                                                            "xPosition": "261",
                                                            "yPosition": "134",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "lname3",
                                                            "value": "' . $request->lname . '"
                                                        },
                                                        {
                                                            "xPosition": "374",
                                                            "yPosition": "726",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "lname4",
                                                            "value": "' . $request->lname . '"
                                                        },
                                                        {
                                                            "xPosition": "521",
                                                            "yPosition": "370",
                                                            "documentId": "1",
                                                            "pageNumber": "3",
                                                            "tabLabel": "datebird",
                                                            "value": "' . date("d/m/Y", strtotime($request->datebirth)) . '"
                                                        },
                                                        {
                                                            "xPosition": "457",
                                                            "yPosition": "134",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "datebird2",
                                                            "value": "' . date("d/m/Y", strtotime($request->datebirth)) . '"
                                                        },
                                                        {
                                                            "xPosition": "59",
                                                            "yPosition": "384",
                                                            "documentId": "1",
                                                            "pageNumber": "3",
                                                            "tabLabel": "address",
                                                            "value": "' . $request->adresse . '"
                                                        },
                                                        {
                                                            "xPosition": "347",
                                                            "yPosition": "756",
                                                            "documentId": "1",
                                                            "pageNumber": "6",
                                                            "tabLabel": "address2",
                                                            "value": "' . $request->adresse . '"
                                                        },
                                                        {
                                                            "xPosition": "71",
                                                            "yPosition": "155",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "address3",
                                                            "value": "' . $request->adresse . '"
                                                        },
                                                        {
                                                            "xPosition": "191",
                                                            "yPosition": "743",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "address4",
                                                            "value": "' . $request->adresse . '"
                                                        },
                                                        {
                                                            "xPosition": "282",
                                                            "yPosition": "385",
                                                            "documentId": "1",
                                                            "pageNumber": "3",
                                                            "tabLabel": "city",
                                                            "value": "' . $request->city . '"
                                                        },
                                                        {
                                                            "xPosition": "43",
                                                            "yPosition": "692",
                                                            "documentId": "1",
                                                            "pageNumber": "4",
                                                            "tabLabel": "city2",
                                                            "value": "' . $request->city . '"
                                                        },
                                                        {
                                                            "xPosition": "453",
                                                            "yPosition": "778",
                                                            "documentId": "1",
                                                            "pageNumber": "6",
                                                            "tabLabel": "city3",
                                                            "value": "' . $request->city . '"
                                                        },
                                                        {
                                                            "xPosition": "57",
                                                            "yPosition": "175",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "city4",
                                                            "value": "' . $request->city . '"
                                                        },
                                                        {
                                                            "xPosition": "57",
                                                            "yPosition": "532",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "city5",
                                                            "value": "' . $request->city . '"
                                                        },
                                                        {
                                                            "xPosition": "195",
                                                            "yPosition": "775",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "city6",
                                                            "value": "' . $request->city . '"
                                                        },
                                                        {
                                                            "xPosition": "38",
                                                            "yPosition": "709",
                                                            "documentId": "1",
                                                            "pageNumber": "4",
                                                            "tabLabel": "sysdate",
                                                            "value": "' . date('d/m/Y') . '"
                                                        },
                                                        {
                                                            "xPosition": "366",
                                                            "yPosition": "797",
                                                            "documentId": "1",
                                                            "pageNumber": "6",
                                                            "tabLabel": "sysdate2",
                                                            "value": "' . date('d/m/Y') . '"
                                                        },
                                                        {
                                                            "xPosition": "413",
                                                            "yPosition": "115",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "sysdate3",
                                                            "value": "' . date('d/m/Y') . '"
                                                        },
                                                        {
                                                            "xPosition": "514",
                                                            "yPosition": "531",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "sysdate4",
                                                            "value": "' . date('d/m/Y') . '"
                                                        },
                                                        {
                                                            "xPosition": "184",
                                                            "yPosition": "789",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "sysdate5",
                                                            "value": "' . date('d/m/Y') . '"
                                                        },
                                                        {
                                                            "xPosition": "494",
                                                            "yPosition": "385",
                                                            "documentId": "1",
                                                            "pageNumber": "3",
                                                            "tabLabel": "cp",
                                                            "value": "' . $request->cp . '"
                                                        },
                                                        {
                                                            "xPosition": "365",
                                                            "yPosition": "777",
                                                            "documentId": "1",
                                                            "pageNumber": "6",
                                                            "tabLabel": "cp2",
                                                            "value": "' . $request->cp . '"
                                                        },
                                                        {
                                                            "xPosition": "513",
                                                            "yPosition": "155",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "cp3",
                                                            "value": "' . $request->cp . '"
                                                        },
                                                        {
                                                            "xPosition": "47",
                                                            "yPosition": "401",
                                                            "documentId": "1",
                                                            "pageNumber": "3",
                                                            "tabLabel": "mail",
                                                            "value": "' . $request->mail . '"
                                                        },
                                                        {
                                                            "xPosition": "63",
                                                            "yPosition": "194",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "mail2",
                                                            "value": "' . $request->mail . '"
                                                        },
                                                        {
                                                            "xPosition": "409",
                                                            "yPosition": "400",
                                                            "documentId": "1",
                                                            "pageNumber": "3",
                                                            "tabLabel": "phone",
                                                            "value": "' . $request->phone . '"
                                                        },
                                                        {
                                                            "xPosition": "470",
                                                            "yPosition": "175",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "phone2",
                                                            "value": "' . $request->phone . '"
                                                        },
                                                        {
                                                            "xPosition": "243",
                                                            "yPosition": "759",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "phone3",
                                                            "value": "' . $request->phone . '"
                                                        },
                                                        {
                                                            "xPosition": "177",
                                                            "yPosition": "673",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "bic",
                                                            "value": "' . ($request->bic !== null ? $request->bic : "--") . '"
                                                        },
                                                        {
                                                            "xPosition": "183",
                                                            "yPosition": "689",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "iban",
                                                            "value": "' . $request->iban . '"
                                                        },
                                                        {
                                                            "xPosition": "47",
                                                            "yPosition": "464",
                                                            "documentId": "1",
                                                            "pageNumber": "3",
                                                            "tabLabel": "besoin1",
                                                            "value": "' . $request->besoin1 . '"
                                                        },
                                                        {
                                                            "xPosition": "47",
                                                            "yPosition": "502",
                                                            "documentId": "1",
                                                            "pageNumber": "3",
                                                            "tabLabel": "besoin2",
                                                            "value": "' . $request->besoin2 . '"
                                                        },
                                                        {
                                                            "xPosition": "45",
                                                            "yPosition": "543",
                                                            "documentId": "1",
                                                            "pageNumber": "3",
                                                            "tabLabel": "besoin3",
                                                            "value": "' . $request->besoin3 . '"
                                                        },
                                                        {
                                                            "xPosition": "77",
                                                            "yPosition": "80",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "distributeur",
                                                            "value": "Bailey Assurances"
                                                        },
                                                        {
                                                            "xPosition": "248",
                                                            "yPosition": "80",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "conseiller",
                                                            "value": "' . $operatorid->first_name . ' ' . $lettrefirst . '"
                                                        },
                                                        {
                                                            "xPosition": "452",
                                                            "yPosition": "79",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "xvalue",
                                                            "value": "' . $request->xvalue . '"
                                                        },
                                                        {
                                                            "xPosition": "58",
                                                            "yPosition": "109",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "gender",
                                                            "value": "' . $civilitee . '"
                                                        },
                                                        {
                                                            "xPosition": "68",
                                                            "yPosition": "570",
                                                            "documentId": "1",
                                                            "pageNumber": "3",
                                                            "tabLabel": "comment",
                                                            "value": "' . ($request->comment !== null ? $request->comment : "--") . '"
                                                        },
                                                        {
                                                            "xPosition": "14",
                                                            "yPosition": "802",
                                                            "documentId": "1",
                                                            "pageNumber": "6",
                                                            "tabLabel": "option1",
                                                            "value": "' . ($request->option1 !== null ? $request->option1 : "--") . '"
                                                        },
                                                        {
                                                            "xPosition": "57",
                                                            "yPosition": "601",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "option11",
                                                            "value": "' .($request->option1 !== null ? $request->option1 : "--") . '"
                                                        },
                                                        {
                                                            "xPosition": "170",
                                                            "yPosition": "802",
                                                            "documentId": "1",
                                                            "pageNumber": "6",
                                                            "tabLabel": "option2",
                                                            "value": "' . ($request->option2 !== null ? $request->option2 : "--") . '"
                                                        },
                                                        {
                                                            "xPosition": "397",
                                                            "yPosition": "599",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "option22",
                                                            "value": "' .($request->option2 !== null ? $request->option2 : "--") . '"
                                                        },
                                                        {
                                                            "xPosition": "43",
                                                            "yPosition": "211",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "bgtxt1",
                                                            "value": "' . ($request->bgtxt1 !== null ? $request->bgtxt1 : "--") . '"
                                                        },
                                                        {
                                                            "xPosition": "44",
                                                            "yPosition": "226",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "bgtxt2",
                                                            "value": "' . ($request->bgtxt2 !== null ? $request->bgtxt2 : "--") . '"
                                                        },
                                                        {
                                                            "xPosition": "55",
                                                            "yPosition": "767",
                                                            "documentId": "1",
                                                            "pageNumber": "4",
                                                            "tabLabel": "code",
                                                            "value": "' . ($request->code !== null ? $request->code : "--") . '"
                                                        },
                                                        {
                                                            "xPosition": "52",
                                                            "yPosition": "786",
                                                            "documentId": "1",
                                                            "pageNumber": "4",
                                                            "tabLabel": "dateenvoie",
                                                            "value":  "' . date("d/m/Y H:i:s", strtotime("+1 hours", strtotime($request->dateenvoie))) . '"
                                                        },
                                                        {
                                                            "xPosition": "218",
                                                            "yPosition": "658",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "cerft",
                                                            "value": "√ Je certifie être le titulaire de l\'Iban/Bic suivant"
                                                        },
                                                        {
                                                            "xPosition": "40",
                                                            "yPosition": "776",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "reccurent",
                                                            "value": "Le √ ' . $request->reccurent . '"
                                                        },
                                                    ],
                                                    "checkboxTabs": [
                                                        {
                                                          "tabLabel": "checkbox",
                                                          "xPosition": "29",
                                                          "yPosition": "489",
                                                          "documentId": "1",
                                                          "pageNumber": "9",
                                                          "required":true,
                                                          "tabGroupLabels": [
                                                            "checkbox group"
                                                          ]
                                                        },
                                                    ],
                                                    "tabGroups": [
                                                        {
                                                          "groupLabel": "checkbox group",
                                                          "groupRule": "SelectAtLeast",
                                                          "minimumRequired": "1",
                                                          "maximumAllowed": "1",
                                                          "validationMessage": "Please check to indicate your agreement",
                                                          "tabScope": "document",
                                                          "documentId": "1",
                                                          "pageNumber": "9"
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
            }
        
        

            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

            //for debug only!
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

            $resp = curl_exec($curl);
            curl_close($curl);

            $result = json_decode($resp, true);

            if ($result) {
                return response()->json([
                    'success' => true,
                    'message' => "Vous avez reçu par email votre bulletin d'adhésion à signer par Docusign",
                    'result' => $result,
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e,
            ]);
        }
    }

    function signDocument2(Request $request)
    {
        try {
            $userid = Auth::user()->id;

            $operatorid = Operator::select('last_name', 'first_name')
                ->where('user_id', $userid)
                ->first('id');

            $lettrefirst = substr($operatorid->last_name, 0, 1) ?? null;

            $num = rand(1000, 9999);
            
            
            $yy = date('Y');
            $mm = date('m');

            $val1 = '';
            $val2 = '';
           
            $right_val = $val1 . ' ' . $val2;

            $company_id = $request->company_id;
            // dd($company_id);
            if ($company_id==101 ||$company_id==102) {
                // dd("hannnnnnnni");
                // $template="c1fa04b2-7acf-43c3-a2f4-c354c27b42dd";
                $template = '694b4c8e-a9b5-4d02-a567-f39e18c1f88c';
            } elseif ($company_id==104) {
                // $template="18091d9f-ef63-4247-8a0b-4b6f8b1fc627";
                $template = '944c42cd-e558-47c3-adff-b334c48d32c6';
            }elseif ($company_id==105) {
                // $template="18091d9f-ef63-4247-8a0b-4b6f8b1fc627";
                $template = 'ea09cc2c-224c-47c4-b007-da7cf580452e';
            }

            $this->args = $this->getTemplateArgs();
            // dd($this->args);
            $args = $this->args;

            // dd($this->args['ds_access_token']);

            $envelope_args = $args['envelope_args'];
            // dd($this->args['ds_access_token']);

            # Create the envelope request object
            // $envelope_definition = $this->make_envelope($args["envelope_args"],$this->args['ds_access_token']);
            // $template_id=$envelope_definition->templateId;

            $url = 'https://eu.docusign.net/restapi/v2.1/accounts/' . '3df36e73-cd9f-49cb-b337-9519ea7239c4' . '/envelopes';

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            $headers = ['Accept: application/json', 'Authorization: Bearer ' . $this->args['ds_access_token'], 'Content-Type: application/json'];

            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            $client_id=$request->client_id;
            $contract_id=$request->contract_id;
            $client=Client::find($client_id);
            $contract=Contract::find($contract_id);
            $naissance=null;
            // if ($company_id==105) {
            //     $naissance=Naissance::where('id_client',$client_id)->where('id_contract',$contract_id)->first();
            // }
            // dd($naissance);

            $civilitee='';
            // dd($request->gender);
            if ($client->civility==1) {
                $civilitee='M';
            } else {
                $civilitee='Mme';
            }
            // dd($civilitee);
            if ($company_id == 104) {
                $data = '{
                    "emailBlurb": "Create an envelope with a templateId",
                    "emailSubject": "Mon Assurance PGE:'. $civilitee .' '.$client->first_name.'",
                    "compositeTemplates": [
                        {
                            "serverTemplates": [
                                {
                                    "sequence": "1",
                                    "templateId": "' . $template . '"
                                }
                            ],
                            "inlineTemplates": [
                                {
                                    "recipients": {
                                        "signers": [
                                            {
                                                "email": "' . $contract->email . '",
                                                "name": "' . $client->first_name . '",
                                                "recipientId": "2",
                                                "roleName": "signer",
                                                "tabs": {
                                                    "signHereTabs": [
                                                        {
                                                            "xPosition": "96",
                                                            "yPosition": "730",
                                                            "tabLabel": "signature1",
                                                            "documentId": "1",
                                                            "pageNumber": "4"
                                                        },
                                                        {
                                                            "xPosition": "342",
                                                            "yPosition": "563",
                                                            "documentId": "1",
                                                            "tabLabel": "signature3",
                                                            "pageNumber": "10"
                                                        },
                                                        {
                                                            "xPosition": "466",
                                                            "yPosition": "770",
                                                            "documentId": "1",
                                                            "tabLabel": "signature4",
                                                            "pageNumber": "10"
                                                        }
                                                    ],
                                                    "textTabs": [
                                                        {
                                                            "xPosition": "50",
                                                            "yPosition": "353",
                                                            "documentId": "1",
                                                            "pageNumber": "3",
                                                            "tabLabel": "fname",
                                                            "value": "' . $client->first_name . '"
                                                        },
                                                        {
                                                            "xPosition": "374",
                                                            "yPosition": "734",
                                                            "documentId": "1",
                                                            "pageNumber": "7",
                                                            "tabLabel": "fname2",
                                                            "value": "' . $client->first_name . '"
                                                        },
                                                        {
                                                            "xPosition": "180",
                                                            "yPosition": "727",
                                                            "documentId": "1",
                                                            "pageNumber": "10",
                                                            "tabLabel": "fname4",
                                                            "value": "' . $client->first_name . '"
                                                        },
                                                        {
                                                            "xPosition": "58",
                                                            "yPosition": "134",
                                                            "documentId": "1",
                                                            "pageNumber": "10",
                                                            "tabLabel": "fname3",
                                                            "value": "' . $client->first_name . '"
                                                        },
                                                        {
                                                            "xPosition": "256",
                                                            "yPosition": "355",
                                                            "documentId": "1",
                                                            "pageNumber": "3",
                                                            "tabLabel": "lname",
                                                            "value": "' . $client->last_name . '"
                                                        },
                                                        {
                                                            "xPosition": "459",
                                                            "yPosition": "734",
                                                            "documentId": "1",
                                                            "pageNumber": "7",
                                                            "tabLabel": "lname2",
                                                            "value": "' . $client->last_name . '"
                                                        },
                                                        {
                                                            "xPosition": "254",
                                                            "yPosition": "134",
                                                            "documentId": "1",
                                                            "pageNumber": "10",
                                                            "tabLabel": "lname3",
                                                            "value": "' . $client->last_name . '"
                                                        },
                                                        {
                                                            "xPosition": "375",
                                                            "yPosition": "728",
                                                            "documentId": "1",
                                                            "pageNumber": "10",
                                                            "tabLabel": "lname4",
                                                            "value": "' . $client->last_name . '"
                                                        },
                                                        {
                                                            "xPosition": "522",
                                                            "yPosition": "355",
                                                            "documentId": "1",
                                                            "pageNumber": "3",
                                                            "tabLabel": "datebird",
                                                            "value": "' . date("d/m/Y", strtotime($client->date_of_birth)) . '"
                                                        },
                                                        {
                                                            "xPosition": "452",
                                                            "yPosition": "134",
                                                            "documentId": "1",
                                                            "pageNumber": "10",
                                                            "tabLabel": "datebird2",
                                                            "value": "' . date("d/m/Y", strtotime($client->date_of_birth)) . '"
                                                        },
                                                        {
                                                            "xPosition": "61",
                                                            "yPosition": "370",
                                                            "documentId": "1",
                                                            "pageNumber": "3",
                                                            "tabLabel": "address",
                                                            "value": "' . $contract->address . '"
                                                        },
                                                        {
                                                            "xPosition": "348",
                                                            "yPosition": "755",
                                                            "documentId": "1",
                                                            "pageNumber": "7",
                                                            "tabLabel": "address2",
                                                            "value": "' . $contract->address . '"
                                                        },
                                                        {
                                                            "xPosition": "71",
                                                            "yPosition": "154",
                                                            "documentId": "1",
                                                            "pageNumber": "10",
                                                            "tabLabel": "address3",
                                                            "value": "' . $contract->address . '"
                                                        },
                                                        {
                                                            "xPosition": "191",
                                                            "yPosition": "744",
                                                            "documentId": "1",
                                                            "pageNumber": "10",
                                                            "tabLabel": "address4",
                                                            "value": "' . $contract->address . '"
                                                        },
                                                        {
                                                            "xPosition": "280",
                                                            "yPosition": "371",
                                                            "documentId": "1",
                                                            "pageNumber": "3",
                                                            "tabLabel": "city",
                                                            "value": "' . $contract->city_name . '"
                                                        },
                                                        {
                                                            "xPosition": "41",
                                                            "yPosition": "691",
                                                            "documentId": "1",
                                                            "pageNumber": "4",
                                                            "tabLabel": "city2",
                                                            "value": "' . $contract->city_name . '"
                                                        },
                                                        {
                                                            "xPosition": "451",
                                                            "yPosition": "78",
                                                            "documentId": "1",
                                                            "pageNumber": "10",
                                                            "tabLabel": "xvalue",
                                                            "value": "' . $contract->contract_number  . '"
                                                        },
                                                        {
                                                            "xPosition": "468",
                                                            "yPosition": "775",
                                                            "documentId": "1",
                                                            "pageNumber": "7",
                                                            "tabLabel": "city3",
                                                            "value": "' . $contract->city_name . '"
                                                        },
                                                        {
                                                            "xPosition": "58",
                                                            "yPosition": "175",
                                                            "documentId": "1",
                                                            "pageNumber": "10",
                                                            "tabLabel": "city4",
                                                            "value": "' . $contract->city_name . '"
                                                        },
                                                        {
                                                            "xPosition": "59",
                                                            "yPosition": "571",
                                                            "documentId": "1",
                                                            "pageNumber": "10",
                                                            "tabLabel": "city5",
                                                            "value": "' . $contract->city_name . '"
                                                        },
                                                        {
                                                            "xPosition": "195",
                                                            "yPosition": "776",
                                                            "documentId": "1",
                                                            "pageNumber": "10",
                                                            "tabLabel": "city6",
                                                            "value": "' . $contract->city_name . '"
                                                        },
                                                        {
                                                            "xPosition": "40",
                                                            "yPosition": "707",
                                                            "documentId": "1",
                                                            "pageNumber": "4",
                                                            "tabLabel": "sysdate",
                                                            "value": "' . date('d/m/Y') . '"
                                                        },
                                                        {
                                                            "xPosition": "216",
                                                            "yPosition": "657",
                                                            "documentId": "1",
                                                            "pageNumber": "10",
                                                            "tabLabel": "cerft",
                                                            "value": "√ Je certifie être le titulaire de l\'Iban/Bic suivant "
                                                        },
                                                        {
                                                            "xPosition": "365",
                                                            "yPosition": "795",
                                                            "documentId": "1",
                                                            "pageNumber": "7",
                                                            "tabLabel": "sysdate2",
                                                            "value": "' . date('d/m/Y') . '"
                                                        },
                                                        {
                                                            "xPosition": "411",
                                                            "yPosition": "114",
                                                            "documentId": "1",
                                                            "pageNumber": "10",
                                                            "tabLabel": "sysdate3",
                                                            "value": "' . date('d/m/Y') . '"
                                                        },
                                                        {
                                                            "xPosition": "529",
                                                            "yPosition": "570",
                                                            "documentId": "1",
                                                            "pageNumber": "10",
                                                            "tabLabel": "sysdate4",
                                                            "value": "' . date('d/m/Y') . '"
                                                        },
                                                        {
                                                            "xPosition": "183",
                                                            "yPosition": "787",
                                                            "documentId": "1",
                                                            "pageNumber": "10",
                                                            "tabLabel": "sysdate5",
                                                            "value": "' . date('d/m/Y') . '"
                                                        },
                                                        {
                                                            "xPosition": "492",
                                                            "yPosition": "372",
                                                            "documentId": "1",
                                                            "pageNumber": "3",
                                                            "tabLabel": "cp",
                                                            "value": "' . $contract->postal_code . '"
                                                        },
                                                        {
                                                            "xPosition": "363",
                                                            "yPosition": "775",
                                                            "documentId": "1",
                                                            "pageNumber": "7",
                                                            "tabLabel": "cp2",
                                                            "value": "' . $contract->postal_code . '"
                                                        },
                                                        {
                                                            "xPosition": "512",
                                                            "yPosition": "154",
                                                            "documentId": "1",
                                                            "pageNumber": "10",
                                                            "tabLabel": "cp3",
                                                            "value": "' . $contract->postal_code . '"
                                                        },
                                                        {
                                                            "xPosition": "47",
                                                            "yPosition": "387",
                                                            "documentId": "1",
                                                            "pageNumber": "3",
                                                            "tabLabel": "mail",
                                                            "value": "' . $contract->email . '"
                                                        },
                                                        {
                                                            "xPosition": "64",
                                                            "yPosition": "194",
                                                            "documentId": "1",
                                                            "pageNumber": "10",
                                                            "tabLabel": "mail2",
                                                            "value": "' . $contract->email . '"
                                                        },
                                                        {
                                                            "xPosition": "411",
                                                            "yPosition": "387",
                                                            "documentId": "1",
                                                            "pageNumber": "3",
                                                            "tabLabel": "phone",
                                                            "value": "' . $contract->mobile_phone . '"
                                                        },
                                                        {
                                                            "xPosition": "470",
                                                            "yPosition": "174",
                                                            "documentId": "1",
                                                            "pageNumber": "10",
                                                            "tabLabel": "phone2",
                                                            "value": "' . $contract->mobile_phone . '"
                                                        },
                                                        {
                                                            "xPosition": "242",
                                                            "yPosition": "758",
                                                            "documentId": "1",
                                                            "pageNumber": "10",
                                                            "tabLabel": "phone3",
                                                            "value": "' . $contract->mobile_phone . '"
                                                        },
                                                        {
                                                            "xPosition": "177",
                                                            "yPosition": "673",
                                                            "documentId": "1",
                                                            "pageNumber": "10",
                                                            "tabLabel": "bic",
                                                            "value": "' .($contract->bic_swift !== null ? $contract->bic_swift : "--") . '"
                                                        },
                                                        {
                                                            "xPosition": "182",
                                                            "yPosition": "688",
                                                            "documentId": "1",
                                                            "pageNumber": "10",
                                                            "tabLabel": "iban",
                                                            "value": "' . $contract->iban . '"
                                                        },
                                                        {
                                                            "xPosition": "34",
                                                            "yPosition": "454",
                                                            "documentId": "1",
                                                            "pageNumber": "3",
                                                            "tabLabel": "besoin1",
                                                            "value": "' . $request->besoin1 . '"
                                                        },
                                                        {
                                                            "xPosition": "34",
                                                            "yPosition": "492",
                                                            "documentId": "1",
                                                            "pageNumber": "3",
                                                            "tabLabel": "besoin2",
                                                            "value": "' . $request->besoin2 . '"
                                                        },
                                                        {
                                                            "xPosition": "34",
                                                            "yPosition": "531",
                                                            "documentId": "1",
                                                            "pageNumber": "3",
                                                            "tabLabel": "besoin3",
                                                            "value": "' . $request->besoin3 . '"
                                                        },
                                                        {
                                                            "xPosition": "78",
                                                            "yPosition": "77",
                                                            "documentId": "1",
                                                            "pageNumber": "10",
                                                            "tabLabel": "distributeur",
                                                            "value": "Bailey Assurances"
                                                        },
                                                        {
                                                            "xPosition": "246",
                                                            "yPosition": "77",
                                                            "documentId": "1",
                                                            "pageNumber": "10",
                                                            "tabLabel": "conseiller",
                                                            "value": "' . $operatorid->first_name . ' ' . $lettrefirst . '"
                                                        },
                                                        {
                                                            "xPosition": "63",
                                                            "yPosition": "107",
                                                            "documentId": "1",
                                                            "pageNumber": "10",
                                                            "tabLabel": "gender",
                                                            "value": "' . $civilitee . '"
                                                        },
                                                        {
                                                            "xPosition": "69",
                                                            "yPosition": "553",
                                                            "documentId": "1",
                                                            "pageNumber": "3",
                                                            "tabLabel": "comment",
                                                            "value": "' . ($request->comment !== null ? $request->comment : "--") . '"
                                                        },
                                                        {
                                                            "xPosition": "51",
                                                            "yPosition": "766",
                                                            "documentId": "1",
                                                            "pageNumber": "4",
                                                            "tabLabel": "code",
                                                            "value": "' . ($request->code !== null ? $request->code : "--") . '"
                                                        },
                                                        {
                                                            "xPosition": "51",
                                                            "yPosition": "784",
                                                            "documentId": "1",
                                                            "pageNumber": "4",
                                                            "tabLabel": "dateenvoie",
                                                            "value":  "' . date("d/m/Y H:i:s", strtotime("+1 hours", strtotime($request->dateenvoie))) . '"
                                                        },
                                                        {
                                                            "xPosition": "216",
                                                            "yPosition": "657",
                                                            "documentId": "1",
                                                            "pageNumber": "10",
                                                            "tabLabel": "cerft",
                                                            "value": "√ Je certifie être le titulaire de l\'Iban/Bic suivant"
                                                        },
                                                        {
                                                            "xPosition": "42",
                                                            "yPosition": "776",
                                                            "documentId": "1",
                                                            "pageNumber": "10",
                                                            "tabLabel": "reccurent",
                                                            "value": "Le √ ' . $request->reccurent  . '"
                                                        },
                                                    ],
                                                    "checkboxTabs": [
                                                        {
                                                            "tabLabel": "checkbox",
                                                            "xPosition": "30",
                                                            "yPosition": "529",
                                                            "documentId": "1",
                                                            "pageNumber": "10",
                                                            "required":true,
                                                            "tabGroupLabels": [
                                                            "checkbox group"
                                                    ]
                                                        }
                                                    ],
                                                    "tabGroups": [
                                                        {
                                                            "groupLabel": "checkbox group",
                                                            "groupRule": "SelectAtLeast",
                                                            "minimumRequired": "1",
                                                            "maximumAllowed": "1",
                                                            "validationMessage": "Please check to indicate your agreement",
                                                            "tabScope": "document",
                                                            "pageNumber": "10",
                                                            "documentId": "1"
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
            }else if(($company_id == 101 ||$company_id== 102) || ($company_id == 101 && $company_id== 102)) {
                $data = '{
                    "emailBlurb": "Create an envelope with a templateId",
                    "emailSubject": "Mon Assurance Facture:'. $civilitee .' '.$client->first_name.'",
                    "compositeTemplates": [
                        {
                            "serverTemplates": [
                                {
                                    "sequence": "1",
                                    "templateId": "' . $template . '"
                                }
                            ],
                            "inlineTemplates": [
                                {
                                    "recipients": {
                                        "signers": [
                                            {
                                                "email": "' . $contract->email . '",
                                                "name": "' . $client->first_name . '",
                                                "recipientId": "2",
                                                "roleName": "signer",
                                                "tabs": {
                                                    "signHereTabs": [
                                                        {
                                                            "xPosition": "93",
                                                            "yPosition": "726",
                                                            "tabLabel": "signature1",
                                                            "documentId": "1",
                                                            "pageNumber": "4"
                                                        },
                                                        {
                                                            "xPosition": "317",
                                                            "yPosition": "521",
                                                            "tabLabel": "signature2",
                                                            "documentId": "1",
                                                            "pageNumber": "9"
                                                        },
                                                        {
                                                            "xPosition": "439",
                                                            "yPosition": "772",
                                                            "tabLabel": "signature3",
                                                            "documentId": "1",
                                                            "pageNumber": "9"
                                                        }
                                                    ],
                                                    "textTabs": [
                                                        {
                                                            "xPosition": "51",
                                                            "yPosition": "369",
                                                            "documentId": "1",
                                                            "pageNumber": "3",
                                                            "tabLabel": "fname",
                                                            "value": "' . $client->first_name . '"
                                                        },
                                                        {
                                                            "xPosition": "373",
                                                            "yPosition": "737",
                                                            "documentId": "1",
                                                            "pageNumber": "6",
                                                            "tabLabel": "fname2",
                                                            "value": "' . $client->first_name . '"
                                                        },
                                                        {
                                                            "xPosition": "59",
                                                            "yPosition": "135",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "fname3",
                                                            "value": "' . $client->first_name . '"
                                                        },
                                                        {
                                                            "xPosition": "182",
                                                            "yPosition": "727",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "fname4",
                                                            "value": "' . $client->first_name . '"
                                                        },
                                                        {
                                                            "xPosition": "255",
                                                            "yPosition": "369",
                                                            "documentId": "1",
                                                            "pageNumber": "3",
                                                            "tabLabel": "lname",
                                                            "value": "' . $client->last_name . '"
                                                        },
                                                        {
                                                            "xPosition": "455",
                                                            "yPosition": "737",
                                                            "documentId": "1",
                                                            "pageNumber": "6",
                                                            "tabLabel": "lname2",
                                                            "value": "' . $client->last_name . '"
                                                        },
                                                        {
                                                            "xPosition": "261",
                                                            "yPosition": "134",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "lname3",
                                                            "value": "' . $client->last_name . '"
                                                        },
                                                        {
                                                            "xPosition": "374",
                                                            "yPosition": "726",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "lname4",
                                                            "value": "' . $client->last_name . '"
                                                        },
                                                        {
                                                            "xPosition": "521",
                                                            "yPosition": "370",
                                                            "documentId": "1",
                                                            "pageNumber": "3",
                                                            "tabLabel": "datebird",
                                                            "value": "' . date("d/m/Y", strtotime($client->date_of_birth)) . '"
                                                        },
                                                        {
                                                            "xPosition": "457",
                                                            "yPosition": "134",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "datebird2",
                                                            "value": "' . date("d/m/Y", strtotime($client->date_of_birth)) . '"
                                                        },
                                                        {
                                                            "xPosition": "59",
                                                            "yPosition": "384",
                                                            "documentId": "1",
                                                            "pageNumber": "3",
                                                            "tabLabel": "address",
                                                            "value": "' . $contract->address . '"
                                                        },
                                                        {
                                                            "xPosition": "347",
                                                            "yPosition": "756",
                                                            "documentId": "1",
                                                            "pageNumber": "6",
                                                            "tabLabel": "address2",
                                                            "value": "' . $contract->address . '"
                                                        },
                                                        {
                                                            "xPosition": "71",
                                                            "yPosition": "155",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "address3",
                                                            "value": "' . $contract->address . '"
                                                        },
                                                        {
                                                            "xPosition": "191",
                                                            "yPosition": "743",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "address4",
                                                            "value": "' . $contract->address . '"
                                                        },
                                                        {
                                                            "xPosition": "282",
                                                            "yPosition": "385",
                                                            "documentId": "1",
                                                            "pageNumber": "3",
                                                            "tabLabel": "city",
                                                            "value": "' . $contract->city_name . '"
                                                        },
                                                        {
                                                            "xPosition": "43",
                                                            "yPosition": "692",
                                                            "documentId": "1",
                                                            "pageNumber": "4",
                                                            "tabLabel": "city2",
                                                            "value": "' . $contract->city_name . '"
                                                        },
                                                        {
                                                            "xPosition": "453",
                                                            "yPosition": "778",
                                                            "documentId": "1",
                                                            "pageNumber": "6",
                                                            "tabLabel": "city3",
                                                            "value": "' . $contract->city_name . '"
                                                        },
                                                        {
                                                            "xPosition": "57",
                                                            "yPosition": "175",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "city4",
                                                            "value": "' . $contract->city_name . '"
                                                        },
                                                        {
                                                            "xPosition": "57",
                                                            "yPosition": "532",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "city5",
                                                            "value": "' . $contract->city_name . '"
                                                        },
                                                        {
                                                            "xPosition": "195",
                                                            "yPosition": "775",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "city6",
                                                            "value": "' . $contract->city_name . '"
                                                        },
                                                        {
                                                            "xPosition": "38",
                                                            "yPosition": "709",
                                                            "documentId": "1",
                                                            "pageNumber": "4",
                                                            "tabLabel": "sysdate",
                                                            "value": "' . date('d/m/Y') . '"
                                                        },
                                                        {
                                                            "xPosition": "366",
                                                            "yPosition": "797",
                                                            "documentId": "1",
                                                            "pageNumber": "6",
                                                            "tabLabel": "sysdate2",
                                                            "value": "' . date('d/m/Y') . '"
                                                        },
                                                        {
                                                            "xPosition": "413",
                                                            "yPosition": "115",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "sysdate3",
                                                            "value": "' . date('d/m/Y') . '"
                                                        },
                                                        {
                                                            "xPosition": "514",
                                                            "yPosition": "531",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "sysdate4",
                                                            "value": "' . date('d/m/Y') . '"
                                                        },
                                                        {
                                                            "xPosition": "184",
                                                            "yPosition": "789",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "sysdate5",
                                                            "value": "' . date('d/m/Y') . '"
                                                        },
                                                        {
                                                            "xPosition": "494",
                                                            "yPosition": "385",
                                                            "documentId": "1",
                                                            "pageNumber": "3",
                                                            "tabLabel": "cp",
                                                            "value": "' . $contract->postal_code . '"
                                                        },
                                                        {
                                                            "xPosition": "365",
                                                            "yPosition": "777",
                                                            "documentId": "1",
                                                            "pageNumber": "6",
                                                            "tabLabel": "cp2",
                                                            "value": "' . $contract->postal_code . '"
                                                        },
                                                        {
                                                            "xPosition": "513",
                                                            "yPosition": "155",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "cp3",
                                                            "value": "' . $contract->postal_code . '"
                                                        },
                                                        {
                                                            "xPosition": "47",
                                                            "yPosition": "401",
                                                            "documentId": "1",
                                                            "pageNumber": "3",
                                                            "tabLabel": "mail",
                                                            "value": "' . $contract->email . '"
                                                        },
                                                        {
                                                            "xPosition": "63",
                                                            "yPosition": "194",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "mail2",
                                                            "value": "' . $contract->email . '"
                                                        },
                                                        {
                                                            "xPosition": "409",
                                                            "yPosition": "400",
                                                            "documentId": "1",
                                                            "pageNumber": "3",
                                                            "tabLabel": "phone",
                                                            "value": "' . $contract->mobile_phone . '"
                                                        },
                                                        {
                                                            "xPosition": "470",
                                                            "yPosition": "175",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "phone2",
                                                            "value": "' . $contract->mobile_phone . '"
                                                        },
                                                        {
                                                            "xPosition": "243",
                                                            "yPosition": "759",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "phone3",
                                                            "value": "' . $contract->mobile_phone . '"
                                                        },
                                                        {
                                                            "xPosition": "177",
                                                            "yPosition": "673",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "bic",
                                                            "value": "' . ($contract->bic_swift !== null ? $contract->bic_swift : "--") . '"
                                                        },
                                                        {
                                                            "xPosition": "183",
                                                            "yPosition": "689",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "iban",
                                                            "value": "' . $contract->iban . '"
                                                        },
                                                        {
                                                            "xPosition": "47",
                                                            "yPosition": "464",
                                                            "documentId": "1",
                                                            "pageNumber": "3",
                                                            "tabLabel": "besoin1",
                                                            "value": "' . $request->besoin1 . '"
                                                        },
                                                        {
                                                            "xPosition": "47",
                                                            "yPosition": "502",
                                                            "documentId": "1",
                                                            "pageNumber": "3",
                                                            "tabLabel": "besoin2",
                                                            "value": "' . $request->besoin2 . '"
                                                        },
                                                        {
                                                            "xPosition": "45",
                                                            "yPosition": "543",
                                                            "documentId": "1",
                                                            "pageNumber": "3",
                                                            "tabLabel": "besoin3",
                                                            "value": "' . $request->besoin3 . '"
                                                        },
                                                        {
                                                            "xPosition": "77",
                                                            "yPosition": "80",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "distributeur",
                                                            "value": "Bailey Assurances"
                                                        },
                                                        {
                                                            "xPosition": "248",
                                                            "yPosition": "80",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "conseiller",
                                                            "value": "' . $operatorid->first_name . ' ' . $lettrefirst . '"
                                                        },
                                                        {
                                                            "xPosition": "452",
                                                            "yPosition": "79",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "xvalue",
                                                            "value": "' . $contract->contract_number  . '"
                                                        },
                                                        {
                                                            "xPosition": "58",
                                                            "yPosition": "109",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "gender",
                                                            "value": "' . $civilitee . '"
                                                        },
                                                        {
                                                            "xPosition": "68",
                                                            "yPosition": "570",
                                                            "documentId": "1",
                                                            "pageNumber": "3",
                                                            "tabLabel": "comment",
                                                            "value": "' . ($request->comment !== null ? $request->comment : "--") . '"
                                                        },
                                                        {
                                                            "xPosition": "14",
                                                            "yPosition": "802",
                                                            "documentId": "1",
                                                            "pageNumber": "6",
                                                            "tabLabel": "option1",
                                                            "value": "' . ($request->option1 !== null ? $request->option1 : "--") . '"
                                                        },
                                                        {
                                                            "xPosition": "57",
                                                            "yPosition": "601",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "option11",
                                                            "value": "' .($request->option1 !== null ? $request->option1 : "--") . '"
                                                        },
                                                        {
                                                            "xPosition": "170",
                                                            "yPosition": "802",
                                                            "documentId": "1",
                                                            "pageNumber": "6",
                                                            "tabLabel": "option2",
                                                            "value": "' . ($request->option2 !== null ? $request->option2 : "--") . '"
                                                        },
                                                        {
                                                            "xPosition": "397",
                                                            "yPosition": "599",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "option22",
                                                            "value": "' .($request->option2 !== null ? $request->option2 : "--") . '"
                                                        },
                                                        {
                                                            "xPosition": "43",
                                                            "yPosition": "211",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "bgtxt1",
                                                            "value": "' . ($request->bgtxt1 !== null ? $request->bgtxt1 : "--") . '"
                                                        },
                                                        {
                                                            "xPosition": "44",
                                                            "yPosition": "226",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "bgtxt2",
                                                            "value": "' . ($request->bgtxt2 !== null ? $request->bgtxt2 : "--") . '"
                                                        },
                                                        {
                                                            "xPosition": "55",
                                                            "yPosition": "767",
                                                            "documentId": "1",
                                                            "pageNumber": "4",
                                                            "tabLabel": "code",
                                                            "value": "' . ($request->code !== null ? $request->code : "--") . '"
                                                        },
                                                        {
                                                            "xPosition": "52",
                                                            "yPosition": "786",
                                                            "documentId": "1",
                                                            "pageNumber": "4",
                                                            "tabLabel": "dateenvoie",
                                                            "value":  "' . date("d/m/Y H:i:s", strtotime("+1 hours", strtotime($request->dateenvoie))) . '"
                                                        },
                                                        {
                                                            "xPosition": "218",
                                                            "yPosition": "658",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "cerft",
                                                            "value": "√ Je certifie être le titulaire de l\'Iban/Bic suivant"
                                                        },
                                                        {
                                                            "xPosition": "40",
                                                            "yPosition": "776",
                                                            "documentId": "1",
                                                            "pageNumber": "9",
                                                            "tabLabel": "reccurent",
                                                            "value": "Le √ ' . $request->reccurent . '"
                                                        },
                                                    ],
                                                    "checkboxTabs": [
                                                        {
                                                          "tabLabel": "checkbox",
                                                          "xPosition": "29",
                                                          "yPosition": "489",
                                                          "documentId": "1",
                                                          "pageNumber": "9",
                                                          "required":true,
                                                          "tabGroupLabels": [
                                                            "checkbox group"
                                                          ]
                                                        },
                                                    ],
                                                    "tabGroups": [
                                                        {
                                                          "groupLabel": "checkbox group",
                                                          "groupRule": "SelectAtLeast",
                                                          "minimumRequired": "1",
                                                          "maximumAllowed": "1",
                                                          "validationMessage": "Please check to indicate your agreement",
                                                          "tabScope": "document",
                                                          "documentId": "1",
                                                          "pageNumber": "9"
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
            }else if($company_id == 105){
                $nbr_pers_a_charger =-1;
                if ( empty($request->nbr_pers_a_charger) ) {
                    $nbr_pers_a_charger=0;
                }else {
                    $nbr_pers_a_charger=$request->nbr_pers_a_charger;
                }
                $monsieur='';
                $madame='';
                if ($client->civility==1) {
                    $monsieur='√';
                } else {
                    $madame='√';
                }
               // $naissance=Naissance::select('*')->where('id_client','=',$client->id)->where('id_contract','=',$contract->id)->first();
                // dd($naissance);
                if ($client->civility==1) {
                    $data = '{
                        "emailBlurb": "Create an envelope with a templateId",
                        "emailSubject": "Mon Assurance GFO:'.$civilitee.' '.$client->first_name.'",
                        "compositeTemplates": [
                            {
                                "serverTemplates": [
                                    {
                                        "sequence": "1",
                                        "templateId": "' . $template . '"
                                    }
                                ],
                                "inlineTemplates": [
                                    {
                                        "recipients": {
                                            "signers": [
                                                {
                                                    "email": "' . $contract->email . '",
                                                    "name": "' . $client->first_name . '",
                                                    "recipientId": "2",
                                                    "roleName": "signer",
                                                    "tabs": {
                                                        "signHereTabs": [
                                                            {
                                                                "xPosition": "116",
                                                                "yPosition": "702",
                                                                "tabLabel": "signature1",
                                                                "documentId": "1",
                                                                "pageNumber": "6"
                                                            },
                                                            {
                                                                "xPosition": "382",
                                                                "yPosition": "600",
                                                                "tabLabel": "signature3",
                                                                "documentId": "1",
                                                                "pageNumber": "24"
                                                            }
                                                        ],
                                                        "textTabs": [
                                                            {
                                                                "xPosition": "63",
                                                                "yPosition": "215",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "fname",
                                                                "value": "' . $client->first_name . '"
                                                            },
                                                            {
                                                                "xPosition": "371",
                                                                "yPosition": "238",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "age",
                                                                "value": "' . $request->age . '"
                                                            },
                                                            {
                                                                "xPosition": "88",
                                                                "yPosition": "160",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "fname6",
                                                                "value": "' . $client->first_name . '"
                                                            },
                                                            {
                                                                "xPosition": "390",
                                                                "yPosition": "161",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "fname7",
                                                                "value": "' . $client->first_name . '"
                                                            },
                                                            {
                                                                "xPosition": "330",
                                                                "yPosition": "214",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "lname",
                                                                "value": "' . $client->last_name . '"
                                                            },
                                                            {
                                                                "xPosition": "99",
                                                                "yPosition": "173",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "lname4",
                                                                "value": "' . $client->last_name . '"
                                                            },
                                                            {
                                                                "xPosition": "111",
                                                                "yPosition": "239",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "datebird",
                                                                "value": "' . date("d/m/Y", strtotime($client->date_of_birth)) . '"
                                                            },
                                                            {
                                                                "xPosition": "391",
                                                                "yPosition": "173",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "datebird3",
                                                                "value": "' . date("d/m/Y", strtotime($client->date_of_birth)) . '"
                                                            },
                                                            {
                                                                "xPosition": "410",
                                                                "yPosition": "198",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "commune",
                                                                "value": "' . $contract->commune . '"
                                                            },
                                                            {
                                                                "xPosition": "75",
                                                                "yPosition": "263",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "address",
                                                                "value": "' . $contract->address . '"
                                                            },
                                                            {
                                                                "xPosition": "154",
                                                                "yPosition": "186",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "address3",
                                                                "value": "' . $contract->address . '"
                                                            },
                                                            {
                                                                "xPosition": "118",
                                                                "yPosition": "572",
                                                                "documentId": "1",
                                                                "pageNumber": "6",
                                                                "tabLabel": "city",
                                                                "value": "' . $contract->city_name . '"
                                                            },
                                                            {
                                                                "xPosition": "118",
                                                                "yPosition": "210",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "city5",
                                                                "value": "' . $contract->city_name . '"
                                                            },
                                                            {
                                                                "xPosition": "345",
                                                                "yPosition": "530",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "city6",
                                                                "value": "' . $contract->city_name . '"
                                                            },
                                                            {
                                                                "xPosition": "339",
                                                                "yPosition": "570",
                                                                "documentId": "1",
                                                                "pageNumber": "6",
                                                                "tabLabel": "sysdate",
                                                                "value": "' . date('d/m/Y') . '"
                                                            },
                                                            {
                                                                "xPosition": "328",
                                                                "yPosition": "547",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "sysdate3",
                                                                "value": "' . date('d/m/Y') . '"
                                                            },
                                                            {
                                                                "xPosition": "118",
                                                                "yPosition": "198",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "cp2",
                                                                "value": "' . $contract->postal_code . '"
                                                            },
                                                            {
                                                                "xPosition": "70",
                                                                "yPosition": "312",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "mail",
                                                                "value": "' . $contract->email . '"
                                                            },
                                                            {
                                                                "xPosition": "90",
                                                                "yPosition": "353",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "statu_famille",
                                                                "value": "' . $request->statu_famille . '"
                                                            },
                                                            {
                                                                "xPosition": "149",
                                                                "yPosition": "367",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "avec_enfant",
                                                                "value": "' . $request->avec_enfant . '"
                                                            },
                                                            {
                                                                "xPosition": "219",
                                                                "yPosition": "378",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "nbr_pers_a_charger",
                                                                "value": "' . $nbr_pers_a_charger . '"
                                                            },
                                                            {
                                                                "xPosition": "90",
                                                                "yPosition": "425",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "situation_pro",
                                                                "value": "' . $request->situation_pro . '"
                                                            },
                                                            {
                                                                "xPosition": "377",
                                                                "yPosition": "223",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "mail3",
                                                                "value": "' . $contract->email . '"
                                                            },
                                                            {
                                                                "xPosition": "95",
                                                                "yPosition": "288",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "phone",
                                                                "value": "' . $contract->mobile_phone . '"
                                                            },
                                                            {
                                                                "xPosition": "132",
                                                                "yPosition": "223",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "phone3",
                                                                "value": "' . $contract->mobile_phone . '"
                                                            },
                                                            {
                                                                "xPosition": "336",
                                                                "yPosition": "492",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "bic",
                                                                "value": "' . ($contract->bic_swift !== null ? $contract->bic_swift : "--") . '"
                                                            },
                                                            {
                                                                "xPosition": "343",
                                                                "yPosition": "478",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "iban",
                                                                "value": "' . $contract->iban . '"
                                                            },
                                                            {
                                                                "xPosition": "145",
                                                                "yPosition": "527",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "besoin1",
                                                                "value": "' . $request->besoin1 . '"
                                                            },
                                                            {
                                                                "xPosition": "172",
                                                                "yPosition": "540",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "besoin2",
                                                                "value": "' . $request->besoin2 . '"
                                                            },
                                                            {
                                                                "xPosition": "247",
                                                                "yPosition": "552",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "besoin3",
                                                                "value": "' . $request->besoin3 . '"
                                                            },
                                                            {
                                                                "xPosition": "266",
                                                                "yPosition": "565",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "besoin4",
                                                                "value": "' . $request->besoin4 . '"
                                                            },
                                                            {
                                                                "xPosition": "209",
                                                                "yPosition": "577",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "besoin5",
                                                                "value": "' . $request->besoin5 . '"
                                                            },
                                                            {
                                                                "xPosition": "157",
                                                                "yPosition": "589",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "besoin6",
                                                                "value": "' . $request->besoin6 . '"
                                                            },
                                                            {
                                                                "xPosition": "163",
                                                                "yPosition": "602",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "besoin7",
                                                                "value": "' . $request->besoin7 . '"
                                                            },
                                                            {
                                                                "xPosition": "130",
                                                                "yPosition": "615",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "besoin8",
                                                                "value": "' . $request->besoin8 . '"
                                                            },
                                                            {
                                                                "xPosition": "237",
                                                                "yPosition": "626",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "besoin9",
                                                                "value": "' . $request->besoin9 . '"
                                                            },
                                                            {
                                                                "xPosition": "286",
                                                                "yPosition": "665",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "besoin10",
                                                                "value": "' . $request->besoin10 . '"
                                                            },
                                                            {
                                                                "xPosition": "224",
                                                                "yPosition": "676",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "besoin11",
                                                                "value": "' . $request->besoin11 . '"
                                                            },
                                                            {
                                                                "xPosition": "327",
                                                                "yPosition": "687",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "besoin12",
                                                                "value": "' . $request->besoin12 . '"
                                                            },
                                                            {
                                                                "xPosition": "422",
                                                                "yPosition": "699",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "besoin13",
                                                                "value": "' . $request->besoin13 . '"
                                                            },
                                                            {
                                                                "xPosition": "91",
                                                                "yPosition": "736",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "etre_couvert",
                                                                "value": "' . $request->etre_couvert .'"
                                                            },
                                                            
                                                            {
                                                                "xPosition": "282",
                                                                "yPosition": "760",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "montant_de_cotisation",
                                                                "value": "' . $request->montant_de_cotisation . '"
                                                            },
                                                            {
                                                                "xPosition": "390",
                                                                "yPosition": "210",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "pays",
                                                                "value": "' .$contract->pays . '"
                                                            },
                                                            {
                                                                "xPosition": "423",
                                                                "yPosition": "186",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "departement",
                                                                "value": "' .$contract->departement . '"
                                                            },
                                                            {
                                                                "xPosition": "61",
                                                                "yPosition": "147",
                                                                "tabLabel": "gender",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "groupName": "gender",
                                                                "value": "' .$monsieur . '"
                                                            },
                                                            {
                                                                "xPosition": "127",
                                                                "yPosition": "601",
                                                                "documentId": "1",
                                                                "pageNumber": "6",
                                                                "tabLabel": "code",
                                                                "value": "' . $request->code . '"
                                                            },
                                                            {
                                                                "xPosition": "150",
                                                                "yPosition": "623",
                                                                "documentId": "1",
                                                                "pageNumber": "6",
                                                                "tabLabel": "dateenvoi",
                                                                "value":  "' . date("d/m/Y H:i:s", strtotime("+1 hours", strtotime($request->dateenvoie))) . '"
                                                            },
                                                            {
                                                                "xPosition": "186",
                                                                "yPosition": "266",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "etre_couvert2",
                                                                "value": "' . $request->etre_couvert .' euros"
                                                            },
                                                            {
                                                                "xPosition": "140",
                                                                "yPosition": "435",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "montant_de_cotisation2",
                                                                "value": "' . $request->montant_de_cotisation . '"
                                                            },
                                                            {
                                                                "xPosition": "358",
                                                                "yPosition": "658",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "code2",
                                                                "value": "' . $request->code . '"
                                                            },
                                                            {
                                                                "xPosition": "378",
                                                                "yPosition": "676",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "dateenvoi2",
                                                                "value":  "' . date("d/m/Y H:i:s", strtotime("+1 hours", strtotime($request->dateenvoie))) . '"
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
                }elseif ($client->civility==2) {
                    $data = '{
                        "emailBlurb": "Create an envelope with a templateId",
                        "emailSubject": "Mon Assurance GFO:'.$civilitee.' '.$client->first_name.'",
                        "compositeTemplates": [
                            {
                                "serverTemplates": [
                                    {
                                        "sequence": "1",
                                        "templateId": "' . $template . '"
                                    }
                                ],
                                "inlineTemplates": [
                                    {
                                        "recipients": {
                                            "signers": [
                                                {
                                                    "email": "' . $contract->email . '",
                                                    "name": "' . $client->first_name . '",
                                                    "recipientId": "2",
                                                    "roleName": "signer",
                                                    "tabs": {
                                                        "signHereTabs": [
                                                            {
                                                                "xPosition": "116",
                                                                "yPosition": "702",
                                                                "tabLabel": "signature1",
                                                                "documentId": "1",
                                                                "pageNumber": "6"
                                                            },
                                                            {
                                                                "xPosition": "382",
                                                                "yPosition": "600",
                                                                "tabLabel": "signature3",
                                                                "documentId": "1",
                                                                "pageNumber": "24"
                                                            }
                                                        ],
                                                        "textTabs": [
                                                            {
                                                                "xPosition": "63",
                                                                "yPosition": "215",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "fname",
                                                                "value": "' . $client->first_name . '"
                                                            },
                                                            {
                                                                "xPosition": "371",
                                                                "yPosition": "238",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "age",
                                                                "value": "' . $request->age . '"
                                                            },
                                                            {
                                                                "xPosition": "88",
                                                                "yPosition": "160",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "fname6",
                                                                "value": "' . $client->first_name . '"
                                                            },
                                                            {
                                                                "xPosition": "390",
                                                                "yPosition": "161",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "fname7",
                                                                "value": "' . $client->first_name . '"
                                                            },
                                                            {
                                                                "xPosition": "330",
                                                                "yPosition": "214",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "lname",
                                                                "value": "' . $client->last_name . '"
                                                            },
                                                            {
                                                                "xPosition": "99",
                                                                "yPosition": "173",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "lname4",
                                                                "value": "' . $client->last_name . '"
                                                            },
                                                            {
                                                                "xPosition": "111",
                                                                "yPosition": "239",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "datebird",
                                                                "value": "' . date("d/m/Y", strtotime($client->date_of_birth)) . '"
                                                            },
                                                            {
                                                                "xPosition": "391",
                                                                "yPosition": "173",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "datebird3",
                                                                "value": "' . date("d/m/Y", strtotime($client->date_of_birth)) . '"
                                                            },
                                                            {
                                                                "xPosition": "410",
                                                                "yPosition": "198",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "commune",
                                                                "value": "' . $contract->commune . '"
                                                            },
                                                            {
                                                                "xPosition": "75",
                                                                "yPosition": "263",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "address",
                                                                "value": "' . $contract->address . '"
                                                            },
                                                            {
                                                                "xPosition": "154",
                                                                "yPosition": "186",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "address3",
                                                                "value": "' . $contract->address . '"
                                                            },
                                                            {
                                                                "xPosition": "118",
                                                                "yPosition": "572",
                                                                "documentId": "1",
                                                                "pageNumber": "6",
                                                                "tabLabel": "city",
                                                                "value": "' . $contract->city_name . '"
                                                            },
                                                            {
                                                                "xPosition": "118",
                                                                "yPosition": "210",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "city5",
                                                                "value": "' . $contract->city_name . '"
                                                            },
                                                            {
                                                                "xPosition": "345",
                                                                "yPosition": "530",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "city6",
                                                                "value": "' . $contract->city_name . '"
                                                            },
                                                            {
                                                                "xPosition": "339",
                                                                "yPosition": "570",
                                                                "documentId": "1",
                                                                "pageNumber": "6",
                                                                "tabLabel": "sysdate",
                                                                "value": "' . date('d/m/Y') . '"
                                                            },
                                                            {
                                                                "xPosition": "328",
                                                                "yPosition": "547",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "sysdate3",
                                                                "value": "' . date('d/m/Y') . '"
                                                            },
                                                            {
                                                                "xPosition": "118",
                                                                "yPosition": "198",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "cp2",
                                                                "value": "' . $contract->postal_code . '"
                                                            },
                                                            {
                                                                "xPosition": "70",
                                                                "yPosition": "312",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "mail",
                                                                "value": "' . $contract->email . '"
                                                            },
                                                            {
                                                                "xPosition": "90",
                                                                "yPosition": "353",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "statu_famille",
                                                                "value": "' . $request->statu_famille . '"
                                                            },
                                                            {
                                                                "xPosition": "149",
                                                                "yPosition": "367",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "avec_enfant",
                                                                "value": "' . $request->avec_enfant . '"
                                                            },
                                                            {
                                                                "xPosition": "219",
                                                                "yPosition": "378",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "nbr_pers_a_charger",
                                                                "value": "' . $nbr_pers_a_charger . '"
                                                            },
                                                            {
                                                                "xPosition": "90",
                                                                "yPosition": "425",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "situation_pro",
                                                                "value": "' . $request->situation_pro . '"
                                                            },
                                                            {
                                                                "xPosition": "377",
                                                                "yPosition": "223",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "mail3",
                                                                "value": "' . $contract->email . '"
                                                            },
                                                            {
                                                                "xPosition": "95",
                                                                "yPosition": "288",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "phone",
                                                                "value": "' . $contract->mobile_phone . '"
                                                            },
                                                            {
                                                                "xPosition": "132",
                                                                "yPosition": "223",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "phone3",
                                                                "value": "' . $contract->mobile_phone . '"
                                                            },
                                                            {
                                                                "xPosition": "336",
                                                                "yPosition": "492",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "bic",
                                                                "value": "' . ($contract->bic_swift !== null ? $contract->bic_swift : "--") . '"
                                                            },
                                                            {
                                                                "xPosition": "343",
                                                                "yPosition": "478",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "iban",
                                                                "value": "' . $contract->iban . '"
                                                            },
                                                            {
                                                                "xPosition": "145",
                                                                "yPosition": "527",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "besoin1",
                                                                "value": "' . $request->besoin1 . '"
                                                            },
                                                            {
                                                                "xPosition": "172",
                                                                "yPosition": "540",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "besoin2",
                                                                "value": "' . $request->besoin2 . '"
                                                            },
                                                            {
                                                                "xPosition": "247",
                                                                "yPosition": "552",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "besoin3",
                                                                "value": "' . $request->besoin3 . '"
                                                            },
                                                            {
                                                                "xPosition": "266",
                                                                "yPosition": "565",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "besoin4",
                                                                "value": "' . $request->besoin4 . '"
                                                            },
                                                            {
                                                                "xPosition": "209",
                                                                "yPosition": "577",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "besoin5",
                                                                "value": "' . $request->besoin5 . '"
                                                            },
                                                            {
                                                                "xPosition": "157",
                                                                "yPosition": "589",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "besoin6",
                                                                "value": "' . $request->besoin6 . '"
                                                            },
                                                            {
                                                                "xPosition": "163",
                                                                "yPosition": "602",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "besoin7",
                                                                "value": "' . $request->besoin7 . '"
                                                            },
                                                            {
                                                                "xPosition": "130",
                                                                "yPosition": "615",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "besoin8",
                                                                "value": "' . $request->besoin8 . '"
                                                            },
                                                            {
                                                                "xPosition": "237",
                                                                "yPosition": "626",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "besoin9",
                                                                "value": "' . $request->besoin9 . '"
                                                            },
                                                            {
                                                                "xPosition": "286",
                                                                "yPosition": "665",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "besoin10",
                                                                "value": "' . $request->besoin10 . '"
                                                            },
                                                            {
                                                                "xPosition": "224",
                                                                "yPosition": "676",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "besoin11",
                                                                "value": "' . $request->besoin11 . '"
                                                            },
                                                            {
                                                                "xPosition": "327",
                                                                "yPosition": "687",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "besoin12",
                                                                "value": "' . $request->besoin12 . '"
                                                            },
                                                            {
                                                                "xPosition": "422",
                                                                "yPosition": "699",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "besoin13",
                                                                "value": "' . $request->besoin13 . '"
                                                            },
                                                            {
                                                                "xPosition": "91",
                                                                "yPosition": "736",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "etre_couvert",
                                                                "value": "' . $request->etre_couvert .'"
                                                            },
                                                            
                                                            {
                                                                "xPosition": "282",
                                                                "yPosition": "760",
                                                                "documentId": "1",
                                                                "pageNumber": "3",
                                                                "tabLabel": "montant_de_cotisation",
                                                                "value": "' . $request->montant_de_cotisation . '"
                                                            },
                                                            {
                                                                "xPosition": "390",
                                                                "yPosition": "210",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "pays",
                                                                "value": "' .$contract->pays . '"
                                                            },
                                                            {
                                                                "xPosition": "423",
                                                                "yPosition": "186",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "departement",
                                                                "value": "' .$contract->departement . '"
                                                            },
                                                            {
                                                                "xPosition": "111",
                                                                "yPosition": "147",
                                                                "tabLabel": "gender",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "groupName": "gender",
                                                                "value": "' .$madame . '"
                                                            },
                                                            {
                                                                "xPosition": "127",
                                                                "yPosition": "601",
                                                                "documentId": "1",
                                                                "pageNumber": "6",
                                                                "tabLabel": "code",
                                                                "value": "' . $request->code . '"
                                                            },
                                                            {
                                                                "xPosition": "150",
                                                                "yPosition": "623",
                                                                "documentId": "1",
                                                                "pageNumber": "6",
                                                                "tabLabel": "dateenvoi",
                                                                "value":  "' . date("d/m/Y H:i:s", strtotime("+1 hours", strtotime($request->dateenvoie))) . '"
                                                            },
                                                            {
                                                                "xPosition": "186",
                                                                "yPosition": "266",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "etre_couvert2",
                                                                "value": "' . $request->etre_couvert .' euros"
                                                            },
                                                            {
                                                                "xPosition": "140",
                                                                "yPosition": "435",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "montant_de_cotisation2",
                                                                "value": "' . $request->montant_de_cotisation . '"
                                                            },
                                                            {
                                                                "xPosition": "358",
                                                                "yPosition": "658",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "code2",
                                                                "value": "' . $request->code . '"
                                                            },
                                                            {
                                                                "xPosition": "378",
                                                                "yPosition": "676",
                                                                "documentId": "1",
                                                                "pageNumber": "24",
                                                                "tabLabel": "dateenvoi2",
                                                                "value":  "' . date("d/m/Y H:i:s", strtotime("+1 hours", strtotime($request->dateenvoie))) . '"
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
                }
                
            

            }
            

            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

            //for debug only!
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

            $resp = curl_exec($curl);
            curl_close($curl);

            $result = json_decode($resp, true);

            if ($result) {
                return response()->json([
                    'success' => true,
                    'message' => "Vous avez reçu par email votre bulletin d'adhésion à signer par Docusign",
                    'result' => $result,
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e,
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
    public function getContractState()
    {
        $this->args = $this->getTemplateArgs();

		$beginTimestamp = now()->subDays(5)->timestamp;
        Log::info('time is:', ['time' => $beginTimestamp]);

		$contracts = Contract::select('id', 'contract_number', 'company_id', 'envelopeId')
			->where([
				['signed', 0],
				['contract_number', 'like', 'D/%']
			])
			->whereNotNull('envelopeId')
			->where('created_at', '>=', now()->subDays(5)->timestamp)
			->get();

        Log::info('Contracts to process:', ['contracts' => $contracts->toArray()]);
        $this->args = $this->getTemplateArgs();

        $long = strtotime(date("Y-m-d H:i:s"));
        $count = 0;

        foreach ($contracts as $key => $value) {
            if ($count >= 35) {
                break;
            }
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, 'https://eu.docusign.net/restapi/v2.1/accounts/3df36e73-cd9f-49cb-b337-9519ea7239c4/envelopes/' . $value->envelopeId);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_ENCODING, '');
            curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
            curl_setopt($curl, CURLOPT_TIMEOUT, 0);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                "Authorization: Bearer " . $this->args['ds_access_token'],
                'Cookie: BIGipServerpool_DR1_Demo_API=!TBvsaa3wHzgn1Lz2SkWZuTyeoL7a6UbLhjYdM4GWH2b7vykmyTStb9bx0qLvlf0K9dLvfqjMM/nWPhE='
            ));

            $response = curl_exec($curl);

            $result = json_decode($response);
            if (isset($result->status)) {
                if ($result->status == "completed") {
                    $contract = Contract::where('id', $value->id)->first();
                    $contract->signed = 1;
                    $contract->state = 'Bulletin Signé';
                    $contract->updated_at = $long;
                    $contract->update();
                }
            }
            $count++;
        }
    }
}