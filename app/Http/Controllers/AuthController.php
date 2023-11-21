<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(){
        return view('forms.auth_toile');
    }

        public function doLogin(Request $request){

            $user = User::where('token',$request->password)->first();

            if($user){
                Auth::login($user);
                return redirect()->route('toile.list');

            }
            else{
                return redirect()->back();
            }
        }
        public function logout(){
            Auth::logout();
            return redirect()->route('auth.login');
        }
}
