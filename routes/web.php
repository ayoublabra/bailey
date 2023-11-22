<?php

// Controllers
use App\Models\DigitalContract;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\MailingController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\DocusignController;
use App\Http\Controllers\ToileDeComController;
use App\Http\Controllers\GeneratePdfController;
use App\Http\Controllers\VerificationController;
// Packages
use App\Http\Controllers\Security\RoleController;
use App\Http\Controllers\Security\RolePermission;
use App\Http\Controllers\Security\PermissionController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__.'/auth.php';

Route::get('/storage', function () {
    Artisan::call('storage:link');
});

//UI Pages Routs
 Route::get('/', [HomeController::class, 'uisheet'])->name('uisheet'); //dashboard
// Route::get('/',function(){
//     return view('commingsoon');
// });
Route::get('getRole', [HomeController::class, 'getRole'])->name('getRole');
Route::get('getdays', [ContractController::class, 'getDays'])->name('getDays');
Route::get('/getCitys', [ContractController::class, 'getCitys'])->name('getCitys');


//get contracts
Route::get('contract-state', [DocusignController::class, 'getContractState'])->name('getContractState');


Route::group(['middleware' => 'auth'], function () {
    // Permission Module
    Route::get('/role-permission',[RolePermission::class, 'index'])->name('role.permission.list');
    Route::resource('permission',PermissionController::class);
    Route::resource('role', RoleController::class);

    // Dashboard Routes
    Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');
 
    //Contract
    Route::get('getContract', [ContractController::class, 'getContract'])->name('getContract');
    Route::post('saveContrat', [ContractController::class, 'saveContrat'])->name('saveContrat');
    Route::post('/updateContrat', [ContractController::class, 'updateContrat'])->name('updateContrat');
    Route::post('/resetIban', [ContractController::class, 'resetIban'])->name('resetIban');
    Route::post('/finaliserContrat', [ContractController::class, 'finaliserContrat'])->name('finaliserContrat');
    Route::post('/updatePDLFinalisation', [ContractController::class, 'updatePDLFinalisation'])->name('updatePDLFinalisation');

    Route::post('/updatePdlContract', [ContractController::class, 'updatePdlContract'])->name('updatePdlContract');
    Route::post('/updatestate', [ContractController::class, 'updatestate'])->name('updatestate');
    Route::get('getUsers', [UserController::class, 'getUsers'])->name('getUsers');

    Route::get('getSales', [SalesController::class, 'getSales'])->name('getSales');
    Route::get('getAllClient', [ContractController::class, 'getAllClient'])->name('getAllClient');
    Route::get('/getTypeContrat/{id}',[\App\Http\Controllers\UserController::class,'getTypeContrat'])->name('getTypeContrat');
    Route::get('getStates', [ContractController::class, 'getStates'])->name('getStates');
    Route::get('getFinalisation/{id}', [ContractController::class, 'getFinalisation'])->name('getFinalisation');
    Route::get('getArchives', [ContractController::class, 'getArchives'])->name('getArchives');
    Route::post('/restore-contract/{id}', [ContractController::class,'restoreContract'])->name('restore-contract');
    Route::post('/postUser',[\App\Http\Controllers\UserController::class,'store'])->name('postUser');
    Route::put('/editUser/{id}',[\App\Http\Controllers\UserController::class,'update'])->name('editUser');
    Route::delete('/deleteUser/{id}',[\App\Http\Controllers\UserController::class,'destroy'])->name('deleteUser');
    Route::get('getfournisseur/{type_id}', [ContractController::class, 'getFournisseur'])->name('getFournisseur');
    Route::post('ibanCheck', [VerificationController::class, 'ibanCheck'])->name('ibanCheck');
    Route::post('ibanCheck2', [VerificationController::class, 'ibanCheck2'])->name('ibanCheck2');
    Route::post('changeSigned', [ContractController::class, 'changeSigned'])->name('changeSigned');
    Route::post('resetIban', [ContractController::class, 'resetIban'])->name('resetIban');
    Route::put('/block/{id}',[\App\Http\Controllers\UserController::class,'block'])->name('blockUser');
    Route::put('/deblock/{id}',[\App\Http\Controllers\UserController::class,'deblock'])->name('deblockUser');




    Route::post('infoCheck', [VerificationController::class, 'infoCheck'])->name('infoCheck');
    
    
    Route::post('sendSMS', [VerificationController::class, 'sendSMS'])->name('sendSMS');
    Route::post('sendSMSFinalisation', [VerificationController::class, 'sendSMSFinalisation'])->name('sendSMSFinalisation');

    Route::put('/actifStatut/{id}',[SalesController::class,'actifStatutContract'])->name('actifStatut');
    Route::put('/desactifStatut/{id}',[SalesController::class,'desactifStatutContract'])->name('desactifStatut');
    // Route::put('/actif/{id}', function ($id) {
    //     DigitalContract::where('id',$id)->update(['status'=>1]);
    // });
    // Route::put('/desactif/{id}', function ($id) {
    //     DigitalContract::where('id',$id)->update(['status'=>0]);
    // });
    Route::get('/getRole/{id}', function ($id) {
        $roles = \App\Models\Role::where('user_id',$id)->get();
        return response()->json($roles);
    });


 
    // Users Module
    Route::resource('users', UserController::class);
    Route::get('createPdfFile', [GeneratePdfController::class, 'index'])->name('getPdf');
    Route::get('createPdfFileFinalisation', [GeneratePdfController::class, 'index2']);

    Route::get('createPdfFileNoCode', [GeneratePdfController::class, 'indexNoCode'])->name('getPdfNoCode');
    Route::get('createPdfFileNoCodeFinalisation', [GeneratePdfController::class, 'indexNoCode2'])->name('getPdfNoCodeFinalisation');
    Route::post('createMailingPdfFile', [GeneratePdfController::class, 'mailingindex'])->name('createMailingPdfFile');
});

