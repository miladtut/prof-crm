<?php


use App\Http\Controllers\Company\DraftController;
use App\Http\Controllers\Company\FileController;
use App\Http\Controllers\Company\FinalController;
use App\Http\Controllers\Company\HomeController;
use App\Http\Controllers\Company\InquiryController;
use App\Http\Controllers\Company\LoginController;
use App\Http\Controllers\Company\PcoaController;
use App\Http\Controllers\Company\PilotController;
use App\Http\Controllers\Company\QuotationController;
use App\Http\Controllers\Company\SampleController;
use App\Http\Controllers\Company\StageController;
use Illuminate\Support\Facades\Route;

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

//Route::get('/', 'PagesController@index');


// Demo routes
Route::get('/datatables', 'PagesController@datatables');
Route::get('/ktdatatables', 'PagesController@ktDatatables');
Route::get('/select2', 'PagesController@select2');
Route::get('/jquerymask', 'PagesController@jQueryMask');
Route::get('/icons/custom-icons', 'PagesController@customIcons');
Route::get('/icons/flaticon', 'PagesController@flaticon');
Route::get('/icons/fontawesome', 'PagesController@fontawesome');
Route::get('/icons/lineawesome', 'PagesController@lineawesome');
Route::get('/icons/socicons', 'PagesController@socicons');
Route::get('/icons/svg', 'PagesController@svg');

// Quick search dummy route to display html elements in search dropdown (header search)
Route::get('/quick-search', 'PagesController@quickSearch')->name('quick-search');
Route::get('/steps', 'PagesController@steps')->name('steps');



Route::view('/','pages.company.index')->name('index');
Route::post('contact',[HomeController::class,'contact_us'])->name('contact-us');
Route::group(['middleware'=>'guest'],function (){
    Route::get('/login',[LoginController::class,'login'])->name('login');
    Route::post('/login',[LoginController::class,'do_login'])->name('login');
    Route::get('/register',[LoginController::class,'register'])->name('register');
    Route::post('/register',[LoginController::class,'do_register'])->name('register');
    Route::get('/reset-password',[LoginController::class,'reset_password_form'])->name('reset-password');
});

Route::group(['middleware'=>'auth','namespace'=>'Company','prefix'=>'companyadmin'],function (){

    Route::get('/logout',[LoginController::class,'logout'])->name('logout');

    Route::get('/dashboard',[HomeController::class,'index'])->name('dashboard');
    //inquiry routes
    Route::get('/inquiries',[InquiryController::class,'index'])->name('company-inquiry-list');
    Route::get('/inquiry/show/{inquiry}',[InquiryController::class,'show'])->name('company-inquiry-show');
    Route::get('/inquiry/create',[InquiryController::class,'create'])->name('company-inquiry-create');
    Route::post('/inquiry/create',[InquiryController::class,'store'])->name('company-inquiry-create');

    //quotation approve routes
    Route::get('/quotation/{quotation}/approve',[InquiryController::class,'quotationApprove'])->name('company-quotation-approve');
    Route::post('/quotation/{quotation}/approve',[InquiryController::class,'quotationDoApprove'])->name('company-quotation-approve');
    Route::post('/quotation/{quotation}/reject',[InquiryController::class,'quotationReject'])->name('company-quotation-reject');

    Route::get('sample/skip/{quotation}',[InquiryController::class,'skip_sample'])->name('company-skip-sample');


    //Sample routes
    Route::get('/sample/{sample}/receive',[InquiryController::class,'sampleReceive'])->name('company-sample-receive');
    Route::get('/sample/{sample}/approve',[InquiryController::class,'sampleApprove'])->name('company-sample-approve');
    Route::post('/sample/{sample}/approve',[InquiryController::class,'sampleDoApprove'])->name('company-sample-approve');
    Route::post('/sample/{sample}/reject',[InquiryController::class,'sampleReject'])->name('company-sample-reject');

    //pilot routes
    Route::get('/pilot/{pilot}/approve',[InquiryController::class,'pilotApprove'])->name('company-pilot-approve');
    Route::post('/pilot/{pilot}/reject',[InquiryController::class,'pilotReject'])->name('company-pilot-reject');

    //po routes
    Route::post('/inquiry/{inquiry}/po/send',[InquiryController::class,'poSend'])->name('company.po.send');
    Route::get('/inquiry/from/po',[InquiryController::class,'from_po_form'])->name('company.from-po');
    Route::post('/inquiry/from/po',[InquiryController::class,'from_po'])->name('company.from-po');

    //customer document routes//logistic
    Route::get('/inquiry/{inquiry}/cdocs/create',[InquiryController::class,'customerDocumentCreate'])->name('company.inquiry.customer-document.create');
    Route::post('/inquiry/{inquiry}/cdocs/create',[InquiryController::class,'customerDocumentStore'])->name('company.inquiry.customer-document.create');


    //pcoa routes//regular&logistic
    Route::get('/pcoa/{inquiry}/approve',[InquiryController::class,'pcoaApprove'])->name('company.pcoa.approve');
    Route::post('/pcoa/{inquiry}/reject',[InquiryController::class,'pcoaReject'])->name('company.pcoa.reject');

    //clearance routes//logistic
    Route::post('/inquiry/{inquiry}/clearance/send',[InquiryController::class,'clearanceSend'])->name('company.clearance.send');


    //draft routes//regular
    Route::get('/draft/{inquiry}/approve',[InquiryController::class,'draftApprove'])->name('company.draft.approve');
    Route::post('/draft/{inquiry}/reject',[InquiryController::class,'draftReject'])->name('company.draft.reject');

    //final routes//regular
    Route::get('/final/{inquiry}/approve',[InquiryController::class,'finalApprove'])->name('company.final.approve');
    Route::post('/final/{inquiry}/reject',[InquiryController::class,'finalReject'])->name('company.final.reject');



    //swift routes//regular
    Route::post('/swift/{inquiry}/send',[InquiryController::class,'swiftSend'])->name('company.swift.send');




    Route::get('/document/create',[HomeController::class,'createDoc'])->name('company.document.create');
    Route::get('download',[HomeController::class,'download'])->name('company.download');

    Route::get('/notifications',[\App\Http\Controllers\Company\NotificationController::class,'index'])->name('company-notifications-list');

    Route::get('/account-edit',[\App\Http\Controllers\Company\HomeController::class,'edit_account'])->name('company-account-edit');
    Route::post('/account-edit',[\App\Http\Controllers\Company\HomeController::class,'account_update'])->name('company-account-edit');
    Route::get('/change-password',[\App\Http\Controllers\Company\HomeController::class,'change_password'])->name('company-change-password');
    Route::post('/change-password',[\App\Http\Controllers\Company\HomeController::class,'password_update'])->name('company-change-password');

    Route::get('/profect-partners',[HomeController::class,'partners'])->name('company-profect-partners');
    Route::get('/about-profect',[HomeController::class,'about'])->name('company-profect-about');
});
