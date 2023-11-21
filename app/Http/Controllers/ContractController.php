<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\ServiceProvider;
use App\Models\Day;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use DateTime;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use App\Models\DigitalContract;
use App\Models\Operator;
use App\Models\City;
use App\Models\Client;
use App\Models\Contract;
use App\Models\Naissance;




use DocuSign\eSign\Configuration;
use DocuSign\eSign\Api\EnvelopesApi;
use DocuSign\eSign\Client\ApiClient;
use DocuSign\eSign\Client\ApiException;
use DocuSign\eSign\Model\Document;
use DocuSign\eSign\Model\SignHere;
use DocuSign\eSign\Model\DateSigned;
use DocuSign\eSign\Model\FullName;
use DocuSign\eSign\Model\Tabs;
use DocuSign\eSign\Model\Signer;
use DocuSign\eSign\Model\Recipients;
use DocuSign\eSign\Model\InlineTemplate;
use DocuSign\eSign\Model\CompositeTemplate;
use DocuSign\eSign\Model\EnvelopeDefinition;

class ContractController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getArchives(){
        // $userid= Auth::user()->id;

        $contracts = Contract::select('*', 'bailey_contract.created_at','bailey_contract.id',
         DB::raw("DATE_FORMAT(FROM_UNIXTIME(bailey_contract.created_at), '%d-%m-%Y') as formatted_created_at"),
         DB::raw("DATE_FORMAT(FROM_UNIXTIME(bailey_contract.signed_date), '%Y-%m-%d') as formatted_signed_date"))     
                    ->where('signed', 0)
                    ->where('contract_number', 'like', 'D/%')
                    ->whereRaw('bailey_contract.created_at <= UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL 5 DAY))')
                    ->join('bailey_company', 'bailey_company.id', '=', 'bailey_contract.company_id')
                    ->join('bailey_client', 'bailey_client.id','=', 'bailey_contract.client_id')
                    ->orderBy('formatted_created_at', 'DESC')
                    ->get();

        $nbcontractArchive =  count($contracts);                                       