//App Details Page => 'Dashboard'], function() {
Route::group(['prefix' => 'menu-style'], function() {
    //MenuStyle Page Routs
    Route::get('horizontal', [HomeController::class, 'horizontal'])->name('menu-style.horizontal');
    Route::get('dual-horizontal', [HomeController::class, 'dualhorizontal'])->name('menu-style.dualhorizontal');
    Route::get('dual-compact', [HomeController::class, 'dualcompact'])->name('menu-style.dualcompact');
    Route::get('boxed', [HomeController::class, 'boxed'])->name('menu-style.boxed');
    Route::get('boxed-fancy', [HomeController::class, 'boxedfancy'])->name('menu-style.boxedfancy');
});

//App Details Page => 'special-pages'], function() {
Route::group(['prefix' => 'special-pages'], function() {
    //Example Page Routs
    Route::get('billing', [HomeController::class, 'billing'])->name('special-pages.billing');
    Route::get('calender', [HomeController::class, 'calender'])->name('special-pages.calender');
    Route::get('kanban', [HomeController::class, 'kanban'])->name('special-pages.kanban');
    Route::get('pricing', [HomeController::class, 'pricing'])->name('special-pages.pricing');
    Route::get('rtl-support', [HomeController::class, 'rtlsupport'])->name('special-pages.rtlsupport');
    Route::get('timeline', [HomeController::class, 'timeline'])->name('special-pages.timeline');
});

//Widget Routs
Route::group(['prefix' => 'widget'], function() {
    Route::get('widget-basic', [HomeController::class, 'widgetbasic'])->name('widget.widgetbasic');
    Route::get('widget-chart', [HomeController::class, 'widgetchart'])->name('widget.widgetchart');
    Route::get('widget-card', [HomeController::class, 'widgetcard'])->name('widget.widgetcard');
});

//Maps Routs
Route::group(['prefix' => 'maps'], function() {
    Route::get('google', [HomeController::class, 'google'])->name('maps.google');
    Route::get('vector', [HomeController::class, 'vector'])->name('maps.vector');
});

//Auth pages Routs
Route::group(['prefix' => 'auth'], function() {
    Route::get('signin', [HomeController::class, 'signin'])->name('auth.signin');
    Route::get('signup', [HomeController::class, 'signup'])->name('auth.signup');
    Route::get('confirmmail', [HomeController::class, 'confirmmail'])->name('auth.confirmmail');
    Route::get('lockscreen', [HomeController::class, 'lockscreen'])->name('auth.lockscreen');
    Route::get('recoverpw', [HomeController::class, 'recoverpw'])->name('auth.recoverpw');
    Route::get('userprivacysetting', [HomeController::class, 'userprivacysetting'])->name('auth.userprivacysetting');
    Route::post('/forget-pw', [MailingController::class, 'forgetpw'])->name('forgetpw');
    Route::get('/getnewmdp', [MailingController::class, 'getnewmdp']);
    Route::post('/generatepass', [MailingController::class, 'generatepass'])->name('generatepass');

});

