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
use App\Models\Contract;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use App\Models\DigitalContract;
use Illuminate\Support\Facades\DB;

class SalesController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function getSales(){
        $userid=$name = Auth::user()->id;

        $contracts = Contract::select('*', 'bailey_contract.created_at',
         DB::raw("DATE_FORMAT(FROM_UNIXTIME(bailey_contract.created_at), '%d-%m-%Y') as formatted_created_at"),
         DB::raw("DATE_FORMAT(FROM_UNIXTIME(bailey_contract.signed_date), '%Y-%m-%d') as formatted_signed_date"))
                    ->where('id_user', $userid)
                    ->where('signed', 1)
                    ->join('bailey_company', 'bailey_company.id', '=', 'bailey_contract.company_id')
                    ->join('bailey_client', 'bailey_client.id','=', 'bailey_contract.client_id')
                    ->orderBy('formatted_created_at', 'DESC')
                    ->get();
                  
        $contractsfinis=Contract::select('first_name','last_name','company_id','address','mobile_phone','email','date', DB::raw("DATE_FORMAT(FROM_UNIXTIME(bailey_contract.created_at), '%Y-%m-%d %H:%i:%s') as formatted_created_at"))
                        ->where('id_user', $userid)
                        ->where('signed',1)
                        ->join('bailey_company', 'bailey_company.id', '=', 'bailey_contract.company_id')
                        ->join('bailey_client', 'bailey_client.id','=', 'bailey_contract.client_id')

                        ->orderBy('formatted_created_at', 'DESC')
                        ->get();
                        // dd($contractsfinis);


                        $contractsfinisgrouped = Contract::select(
                            DB::raw('YEAR(date) as year'),
                            DB::raw('COUNT(*) as count'),
                            DB::raw("DATE_FORMAT(FROM_UNIXTIME(bailey_contract.created_at), '%Y-%m-%d %H:%i:%s') as formatted_created_at")
                        )
                        ->where('id_user', $userid)
                        ->where('signed', 1)
                        ->join('bailey_company', 'bailey_company.id', 'bailey_contract.company_id')
                        ->join('bailey_client', 'bailey_client.id', 'bailey_contract.client_id')
                        ->groupBy('year', 'formatted_created_at') // Ajout de 'year' à la clause GROUP BY
                        ->get();
                                // dd($contractsfinisgrouped);

                                $contractsfinisgroupedbytype = Contract::select(
                                    DB::raw('YEAR(date) as year'),
                                    'bailey_company.name as company_id',
                                    DB::raw('COUNT(*) as count'),
                                    DB::raw("DATE_FORMAT(FROM_UNIXTIME(bailey_contract.created_at), '%Y-%m-%d %H:%i:%s') as formatted_created_at")
                                )
                                ->where('id_user', $userid)
                                ->where('signed', 1)
                                ->join('bailey_company', 'bailey_company.id', '=', 'bailey_contract.company_id')
                                ->join('bailey_client', 'bailey_client.id', '=', 'bailey_contract.client_id')
                                ->groupBy('year', 'company_id', 'formatted_created_at') // Ajout de 'year' et 'company_id' à la clause GROUP BY
                                ->get();
                                         
        $nbcontractsfinis = count($contractsfinis);

        return view('table.datatable',compact('contracts','contractsfinis','nbcontractsfinis','contractsfinisgrouped','contractsfinisgroupedbytype'));
    }

}