        return view('forms.archive',compact('contracts','nbcontractArchive'));

    }
    public function restoreContract($id)
    {
      
        $contract = Contract::find($id);
       
        if (!$contract) {
            return redirect()->back()->with('error', 'Contrat non trouvé.');
        }
    
        $contract->created_at = time();
        $contract->save();
    
        return redirect()->back()->with('success', 'Contrat restauré avec succès.');
    }
    public function getContract(){
         $id=Auth::user()->id;
        $operatorAcces = DB::table('bailey_operator_access')
                    ->where('user_id','=',$id)
                    ->get();
        $roles  = DB::table('bailey_role')
        ->join('bailey_role_user', 'bailey_role_user.role_id', '=', 'bailey_role.id')
        ->where('bailey_role_user.user_id', '=', $id)
        ->get();
        // dd($roles);

        return view('forms.contract',compact('operatorAcces','roles'));
    }

    public function getFournisseur($type_id)
    {
        if ($type_id > 0) {
            $service_provider = ServiceProvider::select('id','name')->where('company_id', $type_id)->get();
        }

        $total = count($service_provider); // total items in array

        $result = [
            'service_provider' => $service_provider,
            'total' => $total,
        ];

        return response()->json($result);

    }

    public function getDays(Request $request)
    {
        $requestval=array();
        $requestval=explode("," , $request->typeselected);

        if (count($requestval) > 0) {
            $data = Day::select('day_id')->whereIn('company_id', $requestval)->distinct()->get();
        }

        $total = count($data); // total items in array

        $result = [
            'data' => $data,
            'total' => $total,
        ];

        return response()->json($result);

    }
    

    public function getStates()
    {

        $userid = Auth::user()->id;
        $contractsfinis= Contract::select('*')
                        ->where('id_user', $userid)
                        // ->join('bailey_company', 'bailey_company.id', 'bailey_contract.company_id')
                        // ->join('bailey_client', 'bailey_client.id', 'bailey_contract.client_id')
                        ->get();
                        // dd($contractsfinis);
        $contractsnonfinis = Contract::select('*', 'bailey_contract.id', 'bailey_contract.created_at', DB::raw("DATE_FORMAT(FROM_UNIXTIME(bailey_contract.created_at), '%d-%m-%Y') as formatted_created_at"))
                                    ->where('id_user', $userid)
                                    ->where('signed',0)
                                    ->join('bailey_company', 'bailey_company.id', '=', 'bailey_contract.company_id')
                                    ->join('bailey_client', 'bailey_client.id', 'bailey_contract.client_id')
                                    ->whereRaw('bailey_contract.created_at >= UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL 5 DAY))')
                                    ->orderBy('formatted_created_at', 'DESC')
                                    ->get();
                                    // dd($contractsnonfinis);
                                    // dd($contractsnonfinis);

                                    $contractsnonfinisgrouped = Contract::select(
                                        DB::raw('YEAR(date) as year'),
                                        DB::raw('COUNT(*) as count'),
                                        DB::raw("DATE_FORMAT(FROM_UNIXTIME(bailey_contract.created_at), '%Y-%m-%d %H:%i:%s') as formatted_created_at")
                                    )
                                    ->where('id_user', $userid)
                                    ->where('signed', 0)
                                    ->join('bailey_company', 'bailey_company.id', 'bailey_contract.company_id')
                                    ->join('bailey_client', 'bailey_client.id', 'bailey_contract.client_id')
                                    ->whereRaw('bailey_contract.created_at >= UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL 5 DAY))')
                                    ->groupBy('year', 'formatted_created_at') // Ajout de 'year' à la clause GROUP BY
                                    ->get();
                                    $contractsnonfinisgroupedbytype = Contract::select(
                                        DB::raw('YEAR(date) as year'),
                                        'bailey_company.name as company_id',
                                        DB::raw('COUNT(*) as count'),
                                        DB::raw("DATE_FORMAT(FROM_UNIXTIME(bailey_contract.created_at), '%Y-%m-%d %H:%i:%s') as formatted_created_at")
                                    )
                                    ->where('id_user', $userid)
                                    ->where('signed', 0)
                                    ->join('bailey_company', 'bailey_company.id', '=', 'bailey_contract.company_id')
                                    ->whereRaw('bailey_contract.created_at >= UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL 5 DAY))')
                                    ->groupBy('year', 'company_id', 'formatted_created_at') // Ajout de 'year' et 'company_id' à la clause GROUP BY
                                    ->get()
                                    ->groupBy('year')
                                    ->map(function ($row) {
                                        return $row->pluck('company_id');
                                    });

        $nbcontractsfinis = count($contractsfinis);
        $nbcontractsnonfinis = count($contractsnonfinis);

        return view('forms.state',compact('contractsfinis','contractsnonfinis','nbcontractsfinis','nbcontractsnonfinis','contractsnonfinisgrouped','contractsnonfinisgroupedbytype'));
    }
    function getAllClient(){
        $clients  = DB::table('bailey_client')
                                    ->select('bailey_client.first_name','bailey_client.last_name')
                                    ->where('company_id',105)
                                    ->join('bailey_contract','bailey_contract.client_id','=','bailey_client.id')
                                    ->get();
        // $clients=Client::all();
        return response()->json($clients);

        }
        function getCitys(Request $request){
            // dd($request->cp);
            
            $city=City::select('*')->where('postal_code',$request->cp)->get();
            // dd($citys);
            $total=count($city);
            $result = [
                'data' => $city,
                'total' => $total,
            ];
    
            return response()->json($result);
        }
    // public function saveContrat(Request $request)
    // {
    //     $request->headers->set('X-CSRF-Token', csrf_token());
    //     // $success = false;
    //     $userid = Auth::user()->id;
    //     $operatorid= Operator::select('id')->where('user_id',$userid)->first('id');
    //     $savedIds = [];
    //     $contracts=array();
    //     $long = strtotime(date("Y-m-d H:i:s")); 
    //     if(isset($operatorid)){
    //         if ($request->isMethod('post')) {
    //             $cityId=null;
    //             $city = City::select('id')
    //             ->where('municipalitie_name', 'LIKE', '%' . $request->city_name . '%')
    //             ->where('postal_code', 'LIKE', '%' . $request->postal_code . '%')
    //             ->first();
    //             if ($city !=null) {
    //                 $cityId = $city->id;          
    //             } else {
    //                 $city = new City();
    //                 $city->code_commune_insee =null;
    //                 $city->name_municipalitie_postal  = null;
    //                 $city->postal_code = $request->postal_code;
    //                 $city->municipalitie_name = $request->city_name;
    //                 $city->code_department = null;
    //                 $city->department_name = null;
    //                 $city->code_region =null;
    //                 $city->region_name =null;
    //                 $city->active =1;
    //                 $city->sorting =1;
    //                 $city->save();
    //                 $cityId = $city->id;          
    //             }           
    //             $companies=array();
    //             $contract_number=array();
    //             $pdl_number=array();
    //             $serviceprovider=array();

    
    //             if ($request->has('service_provider_id')) {
    //                 $serviceprovider=explode("," , $request->service_provider_id);
    //             } else {
    //                 $serviceprovider=null;
    //             }

    //             if ($request->has('pdl_number')) {
    //                 $pdl_number=explode("," , $request->pdl_number);
    //             } else {
    //                 $pdl_number=null;
    //             }
    //             $companies=explode("," , $request->company_id);
    //             $contract_number=explode("," , $request->contract_number);
    //             $results = Client::select('id')
    //             ->where('first_name','=',$request->first_name)
    //             ->where('last_name','=',$request->last_name)
    //             ->first();
    //             // dd($results);
    //             $client_id=null;
    //             // dd($request->gender);
    //             if($results!=null){
    //                 $baileyClient = Client::find($results->id);
    //                 $baileyClient->iban = (isset($request->iban)) ? strval($request->iban) : null;
    //                 $baileyClient->updated_at = $long;
    //                 $client_id=$baileyClient->id;
    //                 $baileyClient->update();
    //             }
    //             else {
    //                 $baileyClient = new Client();
    //                 $baileyClient->iban =  (isset($request->iban)) ? strval($request->iban) : null;;
    //                 $baileyClient->date_of_birth = $request->datebirth;
    //                 $baileyClient->last_name = $request->last_name;
    //                 $baileyClient->first_name = $request->first_name;
    //                 $baileyClient->civility=$request->gender;
    //                 $baileyClient->created_by = $userid;
    //                 $baileyClient->updated_by = $userid;
    //                 $baileyClient->created_at = $long;
    //                 $baileyClient->updated_at = $long;
    //                 // dd($baileyClient);
    //                 $baileyClient->save();
    //                 $client_id=$baileyClient->id;
    //             }
                  

                
    //             // dd($client_id);

                
    //             $date=date('Y-m-d');
    //             // dd($request->signed);
    //         foreach ($companies as $key => $companyid) {
    //                 if ($request->has('id_contract') && $request->input('id_contract') !="") {
    //                     $contracts=explode("," , $request->id_contract);
    //                     foreach ($contracts as $key => $value) {
    //                         $row = Contract::find($value);
    //                         $row->iban=$request->iban;
    //                         $row->bic_swift=$request->bic_swift;
    //                         $row->day_id = $request->day_id;
    //                         // $row->client_id = $client_id;
    //                         $row->signed = $request->signed ;
    //                         $row->update();
    //                         $savedIds[] = $row->id;
    //                     }      
    //                 }
    //                 else{
    //                     $row = new Contract();
    //                     $row->contract_number = $contract_number[$key];
    //                     $row->company_id = $companyid;
    //                     $row->iban = (isset($request->iban)) ? strval($request->iban) : null;
    //                     $row->bic_swift = (isset($request->bic_swift)) ? strval($request->bic_swift) : null;
    //                     $row->operator_id = $operatorid->id;
    //                     $row->client_id = $client_id;
    //                     $row->id_user = $userid;
    //                     $row->status = (isset($request->status)) ? $request->status : null;
    //                     $row->step = (isset($request->step)) ? $request->step : null;
    //                     $row->date = strval($date);
    //                     if (is_null($pdl_number)){
    //                         $row->pdl_number = null;
    //                     }else{
    //                         $row->pdl_number = $pdl_number[$key] == "" ? null : $pdl_number[$key];      
    //                     }                        
    //                     if (is_null($serviceprovider)){
    //                         $row->service_provider_id = null;
    //                     }else{
    //                         $row->service_provider_id = $serviceprovider[$key] == "" ? null : $serviceprovider[$key];      
    //                     }
    //                     $row->landline_phone = (isset($request->landline_phone)) ? strval($request->landline_phone) : null;
    //                     $row->mobile_phone = (isset($request->mobile_phone)) ? strval($request->mobile_phone) : null;
    //                     $row->type_of_building = (isset($request->type_of_building)) ? $request->type_of_building : null;
    //                     $row->address = (isset($request->address)) ? strval($request->address) : null;
    //                     $row->postal_code = (isset($request->postal_code)) ? strval($request->postal_code) : null;
    //                     $row->city_name = (isset($request->city_name)) ? strval($request->city_name) : null;
    //                     $row->city_id = $cityId ? $cityId : null;
    //                     $row->day_id = (isset($request->day_id)) ? $request->day_id : null;
    //                     $row->sage_number = (isset($request->sage_number)) ? strval($request->sage_number) : null;
    //                     $row->status_updated_at = (isset($request->status_updated_at)) ? $request->status_updated_at : null;
    //                     $row->excel_row = (isset($request->excel_row)) ? $request->excel_row : null;
    //                     $row->created_by = $operatorid->id;
    //                     $row->updated_by = $operatorid->id;
    //                     $row->created_at =$long;
    //                     $row->updated_at = $long;
    //                     $row->state = (isset($request->state)) ? $request->state : false;
    //                     $row->signed = $request->signed ;
    //                     $row->is_saved = (isset($request->is_saved)) ? $request->is_saved : false;
    //                     // $row->signed = (isset($request->signed)) ? $request->signed : null;
    //                     $row->signed_date = $long;
    //                     $row->envelopeId = (isset($request->envelopeId)) ? $request->envelopeId : null;
    //                     $row->email = (isset($request->email)) ? strtolower($request->email) : null;
    //                     $row->group = (isset($request->group)) ? $request->group : null;
    //                     $row->data = (isset($request->data)) ? $request->data : null;
    //                     $row->save();
    //                     $savedIds[] = $row->id;
    //                 }
    //             }
    //         }
    //     }
    //     return response()->json(['savedIds' => collect($savedIds)->unique()], 201);
    // }
    public function saveContrat(Request $request)
        {
            $request->headers->set('X-CSRF-Token', csrf_token());
            // $success = false;
            $userid = Auth::user()->id;
            $operatorid= Operator::select('id')->where('user_id',$userid)->first('id');
            $savedIds = [];
            $contracts=array();
            $long = strtotime(date("Y-m-d H:i:s")); 
            if(isset($operatorid)){
                if ($request->isMethod('post')) {
                    $cityId=null;
                    $city = City::select('id')
                    ->where('municipalitie_name', 'LIKE', '%' . $request->city_name . '%')
                    ->where('postal_code', 'LIKE', '%' . $request->postal_code . '%')
                    ->first();
                    if ($city !=null) {
                        $cityId = $city->id;          
                    } else {
                        $city = new City();
                        $city->code_commune_insee =null;
                        $city->name_municipalitie_postal  = null;
                        $city->postal_code = $request->postal_code;
                        $city->municipalitie_name = $request->city_name;
                        $city->code_department = null;
                        $city->department_name = null;
                        $city->code_region =null;
                        $city->region_name =null;
                        $city->active =1;
                        $city->sorting =1;
                        $city->save();
                        $cityId = $city->id;          
                    }           
                    $companies=array();
                    $contract_number=array();
                    $pdl_number=array();
                    $serviceprovider=array();
    
        
                    if ($request->has('service_provider_id')) {
                        $serviceprovider=explode("," , $request->service_provider_id);
                    } else {
                        $serviceprovider=null;
                    }
    
                    if ($request->has('pdl_number')) {
                        $pdl_number=explode("," , $request->pdl_number);
                    } else {
                        $pdl_number=null;
                    }
                    $companies=explode("," , $request->company_id);
                    $contract_number=explode("," , $request->contract_number);
                    $results = Client::select('id')
                    ->where('first_name','=',$request->first_name)
                    ->where('last_name','=',$request->last_name)
                    ->first();
                    // dd($results);
                    $client_id=null;
                    
                    // dd($request->gender);
                    if($results!=null){
                        $baileyClient = Client::find($results->id);
                        $baileyClient->iban = $request->iban;
                        // $baileyClient->bank_id = $request->column2;
                        // $baileyClient->date_of_birth = $request->datebirth;
                        // $baileyClient->last_name = $request->first_name;
                        // $baileyClient->first_name = $request->last_name;
                        // $baileyClient->updated_by = $userid;
                        $baileyClient->updated_at = $long;
                        $client_id=$baileyClient->id;
                        $baileyClient->update();
                    }
                    else {
                        $baileyClient = new Client();
                        $baileyClient->iban = null;
                        $baileyClient->date_of_birth = $request->datebirth;
                        $baileyClient->last_name = $request->last_name;
                        $baileyClient->first_name = $request->first_name;
                        $baileyClient->civility=$request->gender;
                        $baileyClient->created_by = $userid;
                        $baileyClient->updated_by = $userid;
                        $baileyClient->created_at = $long;
                        $baileyClient->updated_at = $long;
                        // dd($baileyClient);
                        $baileyClient->save();
                        $client_id=$baileyClient->id;
                    }
                      
    
                    
                    // dd($client_id);
    
                    
                    $date=date('Y-m-d');
                    $pdl_Final=json_encode($request->pdl_number);
                    $pdl_number=null;
                    $service=null;
                    $service_Final=json_encode($request->service_provider_id);
                    if ($pdl_Final==null) {
                        $pdl_number=null;

                    }else {
                        $pdl_number=$pdl_Final;
                    }
                    if ($service_Final==null) {
                        $service=null;

                    }else {
                        $service=$service_Final;
                    }
                foreach ($companies as $key => $companyid) {
                        if ($request->has('id_contract') && $request->input('id_contract') !="") {
                            $contracts=explode("," , $request->id_contract);
                            foreach ($contracts as $key => $value) {
                                $row = Contract::find($value);
                                $row->iban=$request->iban;
                                $row->bic_swift=$request->bic_swift;
                                $row->day_id = $request->day_id;
                                $row->update();
                                $savedIds[] = $row->id;
                            }      
                        }
                        else{
                            $row = new Contract();
                            $row->contract_number = $contract_number[$key];
                            $row->company_id = $companyid;
                            $row->iban = (isset($request->iban)) ? strval($request->iban) : null;
                            $row->bic_swift = (isset($request->bic_swift)) ? strval($request->bic_swift) : null;
                            $row->operator_id = $operatorid->id;
                            $row->client_id = $client_id;
                            $row->id_user = $userid;
                            $row->status = (isset($request->status)) ? $request->status : null;
                            $row->step = (isset($request->step)) ? $request->step : null;
                            $row->date = strval($date);
                            $row->pdl_number=null;
                            $row->service_provider_id =null;
                            $row->landline_phone = (isset($request->landline_phone)) ? strval($request->landline_phone) : null;
                            $row->mobile_phone = (isset($request->mobile_phone)) ? strval($request->mobile_phone) : null;
                            $row->type_of_building = (isset($request->type_of_building)) ? $request->type_of_building : null;
                            $row->address = (isset($request->address)) ? strval($request->address) : null;
                            $row->postal_code = (isset($request->postal_code)) ? strval($request->postal_code) : null;
                            $row->city_name = (isset($request->city_name)) ? strval($request->city_name) : null;
                            $row->city_id = $cityId ? $cityId : null;
                            $row->day_id = (isset($request->day_id)) ? $request->day_id : null;
                            $row->sage_number = (isset($request->sage_number)) ? strval($request->sage_number) : null;
                            $row->status_updated_at = (isset($request->status_updated_at)) ? $request->status_updated_at : null;
                            $row->excel_row = (isset($request->excel_row)) ? $request->excel_row : null;
                            $row->created_by = $operatorid->id;
                            $row->updated_by = $operatorid->id;
                            $row->created_at =$long;
                            $row->updated_at = $long;
                            $row->state = (isset($request->state)) ? $request->state : false;
                            $row->signed = $request->signed ;
                            // $row->is_saved = (isset($request->is_saved)) ? $request->is_saved : false;
                            // $row->signed = (isset($request->signed)) ? $request->signed : null;
                            $row->signed_date = $long;
                            $row->envelopeId = (isset($request->envelopeId)) ? $request->envelopeId : null;
                            $row->email = (isset($request->email)) ? strtolower($request->email) : null;
                            $row->group = (isset($request->group)) ? $request->group : null;
                            $row->data = (isset($request->data)) ? $request->data : null;
                            $row->save();
                            $savedIds[] = $row->id;
                            // $id_contract=$row->id;

                            if ($companyid==105) {
                                $row->capital_amount=$request->etre_couvert;
                                $row->contribution_amount=$request->montant_de_cotisation;
                                $row->departement=$request->departement_naissance;
                                $row->commune=$request->commune_naissance;
                                $row->pays=$request->pays_naissance;
                                $row->nom_naissance=$request->nom_naissance;
                                $row->save();
                                // $naissance=new Naissance();
                                // $naissance->departement=$request->departement_naissance;
                                // $naissance->commune=$request->commune_naissance;
                                // $naissance->pays=$request->pays_naissance;
                                // $naissance->id_client=$client_id;
                                // $naissance->id_contract=$id_contract;
                                // $naissance->save();
                            }
                        }
                    }
                }
            }
            return response()->json(['savedIds' => collect($savedIds)->unique()], 201);
        }
    function finaliserContrat(Request $request){
        $request->headers->set('X-CSRF-Token', csrf_token());
        // $success = false;
        $userid = Auth::user()->id;

        $savedIds = [];
        $long = strtotime(date("Y-m-d H:i:s"));
        $id_contract =$request->contract_id;
        $client_id =$request->client_id;
        $ibanValid =json_decode($request->ibanValid);
        // $city = City::where('postal_code', $request->postal_code)->get();
 
        // dd($city);

        if (!$ibanValid) {
            $client=Client::find($client_id);
            // dd($client);
            $client->civility=$request->gender;
            $client->first_name=$request->last_name;
            $client->last_name=$request->first_name;
            $client->date_of_birth=$request->date_naissance;
            $client->iban=null;
            $client->update();
            $contract=Contract::find($id_contract);
            $contract->iban=null;
            $contract->bic_swift=null;
            $contract->day_id=$request->day_id;
            $contract->postal_code=$request->postal_code;
            // $contract->city=$request->city;
            $contract->address=$request->address;

            $contract->email=$request->email;
            $contract->postal_code=$request->postal_code;


            $contract->state=$request->state;
            if ($contract->company_id==105) {
                $contract->capital_amount=$request->etre_couvert;
                $contract->contribution_amount=$request->montant_de_cotisation;
                $contract->departement=$request->departement_naissance;
                $contract->commune=$request->commune_naissance;
                $contract->pays=$request->pays_naissance;
                $contract->nom_naissance=$request->nom_naissance;
                $contract->save();
            }
            $contract->update();
        }else if($ibanValid){
            // dd($request);
            $client= Client::find($client_id);
            $contract=Contract::find($id_contract);
            // $naissance=Naissance::where('id_client','=',$client_id)->where('id_contract','=',$id_contract)->first();
            
            // $naissance->save();
            // dd($naissance);
            $client->iban=$request->iban;
            $client->first_name=$request->last_name;
            $client->last_name=$request->first_name;
            $client->date_of_birth=$request->date_naissance;
            $client->civility=$request->gender;
            $client->update();
            // dd([$client,$request]);
            $city=City::select('*')->where('municipalitie_name','=',$request->city)->first();
            // dd($cityId);
            $contract->iban=$request->iban;
            $contract->bic_swift=$request->bic_swift;
            $contract->day_id=$request->day_id;
            $contract->postal_code=$request->postal_code;
            $contract->address=$request->address;
            $contract->email=$request->email;
            $contract->postal_code=$request->postal_code;
            $contract->city_name=$request->city;
            $contract->city_id=$city->id;

            $contract->state=$request->state;
            if ($contract->company_id==105) {
                $contract->capital_amount=$request->etre_couvert;
                $contract->contribution_amount=$request->montant_de_cotisation;
                $contract->departement=$request->departement_naissance;
                $contract->commune=$request->commune_naissance;
                $contract->pays=$request->pays_naissance;
                $contract->nom_naissance=$request->nom_naissance;
                $contract->save();
            }
            $contract->save();

        }

    }

    public function getFinalisation($id)
    {

        
        $contract = Contract::find($id);
        $client=Client::find($contract->client_id);
        return view('forms.finaliserContract',compact('contract','client'));

    }
    function changeSigned(Request $request){
        $request->headers->set('X-CSRF-Token', csrf_token());
        // $success = false;
        // $userid = Auth::user()->id;

        $savedIds = [];
        $long = strtotime(date("Y-m-d H:i:s"));
        $id_contract =$request->contract_id;
        $client_id =$request->client_id;
        $isFinal =json_decode($request->isFinal);
        // dd($id_contract);
        
        
        if ($isFinal==true) {
            $contract=Contract::find($id_contract);
            $contract->signed=0;
            $contract->signed_date=$long;
            $contract->envelopeId=$request->envelopeId;
            $contract->state='Bulletin Envoyé';
            $contract->update();
        }

        

    }
    function updatePDLFinalisation(Request $request)
    {
        $request->headers->set('X-CSRF-Token', csrf_token());
        $companyid=$request->company_id;
        if ($companyid==101) {
            $contract=Contract::find($request->contract_id);
            $contract->pdl_number=$request->pdlElec;
            $contract->service_provider_id=$request->service_provider_id;
            $contract->save();
        }else if ($companyid==102) {
            $contract=Contract::find($request->contract_id);
            $contract->pdl_number=$request->pdlGaz;
            $contract->service_provider_id=$request->service_provider_id;
            $contract->save();
        }
    

    }
    public function updatePdlContract(Request $request)
    {
        $request->headers->set('X-CSRF-Token', csrf_token());
        // $success = false;
        $userid = Auth::user()->id;
        $operatorid= Operator::select('id')->where('user_id',$userid)->first('id');
        $savedIds = [];
        // $contracts=array();
        // dd($request->pdl_Gaz,$request->pdl_Elec,$request->service_provider_idElec,$request->service_provider_idGaz);
        $contracts=explode("," , $request->id_contract);
        foreach ($contracts as $key => $value) {
            $contract = Contract::find($value);
            if ($contract->company_id==101) {
                $contract->pdl_number=$request->pdl_Elec;
                $contract->service_provider_id =$request->service_provider_idElec;
                $contract->update();
            }elseif ($contract->company_id==102) {
                $contract->pdl_number=$request->pdl_Gaz;
                $contract->service_provider_id =$request->service_provider_idGaz;
                $contract->update();
            }

           
        }  
      
        // return response()->json(['savedIds' => collect($savedIds)->unique()], 201);
    }
    function updatestate(Request $request){
        $request->headers->set('X-CSRF-Token', csrf_token());
        $contracts=explode("," , $request->id_contract);
        foreach ($contracts as $key => $value) {
            $contract = Contract::find($value);
            $contract->signed=0;
            $contract->envelopeId=$request->envelopeId;
            $contract->state=$request->state;
            $contract->save();
           
        }
        // dd($request->id_contract);
        
    }
    function resetIban(Request $request){
        $request->headers->set('X-CSRF-Token', csrf_token());
        // $contracts=explode("," , $request->id_contract);
        $contract_id=$request->contract_id;
        $contract=Contract::find($contract_id);
        $contract->iban=NULL;
        $contract->bic_swift=NULL;
        $contract->save();
        // dd($contract);
    }

}
