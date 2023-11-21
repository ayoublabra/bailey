<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Contract;
use App\Models\Operator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ToileDeComController extends Controller
{
    public function index()
    {

        // dd(Auth::user());

        if(Auth::check())
        {
            return view(
                'forms.toile_index',
            );
        }else{
            return redirect()->route('auth.login');
        }

     
    }


    public function ibanValidation($ibanCheck)
    {
        $msg = "Votre Iban est incorrect ";
        $success = false;
        $status = 0;

        $api_key = 'ff9ef069c90419ed5f8c4c98fa93b0db';

        $post = [
            'format' => 'json',
            'api_key' => $api_key,
            'iban' => $ibanCheck,
        ];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.iban.com/clients/api/v4/iban/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => http_build_query($post),
            CURLOPT_SSL_VERIFYPEER => 0,
        ));

        $output = curl_exec($curl);

        $result = json_decode($output);


        $bic = $result->bank_data->bic;

        $chars = $result->validations->chars->code;

        $account = $result->validations->account->code;

        $iban = $result->validations->iban->code;

        $structure = $result->validations->structure->code;

        $length = $result->validations->length->code;

        $country_support = $result->validations->country_support->code;

        if (!empty($bic)) {
            $restbic = substr($bic, 0, -3);
        } else {
            $restbic = '';
            $success = false;
            $msg = "Votre Iban saisi est incorrect ! ";
        }

        if ($chars == 006 && $account == 002 && $iban == 001 && $structure == 005 && $length == 003 && $country_support == 007) {
            $success = true;
            $msg = "Votre Iban est correct";
        }

        curl_close($curl);

        $result = [
            'success' => $success,
            'msg' => $msg,
            'status' => $status,
            'bic' => $restbic,
        ];

        return $result;
    }





    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'insurance' => 'required|array',
            'civility' => 'required',
            'last_name_client' => 'required|string|max:255',
            'first_name_client' => 'required|string|max:255',
            'address_client' => 'required|string|max:255',
            'postal_code_client' => 'required|string|max:255',
            'city_client' => 'required|string|max:255',
            'email_client' => 'required|email|max:255',
            'landline_phone_client' => 'required|string|max:255',
            'mobile_phone_client' => 'required|string|max:255',
            'iban_client' => 'required|string|max:37',
            'bic_swift_client' => 'required|string|max:255',
            'date_creation' => 'required|date|max:255',
            'date_signature' => 'required|date|max:255',
            'date_validation' => 'required|date|max:255',
            'status' => 'required',
        ]);
        $iban = $validatedData['iban_client'];
        $ibanResult = $this->ibanValidation($iban);

     // Récupérez l'IBAN validé depuis la réponse de l'API
    if (!$ibanResult['success']) {
        // Si l'IBAN n'est pas valide, redirigez avec un message d'erreur
        return redirect()->back()->with('error', $ibanResult['msg']);
    }

        $client = Client::where('iban', $iban)->first();

        if ($client) {

            $client->last_name =  $validatedData['last_name'];
            $client->first_name =  $validatedData['first_name'];
            $client->civility =  intval($validatedData['civility']);
            $user_id = 650;
            $operator = Operator::where('first_name', $validatedData['first_name'])
                ->where('last_name', $validatedData['last_name'])
                ->where('user_id', $user_id)
                ->first();


            if (!$operator) {
                $operatorNew = new Operator();
                $operatorNew->last_name =  $validatedData['last_name'];
                $operatorNew->first_name =  $validatedData['first_name'];
                $operatorNew->user_id =  $user_id;
                $operatorNew->created_at = null;
                $operatorNew->updated_at =  null;
                $operatorNew->save();
            }

            $contract = Contract::where('iban', $iban)->first();
            $newArray = [];

            foreach ($validatedData['insurance'] as $value) {
                $newArray[] =  $value;
            }

            if($contract === null){
                return redirect()->route('toile.index');
            }else{


            foreach ($newArray as $value) {
                $contract->iban = $validatedData['iban_client'];
                $contract->bic_swift = $validatedData['bic_swift_client'];
                $contract->landline_phone = $validatedData['landline_phone_client'];
                $contract->mobile_phone = $validatedData['mobile_phone_client'];
                $contract->postal_code = $validatedData['postal_code_client'];
                $contract->address = $validatedData['address_client'];
                $contract->city_name = $validatedData['city_client'];
                $contract->company_id =  intval($value);
                $contract->created_at = strtotime($validatedData['date_creation']);
                $contract->signed_date = strtotime($validatedData['date_signature']);
                $contract->updated_at = strtotime($validatedData['date_validation']);
                $contract->status = $validatedData['status'];
                $contract->save();
            }
        }
            return redirect()->route('toile.list')->with('message', 'Le contrat a bien été mis à jour !');

        }else{

            return redirect()->route('toile.list')->with('message', "Une erreur s'est produite lors de la validation des données.");

        }
    }


    public function list()
    {

        
        if(Auth::check())
        {
            $items = DB::table('bailey_contract as d')
            ->join('bailey_company as c', 'd.company_id', '=', 'c.id')
            ->join('bailey_client as s', 'd.iban', '=', 's.iban')
            ->join('bailey_operator as o', 'd.operator_id', '=', 'o.id')
            ->select(
                'o.first_name as first_name_commercial',
                'o.last_name as last_name_commercial',
                'c.name as type_contract',
                's.civility as civility',
                's.last_name as last_name_client',
                's.first_name as first_name_client',
                'd.address as address_client',
                'd.postal_code as postal_code_client',
                'd.city_name as city_client',
                'd.email as email_client',
                'd.landline_phone as landline_phone_client',
                'd.mobile_phone as mobile_phone_client',
                'd.iban as iban_client',
                'd.bic_swift as bic_swift_client',
                'd.created_at as date_creation',
                'd.signed_date as date_signature',
                'd.updated_at as date_validation',
                'd.status'
            )
            ->whereNotIn('d.status', [0])
            ->orderByDesc('date_creation')
            ->paginate(10);

        return view(
            'forms.toile_list',
            [
                'items' => $items,
            ]
        );
        }else{
            return redirect()->route('auth.login');
        }
        
    }


    public function pagination(Request $request)
    {

        $items = DB::table('bailey_contract as d')
            ->join('bailey_company as c', 'd.company_id', '=', 'c.id')
            ->join('bailey_client as s', 'd.iban', '=', 's.iban')
            ->join('bailey_operator as o', 'd.operator_id', '=', 'o.id')
            ->select(
                'o.first_name as first_name_commercial',
                'o.last_name as last_name_commercial',
                'c.name as type_contract',
                's.civility as civility',
                's.last_name as last_name_client',
                's.first_name as first_name_client',
                'd.address as address_client',
                'd.postal_code as postal_code_client',
                'd.city_name as city_client',
                'd.email as email_client',
                'd.landline_phone as landline_phone_client',
                'd.mobile_phone as mobile_phone_client',
                'd.iban as iban_client',
                'd.bic_swift as bic_swift_client',
                'd.created_at as date_creation',
                'd.signed_date as date_signature',
                'd.updated_at as date_validation',
                'd.status'
            )
            ->whereNotIn('d.status', [0])
            ->orderByDesc('date_creation')
            ->paginate(10);
        return view(
            'forms.toile_pagination',
            compact('items')
        )->render();
    }
}

