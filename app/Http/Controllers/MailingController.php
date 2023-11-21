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
use Illuminate\Support\Facades\Mail;
use DateTime;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;

class MailingController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function forgetpw(Request $request)
    {
        $host=env('HOST');
        $msg = "Vérifier vos cordonnées";
        $success= false;
        
        $user = User::where('email', 'like', $request->email)->first();
        if ($user) { 
            try{
                /* Mail sending */
                $fullname = ucfirst($user->username ?? '') ;
                $content = "Bonjour $fullname,<br/><br/>Vous avez demandé de récupérer vos <b>codes d'accès</b><br/>Cette opération vous attribuera un nouveau <b>mot de passe</b><br/>";
                $content .= "Si vous souhaitez confirmer cette demande, cliquer sur le lien suivant : <a href='$host/auth/getnewmdp'>récupérer votre mot de passe</a>.<br/><br/>";
                $content .= "Nous sommes à votre disposition pour toute information complémentaire.<br/><br/>";
                $header = "BAILEY";
                $footer = "DIGITALISATION";

                Mail::send('mailing.model', ['htmlMain' => $content, 'htmlHeader' => $header, 'htmlFooter' => $footer], function ($m) use ($request, $fullname) {
                    $m->from('support@havetdigital.fr');
                    $m->bcc('hbriere@havetdigital.fr');
                    $m->to($request->email, $fullname)->subject('Récupération de votre compte sur Bailey');
                });

                $success=true;
                $msg = 'Merci de consulter votre boite mail pour réinitialiser le mot de passe.';
            } catch (Exception $e) {
                $success = false;
                $msg = $request->email . ': Erreur Inconnue.';
            }
        } else {
            $msg = 'Cette adresse mail ' . $request->email . ' est n\'est jamais utilisé pour un compte';
            $success= false;
        }
        
        // return (['success'=>$success,'message'=>$msg]);
        // return view('auth.recoverpw', compact('msg', 'success'));
        // return redirect()->route('auth.recoverpw')->withSuccess('msg');
        // return redirect()->back()->with('message', $msg);
        return redirect()->back()->with(array('message' => $msg, 'success' => $success));
    }

    public function getnewmdp()
    {
        return view('auth.getnewmdp');
    }

    public function generatepass(Request $request)
    {     
        $msg = "Vérifier vos cordonnées";
        $success= false;

        $user = User::where('email', 'like', $request->email)->first();
        if ($user) {
            $user->password_hash = Hash::make($request->mdp);
            $user->save();
            
            $success=true;
            $msg = 'Votre mot de pass a été bien réinitialisé';
        }else {
            $msg = 'Cette adresse mail ' . $request->email . ' est n\'est jamais utilisé pour un compte';
            $success= false;
        }

        return redirect()->back()->with(array('message' => $msg, 'success' => $success));
    }
}