//Error Page Route
Route::group(['prefix' => 'errors'], function() {
    Route::get('error404', [HomeController::class, 'error404'])->name('errors.error404');
    Route::get('error500', [HomeController::class, 'error500'])->name('errors.error500');
    Route::get('maintenance', [HomeController::class, 'maintenance'])->name('errors.maintenance');
});


//Forms Pages Routs
Route::group(['prefix' => 'forms'], function() {
    Route::get('element', [HomeController::class, 'element'])->name('forms.element');
    Route::get('wizard', [HomeController::class, 'wizard'])->name('forms.wizard');
    Route::get('validation', [HomeController::class, 'validation'])->name('forms.validation');
    Route::get('contract', [HomeController::class, 'contract'])->name('forms.contract');
});

//SMS of contract
Route::match(array('GET','POST'),'getDocument/user={userid}', [GeneratePdfController::class, 'getDocument'])->name('getDocument'); 
Route::match(array('GET','POST'),'getDocumentFinalisation/user={userid}', [GeneratePdfController::class, 'getDocumentFinalisation'])->name('getDocumentFinalisation'); 


Route::match(array('GET','POST'),'getDocumentNoCode/user={userid}', [GeneratePdfController::class, 'getDocumentNoCode'])->name('getDocumentNoCode');
Route::match(array('GET','POST'),'getDocumentNoCodeFinalisation/user={userid}', [GeneratePdfController::class, 'getDocumentNoCodeFinalisation'])->name('getDocumentNoCodeFinalisation'); 


//pub
Route::get('getpub/{elem}', [GeneratePdfController::class, 'getPub'])->name('getPub');

//mailing of contract
Route::get('mailingindex', [GeneratePdfController::class, 'getMailingDocument'])->name('mailingindex');

//Docu Sign
Route::get('docusign',[DocusignController::class, 'index'])->name('docusign');
Route::get('connect-docusign',[DocusignController::class, 'make_envelope'])->name('connect.docusign');
Route::get('docusign/callback',[DocusignController::class,'callback'])->name('docusign.callback');
Route::post('sign-document',[DocusignController::class,'signDocument'])->name('docusign.sign');
Route::post('sign-document2',[DocusignController::class,'signDocument2']);


//Table Page Routs
Route::group(['prefix' => 'table'], function() {
    Route::get('bootstraptable', [HomeController::class, 'bootstraptable'])->name('table.bootstraptable');
    Route::get('datatable', [HomeController::class, 'datatable'])->name('table.datatable');
});

//Icons Page Routs
Route::group(['prefix' => 'icons'], function() {
    Route::get('solid', [HomeController::class, 'solid'])->name('icons.solid');
    Route::get('outline', [HomeController::class, 'outline'])->name('icons.outline');
    Route::get('dualtone', [HomeController::class, 'dualtone'])->name('icons.dualtone');
    Route::get('colored', [HomeController::class, 'colored'])->name('icons.colored');
});

//Extra Page Routs
Route::get('privacy-policy', [HomeController::class, 'privacypolicy'])->name('pages.privacy-policy');
Route::get('terms-of-use', [HomeController::class, 'termsofuse'])->name('pages.term-of-use');

Route::get('/toiledecom/login',[AuthController::class,'login'])->name('auth.login');
Route::post('/toiledecom/login',[AuthController::class,'doLogin'])->name('auth.doLogin');
Route::get('/toiledecom/logout',[AuthController::class,'logout'])->name('auth.logout');
Route::get('/toiledecom',[ToileDeComController::class,'index'])->name('toile.index');
Route::post('/toiledecom/store',[ToileDeComController::class,'store'])->name('toile.store');
Route::post('/iban-validation',[ToileDeComController::class,'ibanValidation'])->name('iban.validation');
Route::get('/toiledecom/list',[ToileDeComController::class,'list'])->name('toile.list');
Route::post('/toiledecom/list',[ToileDeComController::class,'list'])->name('toile.list');
Route::get('/export-csv', [ExportController::class ,'exportCSV'])->name('export.csv');
Route::get('/export-XML', [ExportController::class ,'exportXML'])->name('export.xml');

 Route::get('/pagination/paginate-data',[ToileDeComController::class,'pagination'])->name('toile.pagination');