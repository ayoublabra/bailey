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
use App\Models\Operator;
use App\Models\DocumentModel;
use App\Models\ServiceProvider;
use Illuminate\Support\Facades\Log; // Assurez-vous d'importer la classe Log


use Illuminate\Support\Facades\Mail;
use DateTime;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;

use PDF;

class GeneratePdfController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;



    public function index(Request $request)
    {
        $id = Auth::user()->id;
        $name = Auth::user()->username;
        $identifiant=$name."-".$id;


        set_time_limit(300);

        $data = [
            'title' => 'DOCUMENT PRECONTRACTUEL D’INFORMATION ET DE CONSEIL',
            'fname' => $request->fname,
            'lname' => $request->lname,
            'datebird' =>  date('d/m/Y', strtotime($request->datebirth)),
            'adresse' => $request->adresse,
            'city' => $request->city,
            'cp' => $request->cp,
            'mail' => $request->mail,
            'phone' => $request->phone,
            'code' => $request->code,
            'checkfinancement' => $request->checkfinancement,
            'checkrisque' => $request->checkrisque,
            'checkproduct' => $request->checkproduct,
            'checkfinancementicon' => $request->checkfinancementicon,
            'checkrisqueicon' => $request->checkrisqueicon,
            'checkproducticon' => $request->checkproducticon,
            'typeselected' => $request->typeselected,
            'textselected' => explode(',', $request->textselected),
            'date' => date('d/m/Y'),
            'comment' => $request->comment
        ];
        $data_gfo = [
            'situation_pro'=> $request->situation_pro,
            'montant_de_cotisation'=> $request->montant_de_cotisation,
            'statu_famille'=> $request->statu_famille,
            'avec_enfant'=> $request->avec_enfant,
            'nbr_pers_a_charger'=> $request->nbr_pers_a_charger,
            'etre_couvert'=> $request->etre_couvert,
            'fname' => $request->fname,
            'lname' => $request->lname,
            'datebird' =>  date('d/m/Y', strtotime($request->datebirth)),
            'age' =>  $request->age,
            'adresse' => $request->adresse,
            'city' => $request->city,
            'cp' => $request->cp,
            'mail' => $request->mail,
            'phone' => $request->phone,
            'code' => $request->code,
            'checkMutuelle' => $request->checkMutuelle,
            'checkAssuranceDece' => $request->checkAssuranceDece,
            'checkHospitalisation' => $request->checkHospitalisation,
            'checkProtection' => $request->checkProtection,
            'checkGarantie' => $request->checkGarantie,
            'checkDepandance' => $request->checkDepandance,
            'checkAssuranceVie' => $request->checkAssuranceVie,
            'checkAutre' => $request->checkAutre,
            'checkAucun' => $request->checkAucun,
            'checkProtegerFamille' => $request->checkProtegerFamille,
            'checkEtreAssurer' => $request->checkEtreAssurer,
            'checkPrevoirFinance' => $request->checkPrevoirFinance,
            'checkCompleteCap' => $request->checkCompleteCap,
            'checkMutuelleIcon' => $request->checkMutuelleIcon,
            'checkAssuranceDeceIcon' => $request->checkAssuranceDeceIcon,
            'checkHospitalisationIcon' => $request->checkHospitalisationIcon,
            'checkProtectionIcon' => $request->checkProtectionIcon,
            'checkGarantieIcon' => $request->checkGarantieIcon,
            'checkDepandanceIcon' => $request->checkDepandanceIcon,
            'checkAssuranceVieIcon' => $request->checkAssuranceVieIcon,
            'checkAutreIcon' => $request->checkAutreIcon,
            'checkAucunIcon' => $request->checkAucunIcon,
            'checkProtegerFamilleIcon' => $request->checkProtegerFamilleIcon,
            'checkEtreAssurerIcon' => $request->checkEtreAssurerIcon,
            'checkPrevoirFinanceIcon' => $request->checkPrevoirFinanceIcon,
            'checkCompleteCapIcon' => $request->checkCompleteCapIcon,
            'typeselected' => $request->typeselected,
            'textselected' => explode(',', $request->textselected),
            'date' =>  date('d/m/Y'),
        ];

        $array = explode(',', $request->typeselected);
        if(in_array('101', $array) && in_array('102', $array)){
            $pdf = PDF::loadView('pdf.elecGazSms', $data);
        }else if(in_array('101', $array) || in_array('102', $array)){
            $pdf = PDF::loadView('pdf.elecGazSms', $data);
        }else if(in_array('104', $array)){
            $pdf = PDF::loadView('pdf.pgeSms', $data);
        }else if(in_array('105', $array)){
            $pdf = PDF::loadView('pdf.gfoSms', $data_gfo);
        }

        $dir = "files";
        $filename = "bailey_{$identifiant}.pdf";
        $file = "$dir/$filename";

        if (file_exists($file)) {
            unlink($file);
        }

        $content_to_write = $pdf->download()->getOriginalContent();

        $filetoput = fopen($file, "w");

        fwrite($filetoput, $content_to_write);

        fclose($filetoput);

        // return $pdf->download('bailey.pdf');

        // return $pdf->stream();

        // $pdf->loadView('pdf.elecGaz', $data);
        // return $pdf->stream();
    }



    public function index2(Request $request)
    {
        try {
            $id = Auth::user()->id;
            $name = Auth::user()->username;
            $identifiant=$name."-".$id;
            // $nomclinet=$request['fname'];
            // $prenomclinet=$request['lname'];

            set_time_limit(300);

            $data = [
                'title' => 'DOCUMENT PRECONTRACTUEL D’INFORMATION ET DE CONSEIL',
                'fname' => $request->fname,
                'lname' => $request->lname,
                'datebird' =>  date('d/m/Y', strtotime($request->datebirth)),
                'adresse' => $request->adresse,
                'city' => $request->city,
                'cp' => $request->cp,
                'mail' => $request->mail,
                'phone' => $request->phone,
                'code' => $request->code,
                'checkfinancement' => $request->checkfinancement,
                'checkrisque' => $request->checkrisque,
                'checkproduct' => $request->checkproduct,
                'checkfinancementicon' => $request->checkfinancementicon,
                'checkrisqueicon' => $request->checkrisqueicon,
                'checkproducticon' => $request->checkproducticon,
                // 'company' => $request->company,
                // 'textselected' => explode(',', $request->textselected),
                'date' => date('d/m/Y'),
                'comment' => $request->comment
            ];
            $data_gfo = [
                'situation_pro'=> $request->situation_pro,
                'statu_famille'=> $request->statu_famille,
                'avec_enfant'=> $request->avec_enfant,
                'nbr_pers_a_charger'=> $request->nbr_pers_a_charger,
                'etre_couvert'=> $request->etre_couvert,
                'fname' => $request->fname,
                'lname' => $request->lname,
                'datebird' =>  date('d/m/Y', strtotime($request->datebirth)),
                'age' =>  $request->age,
                'adresse' => $request->adresse,
                'city' => $request->city,
                'cp' => $request->cp,
                'mail' => $request->mail,
                'phone' => $request->phone,
                'code' => $request->code,
                'checkMutuelle' => $request->checkMutuelle,
                'checkAssuranceDece' => $request->checkAssuranceDece,
                'checkHospitalisation' => $request->checkHospitalisation,
                'checkProtection' => $request->checkProtection,
                'checkGarantie' => $request->checkGarantie,
                'checkDepandance' => $request->checkDepandance,
                'checkAssuranceVie' => $request->checkAssuranceVie,
                'checkAutre' => $request->checkAutre,
                'checkAucun' => $request->checkAucun,
                'checkProtegerFamille' => $request->checkProtegerFamille,
                'checkEtreAssurer' => $request->checkEtreAssurer,
                'checkPrevoirFinance' => $request->checkPrevoirFinance,
                'checkCompleteCap' => $request->checkCompleteCap,
                'checkMutuelleIcon' => $request->checkMutuelleIcon,
                'checkAssuranceDeceIcon' => $request->checkAssuranceDeceIcon,
                'checkHospitalisationIcon' => $request->checkHospitalisationIcon,
                'checkProtectionIcon' => $request->checkProtectionIcon,
                'checkGarantieIcon' => $request->checkGarantieIcon,
                'checkDepandanceIcon' => $request->checkDepandanceIcon,
                'checkAssuranceVieIcon' => $request->checkAssuranceVieIcon,
                'checkAutreIcon' => $request->checkAutreIcon,
                'checkAucunIcon' => $request->checkAucunIcon,
                'checkProtegerFamilleIcon' => $request->checkProtegerFamilleIcon,
                'checkEtreAssurerIcon' => $request->checkEtreAssurerIcon,
                'checkPrevoirFinanceIcon' => $request->checkPrevoirFinanceIcon,
                'checkCompleteCapIcon' => $request->checkCompleteCapIcon,
                // 'typeselected' => $request->typeselected,
                // 'textselected' => explode(',', $request->textselected),
                'date' =>  date('d/m/Y'),
            ];
            // ... (votre code existant)

            $company_id = $request->company_id;
            $pdf2 = null;
            // dd($company_id);
            if ($company_id == 101 || $company_id == 102) {
                $pdf2 = PDF::loadView('pdf.elecGazSmsFinalisation', $data);
            } else if ($company_id == 104) {
                $pdf2 = PDF::loadView('pdf.pgeSmsFinalisation', $data);
            } else if ($company_id == 105) {
                $pdf2 = PDF::loadView('pdf.gfoSmsFinalisation', $data_gfo);
            }

            if ($pdf2) {
                $dir = "filesFinalisation";
                $filename = "bailey_{$identifiant}.pdf";
                $file = "$dir/$filename";

                if (file_exists($file)) {
                    unlink($file);
                }

                $content_to_write2 = $pdf2->download()->getOriginalContent();

                $filetoput = fopen($file, "w");

                fwrite($filetoput, $content_to_write2);

                fclose($filetoput);

                // Retourner ou effectuer d'autres actions si nécessaire
            } else {
                Log::error('La génération du PDF a échoué. Le PDF est null.');
                // Gérer le cas où $pdf2 est null (enregistrement dans les journaux, retourner une réponse, etc.)
            }
        } catch (\Exception $e) {
            Log::error('Erreur lors de la génération du PDF: ' . $e->getMessage());
            // Gérer les exceptions (enregistrement dans les journaux, retourner une réponse, etc.)
        }
    }





    public function indexNoCode(Request $request)
    {
        $id = Auth::user()->id;
        $name = Auth::user()->username;
        $identifiant=$name."-".$id;

        set_time_limit(300);

        $data = [
            'title' => 'DOCUMENT PRECONTRACTUEL D’INFORMATION ET DE CONSEIL',
            'fname' => $request->fname,
            'lname' => $request->lname,
            'datebird' =>  date('d/m/Y', strtotime($request->datebirth)),
            'adresse' => $request->adresse,
            'city' => $request->city,
            'cp' => $request->cp,
            'mail' => $request->mail,
            'phone' => $request->phone,
            'code' => $request->code,
            'checkfinancement' => $request->checkfinancement,
            'checkrisque' => $request->checkrisque,
            'checkproduct' => $request->checkproduct,
            'checkfinancementicon' => $request->checkfinancementicon,
            'checkrisqueicon' => $request->checkrisqueicon,
            'checkproducticon' => $request->checkproducticon,
            'typeselected' => $request->typeselected,
            'textselected' => explode(',', $request->textselected),
            'date' =>  date('d/m/Y'),
            'comment' => $request->comment
        ];
        $data_gfo = [
            'situation_pro'=> $request->situation_pro,
            'statu_famille'=> $request->statu_famille,
            'avec_enfant'=> $request->avec_enfant,
            'nbr_pers_a_charger'=> $request->nbr_pers_a_charger,
            'etre_couvert'=> $request->etre_couvert,
            'montant_de_cotisation'=> $request->montant_de_cotisation,
            'fname' => $request->fname,
            'lname' => $request->lname,
            'datebird' =>  date('d/m/Y', strtotime($request->datebirth)),
            'age' =>  $request->age,
            'adresse' => $request->adresse,
            'city' => $request->city,
            'cp' => $request->cp,
            'mail' => $request->mail,
            'phone' => $request->phone,
            'code' => $request->code,
            'checkMutuelle' => $request->checkMutuelle,
            'checkAssuranceDece' => $request->checkAssuranceDece,
            'checkHospitalisation' => $request->checkHospitalisation,
            'checkProtection' => $request->checkProtection,
            'checkGarantie' => $request->checkGarantie,
            'checkDepandance' => $request->checkDepandance,
            'checkAssuranceVie' => $request->checkAssuranceVie,
            'checkAutre' => $request->checkAutre,
            'checkAucun' => $request->checkAucun,
            'checkProtegerFamille' => $request->checkProtegerFamille,
            'checkEtreAssurer' => $request->checkEtreAssurer,
            'checkPrevoirFinance' => $request->checkPrevoirFinance,
            'checkCompleteCap' => $request->checkCompleteCap,
            'checkMutuelleIcon' => $request->checkMutuelleIcon,
            'checkAssuranceDeceIcon' => $request->checkAssuranceDeceIcon,
            'checkHospitalisationIcon' => $request->checkHospitalisationIcon,
            'checkProtectionIcon' => $request->checkProtectionIcon,
            'checkGarantieIcon' => $request->checkGarantieIcon,
            'checkDepandanceIcon' => $request->checkDepandanceIcon,
            'checkAssuranceVieIcon' => $request->checkAssuranceVieIcon,
            'checkAutreIcon' => $request->checkAutreIcon,
            'checkAucunIcon' => $request->checkAucunIcon,
            'checkProtegerFamilleIcon' => $request->checkProtegerFamilleIcon,
            'checkEtreAssurerIcon' => $request->checkEtreAssurerIcon,
            'checkPrevoirFinanceIcon' => $request->checkPrevoirFinanceIcon,
            'checkCompleteCapIcon' => $request->checkCompleteCapIcon,
            'typeselected' => $request->typeselected,
            'textselected' => explode(',', $request->textselected),
            'date' =>  date('d/m/Y'),
        ];

        $array = explode(',', $request->typeselected);

        if(in_array('101', $array) && in_array('102', $array)){
            $pdf = PDF::loadView('pdf.elecGazSmsNoCode', $data);
        }else if(in_array('101', $array) || in_array('102', $array)){
            $pdf = PDF::loadView('pdf.elecGazSmsNoCode', $data);
        }else if(in_array('104', $array)){
            $pdf = PDF::loadView('pdf.pgeSmsNoCode', $data);
        } else if(in_array('105', $array)){
            $pdf = PDF::loadView('pdf.gfoSmsNoCode', $data_gfo);
        }
        $dir = "filesNoCode";
        $filename = "bailey_{$identifiant}.pdf";
        $file = "$dir/$filename";

        // Delete old file if it exists
        if (file_exists($file)) {
            unlink($file);
        }

        $content_to_write = $pdf->download()->getOriginalContent();

        $filetoput = fopen($file, "w");

        fwrite($filetoput, $content_to_write);

        fclose($filetoput);

        $result = [
            'success' => true,
        ];

        return $result;
    }
    public function indexNoCode2(Request $request)
    {
        $id = Auth::user()->id;
        $name = Auth::user()->username;
        $identifiant=$name."-".$id;
        // $nomclinet=$request['fname'];
        // $prenomclinet=$request['lname'];

        set_time_limit(300);

        $data = [
            'title2' => 'DOCUMENT PRECONTRACTUEL D’INFORMATION ET DE CONSEIL',
            'fname2' => $request->fname,
            'lname2' => $request->lname,
            'datebird2' =>  date('d/m/Y', strtotime($request->datebirth)),
            'adresse2' => $request->adresse,
            'city2' => $request->city,
            'cp2' => $request->cp,
            'mail2' => $request->mail,
            'phone2' => $request->phone,
            'code2' => $request->code,
            'checkfinancement2' => $request->checkfinancement,
            'checkrisque2' => $request->checkrisque,
            'checkproduct2' => $request->checkproduct,
            'checkfinancementicon2' => $request->checkfinancementicon,
            'checkrisqueicon2' => $request->checkrisqueicon,
            'checkproducticon2' => $request->checkproducticon,
            // 'typeselected' => $request->typeselected,
            // 'textselected' => explode(',', $request->textselected),
            'date2' =>  date('d/m/Y'),
            'comment2' => $request->comment
        ];
        $data_gfo = [
            'situation_pro'=> $request->situation_pro,
            'statu_famille'=> $request->statu_famille,
            'avec_enfant'=> $request->avec_enfant,
            'nbr_pers_a_charger'=> $request->nbr_pers_a_charger,
            'etre_couvert'=> $request->etre_couvert,
            'montant_de_cotisation'=> $request->montant_de_cotisation,
            'fname' => $request->fname,
            'lname' => $request->lname,
            'datebird' =>  date('d/m/Y', strtotime($request->datebirth)),
            'age' =>  $request->age,
            'adresse' => $request->adresse,
            'city' => $request->city,
            'cp' => $request->cp,
            'mail' => $request->mail,
            'phone' => $request->phone,
            'code' => $request->code,
            'checkMutuelle' => $request->checkMutuelle,
            'checkAssuranceDece' => $request->checkAssuranceDece,
            'checkHospitalisation' => $request->checkHospitalisation,
            'checkProtection' => $request->checkProtection,
            'checkGarantie' => $request->checkGarantie,
            'checkDepandance' => $request->checkDepandance,
            'checkAssuranceVie' => $request->checkAssuranceVie,
            'checkAutre' => $request->checkAutre,
            'checkAucun' => $request->checkAucun,
            'checkProtegerFamille' => $request->checkProtegerFamille,
            'checkEtreAssurer' => $request->checkEtreAssurer,
            'checkPrevoirFinance' => $request->checkPrevoirFinance,
            'checkCompleteCap' => $request->checkCompleteCap,
            'checkMutuelleIcon' => $request->checkMutuelleIcon,
            'checkAssuranceDeceIcon' => $request->checkAssuranceDeceIcon,
            'checkHospitalisationIcon' => $request->checkHospitalisationIcon,
            'checkProtectionIcon' => $request->checkProtectionIcon,
            'checkGarantieIcon' => $request->checkGarantieIcon,
            'checkDepandanceIcon' => $request->checkDepandanceIcon,
            'checkAssuranceVieIcon' => $request->checkAssuranceVieIcon,
            'checkAutreIcon' => $request->checkAutreIcon,
            'checkAucunIcon' => $request->checkAucunIcon,
            'checkProtegerFamilleIcon' => $request->checkProtegerFamilleIcon,
            'checkEtreAssurerIcon' => $request->checkEtreAssurerIcon,
            'checkPrevoirFinanceIcon' => $request->checkPrevoirFinanceIcon,
            'checkCompleteCapIcon' => $request->checkCompleteCapIcon,
            // 'co' => $request->co,
            // 'textselected' => explode(',', $request->textselected),
            'date' =>  date('d/m/Y'),
        ];

        $company_id = $request->company_id;
        // dd($company_id);
        if($company_id==101 || $company_id==102 ){
            $pdf = PDF::loadView('pdf.elecGazSmsNoCodeFinalisation', $data);
        }else if($company_id==104){
            $pdf = PDF::loadView('pdf.pgeSmsNoCodeFinalisation', $data);
        } else if($company_id==105){
            $pdf = PDF::loadView('pdf.gfoSmsNoCodeFinalisation', $data_gfo);
        }
        $dir = "filesNoCodeFinalisation";
        $filename = "bailey_{$identifiant}.pdf";
        $file = "$dir/$filename";

        // Delete old file if it exists
        if (file_exists($file)) {
            unlink($file);
        }

        $content_to_write = $pdf->download()->getOriginalContent();

        $filetoput = fopen($file, "w");

        fwrite($filetoput, $content_to_write);

        fclose($filetoput);

        $result = [
            'success' => true,
        ];

        return $result;
    }


    public function getDocument()
    {
        $url = $_SERVER["REQUEST_URI"];

        $strArray = explode('/',$url);
        $part1 = $strArray[2];
        $part2 = explode('=',$part1);
        $part3= explode('=',$part2[1]);
        $uservalue=$part2[1];

        set_time_limit(300);

        $dir = "files";
        $filename = "bailey_{$uservalue}.pdf";
        $file = "$dir/$filename";

        // Header content type
        header('Content-type: application/pdf');
        header('Content-Disposition: inline; filename="' . $file . '"');
        header('Content-Transfer-Encoding: binary');
        header('Accept-Ranges: bytes');

        // Read the file
        @readfile($file);

    }

    public function getDocumentFinalisation()
    {
        $url = $_SERVER["REQUEST_URI"];

        $strArray = explode('/',$url);
        $part1 = $strArray[2];
        $part2 = explode('=',$part1);
        $part3= explode('=',$part2[1]);
        $uservalue=$part2[1];

        set_time_limit(300);

        $dir = "filesFinalisation";
        $filename = "bailey_{$uservalue}.pdf";
        $file = "$dir/$filename";

        // Header content type
        header('Content-type: application/pdf');
        header('Content-Disposition: inline; filename="' . $file . '"');
        header('Content-Transfer-Encoding: binary');
        header('Accept-Ranges: bytes');

        // Read the file
        @readfile($file);

    }

    public function getDocumentNoCode()
    {
        $uservalue = $this->getUserValueFromUrl();
        set_time_limit(300);
        $file = "filesNoCode/bailey_{$uservalue}.pdf";

        // Header content type
        header('Content-type: application/pdf');
        header('Content-Disposition: inline; filename="' . $file . '"');
        header('Content-Transfer-Encoding: binary');
        header('Accept-Ranges: bytes');

        // Read the file
        @readfile($file);
    }
    public function getDocumentNoCodeFinalisation()
    {
        $uservalue = $this->getUserValueFromUrl();
        set_time_limit(300);
        $file = "filesNoCodeFinalisation/bailey_{$uservalue}.pdf";

        // Header content type
        header('Content-type: application/pdf');
        header('Content-Disposition: inline; filename="' . $file . '"');
        header('Content-Transfer-Encoding: binary');
        header('Accept-Ranges: bytes');

        // Read the file
        @readfile($file);
    }

    private function getUserValueFromUrl()
    {
        $url = $_SERVER["REQUEST_URI"];
        preg_match('/=([^&]*)/', $url, $matches);
        return $matches[1];
    }


    public function mailingindex(Request $request)
    {
        set_time_limit(300);

        $name = Auth::user()->username;

        $id = Auth::user()->id;
        $identifiant=$name."-".$id;

        $operatorid= Operator::select('last_name','first_name')->where('user_id',$id)->first('id');

        $lettrefirst=substr($operatorid->first_name, 0, 1)??null;

        $xvalue=$request->xvalue;

        $num = rand(1000, 9999);

        $yy=date("Y");
        $mm=date('m');

        $number='D/'.$yy.'/'.$mm.'/'.$xvalue.'/'.$num;

        $data = [
            'title' => 'DOCUMENT PRECONTRACTUEL D’INFORMATION ET DE CONSEIL',
            'fname' => $request->fname,
            'lname' => $request->lname,
            'datebird' =>  date('d/m/Y', strtotime($request->datebirth)),
            'adresse' => $request->adresse,
            'city' => $request->city,
            'cp' => $request->cp,
            'mail' => $request->mail,
            'phone' => $request->phone,
            'code' => $request->code,
            'checkfinancement' => $request->checkfinancement,
            'checkrisque' => $request->checkrisque,
            'checkproduct' => $request->checkproduct,
            'checkfinancementicon' => $request->checkfinancementicon,
            'checkrisqueicon' => $request->checkrisqueicon,
            'checkproducticon' => $request->checkproducticon,
            'typeselected' => $request->typeselected,
            'iban' => $request->iban,
            'bic' => $request->bic,
            'textselected' => explode(',', $request->textselected),
            'conseiller' => $operatorid->last_name.' '.$lettrefirst,
            'number' => $number,
            'date' =>  date('d/m/Y')
        ];

        $array = explode(',', $request->typeselected);

        if(in_array('101', $array) && in_array('102', $array)){
            $pdf = PDF::loadView('pdf.elecGazEmail', $data);
        }else if(in_array('101', $array) || in_array('102', $array)){
            $pdf = PDF::loadView('pdf.elecGazEmail', $data);
        }else if(in_array('104', $array)){
            $pdf = PDF::loadView('pdf.pgeEmail', $data);
        }

        $dir = "MailingFiles";
        $filename = "baileymail_{$identifiant}.pdf";
        $file = "$dir/$filename";

        $content_to_write = $pdf->download()->getOriginalContent();

        $filetoput = fopen($file, "w");

        fwrite($filetoput, $content_to_write);

        fclose($filetoput);

        // return $pdf->download('baileymail.pdf');

        // return $pdf->stream();

        // $pdf->loadView('pdf.elecGaz', $data);
        // return $pdf->stream();
    }

    public function getMailingDocument()
    {
        $url = $_SERVER["REQUEST_URI"];

        $strArray = explode('/',$url);
        $part1 = $strArray[2];
        $part2 = explode('=',$part1);
        $part3= explode('=',$part2[1]);
        $uservalue=$part2[1];

        set_time_limit(300);

        $dir = "MailingFiles";
        $filename = "baileymail_{$uservalue}.pdf";
        $file = "$dir/$filename";

        // Header content type
        header('Content-type: application/pdf');
        header('Content-Disposition: inline; filename="' . $file . '"');
        header('Content-Transfer-Encoding: binary');
        header('Accept-Ranges: bytes');

        // Read the file
        @readfile($file);

    }


    public function getPub($elem)
    {
        set_time_limit(300);

        $dir = "pub";

        if($elem==1){
            $filename = "a4-maf.pdf";
        }
        else if ($elem==2){
            $filename = "a4-pge.pdf";
        }elseif ($elem==3) {
            $filename = "a4-gfo.pdf";
        }

        $file = "$dir/$filename";

        // Header content type
        header('Content-type: application/pdf');
        header('Content-Disposition: inline; filename="' . $file . '"');
        header('Content-Transfer-Encoding: binary');
        header('Accept-Ranges: bytes');

        // Read the file
        @readfile($file);

    }

}

