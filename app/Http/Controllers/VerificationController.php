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

use Illuminate\Support\Facades\Mail;
use DateTime;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use App\Models\DigitalContract;
use App\Models\Contract;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;


class VerificationController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function infoCheck(Request $request){

        $success=false;
        $msg="";
        // dd($request->company_id);

        foreach ($request->company_id as $key => $value) {
            // $existsdcontractemail = DB::table('bailey_contract')
            //         ->whereNotIn('id', $request->id_contract)
            //         ->where('company_id', $value)
            //         ->where('email', $request->mail)
            //         ->first();

            // $existsdcontractephone = DB::table('bailey_contract')
            //         ->whereNotIn('id', $request->id_contract)
            //         ->where('company_id', $value)
            //         ->where('mobile_phone', $request->phone)
            //         ->first();

            $existscontractemail = DB::table('bailey_contract')
                    ->whereNotIn('id', $request->id_contract)
                    ->where('company_id', $value)
                    ->where('email', $request->mail)
                    ->first();
            $existscontractmobile = DB::table('bailey_contract')
                    ->whereNotIn('id', $request->id_contract)
                    ->where('company_id', $value)
                    ->where('mobile_phone', $request->phone)
                    ->first();
                    // dd($existscontract);
                    if ($value==101 || $value==102) {
                        if( $existscontractemail|| $existscontractmobile ){
                            $success=true;
                            $msg = "Il existe déjà le numéro mobile ou email, pour le contrat MAF veuillez contacter votre back-office Bailey Assurances"; 
                        }
                        
                        $result = [
                            'success' => $success,
                            'msg' => $msg
                        ];
                    }else if ($value==104) {

                        if( $existscontractemail|| $existscontractmobile ){
                            $success=true;
                            $msg = "Il existe déjà le numéro mobile ou email, pour le contrat PGE veuillez contacter votre back-office Bailey Assurances"; 
                        }
                        
                        $result = [
                            'success' => $success,
                            'msg' => $msg
                        ];
                    }else if ($value==105) {

                        if( $existscontractemail|| $existscontractmobile ){
                            $success=true;
                            $msg = "Il existe déjà le numéro mobile ou email, pour le contrat GFO veuillez contacter votre back-office Bailey Assurances"; 
                        }
                        
                        $result = [
                            'success' => $success,
                            'msg' => $msg
                        ];
                    }

            // $existscontractphone = DB::table('bailey_contract')
            //         ->whereNotIn('id', $request->id_contract)
            //         ->where('company_id', $value)
            //         ->first();
        }
        // $existsdcontractemail || $existsdcontractephone ||
        // if( $existscontract ){
        //     $success=true;
        //     $msg = "Il existe déjà le numéro mobile ou email, veuillez contacter votre back-office Bailey Assurances"; 
        // }
        
        // $result = [
        //     'success' => $success,
        //     'msg' => $msg
        // ];

        return response()->json($result);
            
    }

  public function ibanCheck(Request $request)
{
    $msg = "Votre Iban n'est pas correct";
    $success = false;
    $status = 0;
    $ibanExiste = false;

    if (!empty($request->iban)) {
        $companycontracts = $this->getCompanyContracts($request->iban);

        if ($companycontracts->isEmpty()) {
            $validationResult = $this->validateIban($request->iban);

            if ($validationResult['success']) {
                $success = true;
                $msg = "Votre Iban est correct";
            } else {
                $msg = $validationResult['msg'];
            }
        } else {
            $existingContracts = $this->getExistingContracts($companycontracts, $request->company_id);

            if (!empty($existingContracts)) {
                $success = false;
                $status = 1;
                $msg = "Vous avez déjà créé un contrat avec ce numéro d'IBAN";
                $ibanExiste = true;
                // Additional logic if needed
            } else {
                $validationResult = $this->validateIban($request->iban);

                if ($validationResult['success']) {
                    $success = true;
                    $msg = "Votre Iban est correct";
                } else {
                    $msg = $validationResult['msg'];
                }
            }
        }
    }

    $result = [
        'success' => $success,
        'msg' => $msg,
        'status' => $status,
        'ibanExiste' => $ibanExiste
    ];

    return response()->json($result);
}

private function getCompanyContracts($iban)
{
    return DB::table('bailey_contract')
        ->select('*')
        ->where('bailey_contract.iban', $iban)
        ->join('bailey_client', 'bailey_client.id', '=', 'bailey_contract.client_id')
        ->get();
}

private function validateIban($iban)
{
    $api_key = 'ff9ef069c90419ed5f8c4c98fa93b0db';
    $curl = curl_init();

    $post = [
        'format' => 'json',
        'api_key' => $api_key,
        'iban' => $iban,
    ];

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.iban.com/clients/api/v4/iban/',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POSTFIELDS => $post,
        CURLOPT_SSL_VERIFYPEER => 0
    ));

    $output = curl_exec($curl);
    $result = json_decode($output);

    $validations = $result->validations;

    $response = [
        'success' => ($validations->chars->code == 006 && $validations->account->code == 002 &&
            $validations->iban->code == 001 && $validations->structure->code == 005 &&
            $validations->length->code == 003 && $validations->country_support->code == 007),
        'msg' => "Votre Iban n'est pas correct"
    ];

    curl_close($curl);

    return $response;
}

private function getExistingContracts($contracts, $companyIds)
{
    $existingContracts = [];

    foreach ($contracts as $contract) {
        if (in_array($contract->company_id, $companyIds)) {
            $existingContracts[] = $contract;
        }
    }

    return $existingContracts;
}

    public function ibanCheck2(Request $request)
    {      
        $msg = "Votre Iban n'est pas correct";
        $success= false;
        $status=0;
        $ibanExiste=false;
       
        if (!empty($request->iban)) {
          
    
            $companycontracts = DB::table('bailey_contract')
            ->select('*')
            ->where('bailey_contract.iban', $request->iban)
            ->join('bailey_client', 'bailey_client.id','=', 'bailey_contract.client_id')
            ->get();
            // dd($request->company_id);
            $curl = curl_init();
            $api_key = 'ff9ef069c90419ed5f8c4c98fa93b0db';
            if ($companycontracts->isEmpty()) {
                  $post = [
                    'format' => 'json',
                    'api_key' => $api_key,
                    'iban'   => $request->iban,
                ];
                
                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://api.iban.com/clients/api/v4/iban/',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_POSTFIELDS => $post,
                    CURLOPT_SSL_VERIFYPEER => 0
                ));
                
                $output = curl_exec($curl);
                $result = json_decode($output);
                $bic= $result->bank_data->bic;
                $chars= $result->validations->chars->code;
                $account= $result->validations->account->code;
                $iban= $result->validations->iban->code;
                $structure= $result->validations->structure->code;
                $lenght= $result->validations->length->code;
                $country_support= $result->validations->country_support->code;
                // if(!empty($bic)){
                //     $restbic = substr($bic, 0, -3); 
                // }else{
                //     // $restbic =''; 
                //     $success=false;
                //     $msg="Votre Iban est incorrect";
                // }
                if($chars==006 && $account==002 && $iban==001 && $structure==005 && $lenght==003 && $country_support==007){
                    $success=true;
                    $ibanExiste=false;
                    $msg="Votre Iban est correct";
                }

                curl_close($curl);
                $ibanExiste=false;
               $result = [
                    'success' => $success,
                    'msg' => $msg,
                    'status' =>$status,
                    'ibanExiste' =>$ibanExiste
                    // 'bic' => $restbic
                ];
            } else {
                $curl = curl_init();
                $api_key = 'ff9ef069c90419ed5f8c4c98fa93b0db';
                $value=$request->company_id;
                $gender=json_decode($request->gender) ;
                for ($i=0; $i < count($companycontracts) ; $i++) { 
                        if ($value == 101) {
                            if ($companycontracts[$i]->company_id==$value ) {
                                $success=false;
                                $status=1;
                                $msg = "Vous avez déjà créer un contrat avec ce numéro d'IBAN";
                                $ibanExiste=true;
                                break;
                            }else{
                                $curl = curl_init();

                                $post = [
                                    'format' => 'json',
                                    'api_key' => $api_key,
                                    'iban'   => $request->iban,
                                ];
                                
                                curl_setopt($curl, CURLOPT_URL, 'https://api.iban.com/clients/api/v4/iban/');
                                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                                curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
                                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
                                
                                $output = curl_exec($curl);
                                $result = json_decode($output);
                                $bic= $result->bank_data->bic;
                                $chars= $result->validations->chars->code;
                                $account= $result->validations->account->code;
                                $iban= $result->validations->iban->code;
                                $structure= $result->validations->structure->code;
                                $lenght= $result->validations->length->code;
                                $country_support= $result->validations->country_support->code;
                                // if(!empty($bic)){
                                //     $restbic = substr($bic, 0, -3); 
                                // }else{
                                //     // $restbic =''; 
                                //     $success=false;
                                //     $msg="Votre Iban est incorrect";
                                // }
                                if($chars==006 && $account==002 && $iban==001 && $structure==005 && $lenght==003 && $country_support==007){
                                    $success=true;
                                    $msg="Votre Iban est correct";
                                }
                
                                curl_close($curl);
                                $ibanExiste=false;
                               $result = [
                                    'success' => $success,
                                    'msg' => $msg,
                                    'status' =>$status,
                                    'ibanExiste' =>$ibanExiste
                                    // 'bic' => $restbic
                                ]; 
                            }
                        }elseif ($value==102) {


                            if ($companycontracts[$i]->company_id==$value ) {
                                $success=false;
                                $status=1;
                                $msg = "Vous avez déjà créer un contrat avec ce numéro d'IBAN";
                                $ibanExiste=true;
                                break;

                            }else{
                                $curl = curl_init();

                                $post = [
                                    'format' => 'json',
                                    'api_key' => $api_key,
                                    'iban'   => $request->iban,
                                ];
                                
                                curl_setopt($curl, CURLOPT_URL, 'https://api.iban.com/clients/api/v4/iban/');
                                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                                curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
                                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
                                
                                $output = curl_exec($curl);
                                $result = json_decode($output);
                                $bic= $result->bank_data->bic;
                                $chars= $result->validations->chars->code;
                                $account= $result->validations->account->code;
                                $iban= $result->validations->iban->code;
                                $structure= $result->validations->structure->code;
                                $lenght= $result->validations->length->code;
                                $country_support= $result->validations->country_support->code;
                                // if(!empty($bic)){
                                //     $restbic = substr($bic, 0, -3); 
                                // }else{
                                //     // $restbic =''; 
                                //     $success=false;
                                //     $msg="Votre Iban est incorrect";
                                // }
                                if($chars==006 && $account==002 && $iban==001 && $structure==005 && $lenght==003 && $country_support==007){
                                    $success=true;
                                    $msg="Votre Iban est correct";
                                }
                
                                curl_close($curl);
                                $ibanExiste=false;
                               $result = [
                                    'success' => $success,
                                    'msg' => $msg,
                                    'status' =>$status,
                                    'ibanExiste' =>$ibanExiste
                                    // 'bic' => $restbic
                                ]; 
                            }
                        }elseif ($value==104) {

                            if ($companycontracts[$i]->company_id==$value ) {
                                $success=false;
                                $status=1;
                                $msg = "Vous avez déjà créer un contrat avec ce numéro d'IBAN";
                                $ibanExiste=true;
                                break;

                            }else{
                                $curl = curl_init();

                                $post = [
                                    'format' => 'json',
                                    'api_key' => $api_key,
                                    'iban'   => $request->iban,
                                ];
                                
                                curl_setopt($curl, CURLOPT_URL, 'https://api.iban.com/clients/api/v4/iban/');
                                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                                curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
                                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
                                // curl_setopt_array($curl, array(
                                //     CURLOPT_URL => 'https://api.iban.com/clients/api/v4/iban/',
                                //     CURLOPT_RETURNTRANSFER => true,
                                //     CURLOPT_POSTFIELDS => $post,
                                //     CURLOPT_SSL_VERIFYPEER => 0
                                // ));
                                
                                $output = curl_exec($curl);
                                $result = json_decode($output);
                                $bic= $result->bank_data->bic;
                                $chars= $result->validations->chars->code;
                                $account= $result->validations->account->code;
                                $iban= $result->validations->iban->code;
                                $structure= $result->validations->structure->code;
                                $lenght= $result->validations->length->code;
                                $country_support= $result->validations->country_support->code;
                                // if(!empty($bic)){
                                //     $restbic = substr($bic, 0, -3); 
                                // }else{
                                //     // $restbic =''; 
                                //     $success=false;
                                //     $msg="Votre Iban est incorrect";
                                // }
                                if($chars==006 && $account==002 && $iban==001 && $structure==005 && $lenght==003 && $country_support==007){
                                    $success=true;
                                    $msg="Votre Iban est correct";
                                }
                
                                curl_close($curl);
                                $ibanExiste=false;
                               $result = [
                                    'success' => $success,
                                    'msg' => $msg,
                                    'status' =>$status,
                                    'ibanExiste' =>$ibanExiste
                                    // 'bic' => $restbic
                                ]; 
                            }
                        }elseif ($value==105) {

                            if ($companycontracts[$i]->company_id==$value) {
                                $success=false;
                                $status=1;
                                $msg = "Vous avez déjà créer un contrat avec ce numéro d'IBAN";
                                $ibanExiste=true;

                            }else{
                                $curl = curl_init();
                                $post = [
                                    'format' => 'json',
                                    'api_key' => $api_key,
                                    'iban'   => $request->iban,
                                ];
                                
                                curl_setopt($curl, CURLOPT_URL, 'https://api.iban.com/clients/api/v4/iban/');
                                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                                curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
                                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
                                
                                $output = curl_exec($curl);
                                $result = json_decode($output);
                                $bic= $result->bank_data->bic;
                                $chars= $result->validations->chars->code;
                                $account= $result->validations->account->code;
                                $iban= $result->validations->iban->code;
                                $structure= $result->validations->structure->code;
                                $lenght= $result->validations->length->code;
                                $country_support= $result->validations->country_support->code;
                                // if(!empty($bic)){
                                //     $restbic = substr($bic, 0, -3); 
                                // }else{
                                //     // $restbic =''; 
                                //     $success=false;
                                //     $msg="Votre Iban est incorrect";
                                // }
                                if($chars==006 && $account==002 && $iban==001 && $structure==005 && $lenght==003 && $country_support==007){
                                    $success=true;
                                    $msg="Votre Iban est correct";
                                }
                
                                curl_close($curl);
                                $ibanExiste=false;
                               $result = [
                                    'success' => $success,
                                    'msg' => $msg,
                                    'status' =>$status,
                                    'ibanExiste' =>$ibanExiste
                                    // 'bic' => $restbic
                                ]; 
                            }
                        }
                       
                    // }
                }
                $result = [
                    'success' => $success,
                    'msg' => $msg,
                    'status' =>$status,
                    'ibanExiste' =>$ibanExiste
                ];
               
            }
           
           
       
            // }
            

            return response()->json($result);
        }
    }


    public function sendSMS(Request $request)
    {
        $id = Auth::user()->id;
        $name = Auth::user()->username;
        $identifiant = $name . "-" . $id;
        $code = $request->get('random');
        $number = $request->get('number');
        $access_token = 'b5qAvqdcBapWAxw1K7Rl2VKNwOovT5dP';
        $isFinalisation=json_decode($request->isFinalisation);
        // dd($isFinalisation);
        // dd($identifiant);
        $d=null;
        $client = new Client();
        if (isset($isFinalisation)) {
            $d='Le+lien+est+https://bailey.devconnectdigital.com/getDocumentFinalisation/user='.$identifiant;
        }else{
            $d='Le+lien+est+https://bailey.devconnectdigital.com/getDocument/user='.$identifiant;

        }
        // dd($d);

       
        // $d='Le+lien+est+https://preprod-baileyprod.havetdigital.app/getDocument/user='.$identifiant;
        
        $msg=$d;
        $emetteur="BaileyAssu";

        // URL de l'API SMSMode pour l'envoi de SMS
        $url = 'https://api.smsmode.com/http/1.6/sendSMS.do?accessToken='.$access_token.'&message='.$msg.'&numero='.$number.'&emetteur='.$emetteur;

        
        $response = $client->post($url);

        if ($response->getStatusCode() == 200) {
            return true;
        } else {
            return false;
        }
    }
        // $id = Auth::user()->id;
        // $name = Auth::user()->username;
        // $identifiant=$name."-".$id;
        // // $datenow= date("Y-m-d h:i:s");
        // $code = $request->get('random');
        // $number = $request->get('number');
        // $access_token = 'b5qAvqdcBapWAxw1K7Rl2VKNwOovT5dP';
        // // $curl = curl_init();
        // $msg="Le+lien+est+http://baileyprod.havetdigital.app/getDocument/user=".$identifiant;
        // // if (!empty($code)) {
        // //     curl_setopt_array($curl, array(
        // //         CURLOPT_URL => 'https://api.smsmode.com/http/1.6/sendSMS.do?accessToken='.$access_token.'&message='.$msg.'&numero='.$number,
        // //         CURLOPT_RETURNTRANSFER => true
        // //     ));
        // //     $output = curl_exec($curl);
        // //     $arrayString= explode(" ", $output);
        // //     dd($arrayString);
        // //     $code=$arrayString[0];
        // //     $msg=$arrayString[1];
        // //     //$key=$arrayString[2];
    
        // //     return true;
        // //     curl_close($curl);
        // // }
        // $client = new Client();
        // // $code = $request->get('random');
        // // URL de l'API SMSMode pour l'envoi de SMS
        // $url = 'https://api.smsmode.com/http/1.6/sendSMS.do';

        // // Paramètres de la requête POST
        // $params = [
        //     'query' => [
        //         'accessToken' => $access_token,
        //         'message' => $msg,
        //         'numero' => $number,
        //         'emetteur' => 'Assurance Bailey',]
        // ];
        // $response = $client->post($url, $params);
        
        // if ($response->getStatusCode() == 200) {
        //     return true;
        // } else {
        //     return false;
        // }
        // return true;
    //}

    // public function sendSMSFinalisation(Request $request)
    // {
    //     $id = Auth::user()->id;
    //     $name = Auth::user()->username;
    //     $identifiant = $name . "-" . $id;
    //     $code = $request->get('random');
    //     $number = $request->get('number');
    //     $access_token = 'b5qAvqdcBapWAxw1K7Rl2VKNwOovT5dP';
    //     // dd($identifiant);
    //     $client = new Client();

    
    //     $d='Le+lien+est+https://preprod-baileyprod.havetdigital.app/getDocumentFinalisation/user='.$identifiant;
    //     // $d='je suis la';
    //     dd($d);
    //     $msg=$d;
    //     $emetteur='Assurance Bailey';

    //     // URL de l'API SMSMode pour l'envoi de SMS
    //     $url = 'https://api.smsmode.com/http/1.6/sendSMS.do?accessToken='.$access_token.'&message='.$msg.'&numero='.$number.'&emetteur='.$emetteur;

        
    //     $response = $client->post($url);

    //     if ($response->getStatusCode() == 200) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }
    // public function sendSMS2(Request $request)
    // {
    //     $id = Auth::user()->id;
    //     $name = Auth::user()->username;
    //     $identifiant = $name . "-" . $id;
    //     $code = $request->get('random');
    //     $number = $request->get('number');
    //     $access_token = 'b5qAvqdcBapWAxw1K7Rl2VKNwOovT5dP';
    //     // dd($identifiant);
    //     $client = new Client();
    //     // dd('finalisation sms');
    //     // Construire le lien encodé
    //     // $link = urlencode("http://baileyprod.havetdigital.app/getDocument/user=" . $identifiant);

    //     $msg="Le lien est: https://baileyprod.havetdigital.app/getDocument/user=".$identifiant;
    //     // dd($d);
    //     // Construire le message SMS avec le lien encodé
    //     // $msg="Le lien est: ".$d;

    //     // URL de l'API SMSMode pour l'envoi de SMS
    //     $url = 'https://api.smsmode.com/http/1.6/sendSMS.do';

    //     // Paramètres de la requête POST
    //     $params = [
    //         'query' => [
    //             'accessToken' => $access_token,
    //             'message' => $msg,
    //             'numero' => $number,
    //             'emetteur' => 'Assurance Bailey'
    //         ],
    //     ];
    //     $response = $client->post($url, $params);

    //     if ($response->getStatusCode() == 200) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    //     // $id = Auth::user()->id;
    //     // $name = Auth::user()->username;
    //     // $identifiant=$name."-".$id;
    //     // // $datenow= date("Y-m-d h:i:s");
    //     // $code = $request->get('random');
    //     // $number = $request->get('number');
    //     // $access_token = 'b5qAvqdcBapWAxw1K7Rl2VKNwOovT5dP';
    //     // // $curl = curl_init();
    //     // $msg="Le+lien+est+http://baileyprod.havetdigital.app/getDocument/user=".$identifiant;
    //     // // if (!empty($code)) {
    //     // //     curl_setopt_array($curl, array(
    //     // //         CURLOPT_URL => 'https://api.smsmode.com/http/1.6/sendSMS.do?accessToken='.$access_token.'&message='.$msg.'&numero='.$number,
    //     // //         CURLOPT_RETURNTRANSFER => true
    //     // //     ));
    //     // //     $output = curl_exec($curl);
    //     // //     $arrayString= explode(" ", $output);
    //     // //     dd($arrayString);
    //     // //     $code=$arrayString[0];
    //     // //     $msg=$arrayString[1];
    //     // //     //$key=$arrayString[2];
    
    //     // //     return true;
    //     // //     curl_close($curl);
    //     // // }
    //     // $client = new Client();
    //     // // $code = $request->get('random');
    //     // // URL de l'API SMSMode pour l'envoi de SMS
    //     // $url = 'https://api.smsmode.com/http/1.6/sendSMS.do';

    //     // // Paramètres de la requête POST
    //     // $params = [
    //     //     'query' => [
    //     //         'accessToken' => $access_token,
    //     //         'message' => $msg,
    //     //         'numero' => $number,
    //     //         'emetteur' => 'Assurance Bailey',]
    //     // ];
    //     // $response = $client->post($url, $params);
        
    //     // if ($response->getStatusCode() == 200) {
    //     //     return true;
    //     // } else {
    //     //     return false;
    //     // }
    //     // return true;
    // }

}