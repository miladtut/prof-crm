<?php

use App\Http\Controllers\Admin\AdminsController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Admin\CustomerDocumentController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\FileController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\MaterialController;
use App\Http\Controllers\Admin\PaymenTermsController;
use App\Http\Controllers\Admin\ShippingTermsController;
use App\Http\Controllers\Admin\SpecsController;
use App\Http\Controllers\Admin\SupplierController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// admin login
Route::group(['middleware'=>'guest:admin'],function (){
    Route::get('/login',[LoginController::class,'login'])->name('admin.login');
    Route::post('/login',[LoginController::class,'do_login'])->name('admin.login');
});

// admin routes
Route::group(['middleware'=>['admin']],function (){

    //admin dashboard routes
    Route::get('/',[HomeController::class,'index'])->name('admin.dashboard');


    Route::post('/change-status/{inquiry}',[InquiryController::class,'changeStatus'])->name('admin.change-status');


    //admin inquiry routes
    Route::get('/inquiries',[InquiryController::class,'index'])->name('admin.inquiries');
    Route::get('/inquiry/show/{inquiry}',[InquiryController::class,'show'])->name('admin.inquiry.show');


    //admin quotation routes
    Route::get('/inquiry/{inquiry}/quotation/{mode?}',[InquiryController::class,'quotationCreate'])->name('admin.inquiry.quotation.create');
    Route::post('/inquiry/{inquiry}/quotation/{mode?}',[InquiryController::class,'quotationStore'])->name('admin.inquiry.quotation.create');

    //admin sample routes
    Route::get('/inquiry/{inquiry}/{status}/status/update',[InquiryController::class,'sampleStatusUpdate'])->name('admin.inquiry.status.update');
    Route::get('/inquiry/{inquiry}/sample/modify',[InquiryController::class,'sampleModify'])->name('admin.inquiry.sample.modify');

    //admin Pilot routes
    Route::get('/inquiry/pilot/{pilot}/send/{mode?}',[InquiryController::class,'pilotShow'])->name('admin.inquiry.pilot.edit');
    Route::post('/inquiry/pilot/{pilot}/send/{mode?}',[InquiryController::class,'pilotSend'])->name('admin.inquiry.pilot.edit');

    //admin pi routes
    Route::post('/inquiry/{inquiry}/pi/send/{mode?}',[InquiryController::class,'piSend'])->name('admin.pi.send');


    Route::get('/inquiry/{inquiry}/po/edit',[InquiryController::class,'poEdit'])->name('admin.po.edit');
    Route::post('/inquiry/{inquiry}/po/edit',[InquiryController::class,'poUpdate'])->name('admin.po.edit');

    Route::get('/inquiry/{inquiry}/swift/edit',[InquiryController::class,'swiftEdit'])->name('admin.swift.edit');
    Route::post('/inquiry/{inquiry}/swift/edit',[InquiryController::class,'swiftUpdate'])->name('admin.swift.edit');


    //admin  supplier po routes
    Route::get('/inquiry/{inquiry}/spo/{mode?}',[InquiryController::class,'spoCreate'])->name('admin.inquiry.spo.create');
    Route::post('/inquiry/{inquiry}/spo/{mode?}',[InquiryController::class,'spoStore'])->name('admin.inquiry.spo.create');
    Route::get('/material/{material}/suppliers',[MaterialController::class,'getSuppliers'])->name('admin.material.get.suppliers');

    //admin  supplier doc routes
    Route::post('/inquiry/{inquiry}/sdoc/{mode?}',[InquiryController::class,'sdocSend'])->name('admin.supplier.document.send');

    //admin  customer docs routes
    Route::get('/inquiry/{inquiry}/cdoc/create',[InquiryController::class,'customerDocumentCreate'])->name('admin.inquiry.customer-document.create');
    Route::post('/inquiry/{inquiry}/cdoc/create',[InquiryController::class,'customerDocumentStore'])->name('admin.inquiry.customer-document.create');
    Route::get('/inquiry/{inquiry}/cdoc/edit',[InquiryController::class,'customerDocumentEdit'])->name('admin.inquiry.customer-document.edit');
    Route::post('/inquiry/{inquiry}/cdoc/edit',[InquiryController::class,'customerDocumentUpdate'])->name('admin.inquiry.customer-document.edit');


    //admin pcoa routes
    Route::post('/inquiry/{inquiry}/pcoa/send/{mode?}',[InquiryController::class,'pcoaSend'])->name('admin.pcoa.send');



    //admin original routes
    Route::post('/inquiry/{inquiry}/org/send/{mode?}',[InquiryController::class,'orgSend'])->name('admin.org.send');

    //admin original routes
    Route::post('/inquiry/{inquiry}/notes/send{mode?}',[InquiryController::class,'notesSend'])->name('admin.notes.send');


    //admin draft routes
    Route::post('/inquiry/{inquiry}/draft/send/{mode?}',[InquiryController::class,'draftSend'])->name('admin.draft.send');

    //admin final routes
    Route::post('/inquiry/{inquiry}/final/send/{mode?}',[InquiryController::class,'finalSend'])->name('admin.final.send');

    //tracking_number_of_original_documents routes//regular
    Route::post('/tracking/{inquiry}/send',[InquiryController::class,'trackNoSend'])->name('admin.track.send');

    //close
    Route::get('/inquiry/{inquiry}/close',[InquiryController::class,'close'])->name('admin.inquiry.close');

    Route::post('inquiry/{inquiry}/backward/{type?}',[InquiryController::class,'backward'])->name('admin.inquiry.back');

    Route::get('inquiry/{inquiry}/decline',[InquiryController::class,'decline'])->name('admin.inquiry.decline');

    //admin Supplier routes
    Route::get('/suppliers',[SupplierController::class,'index'])->name('admin.suppliers');
    Route::get('/suppliers/create',[SupplierController::class,'create'])->name('admin.suppliers.create');
    Route::post('/suppliers/create',[SupplierController::class,'store'])->name('admin.suppliers.create');
    Route::get('/suppliers/edit/{supplier}',[SupplierController::class,'edit'])->name('admin.suppliers.edit');
    Route::post('/suppliers/edit/{supplier}',[SupplierController::class,'update'])->name('admin.suppliers.edit');
    Route::get('/suppliers/delete/{supplier}',[SupplierController::class,'delete'])->name('admin.suppliers.delete');
    Route::get('/suppliers/show/{supplier}',[SupplierController::class,'show'])->name('admin.suppliers.show');
    Route::get('/suppliers/files/delete/{file}',[SupplierController::class,'destroy'])->name('admin.suppliers.file.delete');


    //admin Company routes
    Route::get('/admins',[AdminsController::class,'index'])->name('admin.admins');
    Route::get('/admins/create',[AdminsController::class,'create'])->name('admin.admins.create');
    Route::post('/admins/create',[AdminsController::class,'store'])->name('admin.admins.create');
    Route::get('/admins/edit/{admin}',[AdminsController::class,'edit'])->name('admin.admins.edit');
    Route::post('/admins/edit/{admin}',[AdminsController::class,'update'])->name('admin.admins.edit');
    Route::get('/admins/delete/{admin}',[AdminsController::class,'delete'])->name('admin.admins.delete');



    //admin Company routes
    Route::get('/companies',[CompanyController::class,'index'])->name('admin.companies');
    Route::get('/companies/show/{company}',[CompanyController::class,'show'])->name('admin.companies.show');
    Route::get('/companies/create',[CompanyController::class,'create'])->name('admin.companies.create');
    Route::post('/companies/create',[CompanyController::class,'store'])->name('admin.companies.create');
    Route::get('/companies/edit/{company}',[CompanyController::class,'edit'])->name('admin.companies.edit');
    Route::post('/companies/edit/{company}',[CompanyController::class,'update'])->name('admin.companies.edit');
    Route::get('/companies/delete/{company}',[CompanyController::class,'delete'])->name('admin.companies.delete');
    Route::get('/companies/block/{company}',[CompanyController::class,'block'])->name('admin.company.block');


    //admin country routes
    Route::get('/countries',[CountryController::class,'index'])->name('admin.countries');
    Route::get('/countries/new',[CountryController::class,'create'])->name('admin.countries.create');
    Route::post('/countries/save',[CountryController::class,'store'])->name('admin.countries.save');
    Route::get('/countries/edit/{country}',[CountryController::class,'edit'])->name('admin.countries.edit');
    Route::post('/countries/edit/{country}',[CountryController::class,'update'])->name('admin.countries.edit');
    Route::get('/countries/delete/{country}',[CountryController::class,'delete'])->name('admin.countries.delete');

    //admin material routes
    Route::get('/materials',[MaterialController::class,'index'])->name('admin.materials');
    Route::get('/materials/new',[MaterialController::class,'create'])->name('admin.materials.create');
    Route::post('/materials/new',[MaterialController::class,'store'])->name('admin.materials.create');
    Route::get('/materials/edit/{material}',[MaterialController::class,'edit'])->name('admin.materials.edit');
    Route::post('/materials/edit/{material}',[MaterialController::class,'update'])->name('admin.materials.edit');
    Route::get('/materials/delete/{material}',[MaterialController::class,'delete'])->name('admin.materials.delete');

    //admin Specs routes
    Route::get('/specs',[SpecsController::class,'index'])->name('admin.specs');
    Route::get('/specs/create',[SpecsController::class,'create'])->name('admin.specs.create');
    Route::post('/specs/create',[SpecsController::class,'store'])->name('admin.specs.create');
    Route::get('/specs/edit/{spec}',[SpecsController::class,'edit'])->name('admin.specs.edit');
    Route::post('/specs/edit/{spec}',[SpecsController::class,'update'])->name('admin.specs.edit');
    Route::get('/specs/delete/{spec}',[SpecsController::class,'delete'])->name('admin.specs.delete');

    //admin Documents routes
    Route::get('/documents',[DocumentController::class,'index'])->name('admin.documents');
    Route::get('/documents/create',[DocumentController::class,'create'])->name('admin.documents.create');
    Route::post('/documents/create',[DocumentController::class,'store'])->name('admin.documents.create');
    Route::get('/documents/edit/{document}',[DocumentController::class,'edit'])->name('admin.documents.edit');
    Route::post('/documents/edit/{document}',[DocumentController::class,'update'])->name('admin.documents.edit');
    Route::get('/documents/delete/{document}',[DocumentController::class,'delete'])->name('admin.documents.delete');

    //admin CustomerDocuments routes
    Route::get('/cdocuments',[CustomerDocumentController::class,'index'])->name('admin.cdocuments');
    Route::get('/cdocuments/create',[CustomerDocumentController::class,'create'])->name('admin.cdocuments.create');
    Route::post('/cdocuments/create',[CustomerDocumentController::class,'store'])->name('admin.cdocuments.create');
    Route::get('/cdocuments/edit/{customerDocument}',[CustomerDocumentController::class,'edit'])->name('admin.cdocuments.edit');
    Route::post('/cdocuments/edit/{customerDocument}',[CustomerDocumentController::class,'update'])->name('admin.cdocuments.edit');
    Route::get('/cdocuments/delete/{customerDocument}',[CustomerDocumentController::class,'delete'])->name('admin.cdocuments.delete');

    //admin Currency routes
    Route::get('/currencies',[CurrencyController::class,'index'])->name('admin.currencies');
    Route::get('/currencies/create',[CurrencyController::class,'create'])->name('admin.currencies.create');
    Route::post('/currencies/create',[CurrencyController::class,'store'])->name('admin.currencies.create');
    Route::get('/currencies/edit/{currency}',[CurrencyController::class,'edit'])->name('admin.currencies.edit');
    Route::post('/currencies/edit/{currency}',[CurrencyController::class,'update'])->name('admin.currencies.edit');
    Route::get('/currencies/delete/{currency}',[CurrencyController::class,'delete'])->name('admin.currencies.delete');

    //admin Payment Terms routes
    Route::get('/payment/terms',[PaymenTermsController::class,'index'])->name('admin.payment.terms');
    Route::get('/payment/terms/create',[PaymenTermsController::class,'create'])->name('admin.payment.terms.create');
    Route::post('/payment/terms/create',[PaymenTermsController::class,'store'])->name('admin.payment.terms.create');
    Route::get('/payment/terms/edit/{paymentTerm}',[PaymenTermsController::class,'edit'])->name('admin.payment.terms.edit');
    Route::post('/payment/terms/edit/{paymentTerm}',[PaymenTermsController::class,'update'])->name('admin.payment.terms.edit');
    Route::get('/payment/terms/delete/{paymentTerm}',[PaymenTermsController::class,'delete'])->name('admin.payment.terms.delete');

    //admin Shipping Terms routes
    Route::get('/shipping/terms',[ShippingTermsController::class,'index'])->name('admin.shipping.terms');
    Route::get('/shipping/terms/create',[ShippingTermsController::class,'create'])->name('admin.shipping.terms.create');
    Route::post('/shipping/terms/create',[ShippingTermsController::class,'store'])->name('admin.shipping.terms.create');
    Route::get('/shipping/terms/edit/{shippingTerm}',[ShippingTermsController::class,'edit'])->name('admin.shipping.terms.edit');
    Route::post('/shipping/terms/edit/{shippingTerm}',[ShippingTermsController::class,'update'])->name('admin.shipping.terms.edit');
    Route::get('/shipping/terms/delete/{shippingTerm}',[ShippingTermsController::class,'delete'])->name('admin.shipping.terms.delete');





    Route::get('/logout',[LoginController::class,'logout'])->name('admin.logout');

    //admin Downloads routes
    Route::get('download',[HomeController::class,'download'])->name('admin.download');
    Route::get('po/print/{inquiry}',function (\App\Models\Inquiry $inquiry){
        return view('pages.widgets.admin.invoice',['data'=>$inquiry]);
    })->name('print-po');

    Route::get('/profect-partners',[HomeController::class,'partners'])->name('admin.profect.partners');
    Route::post('/profect-partners/add',[HomeController::class,'add_partner'])->name('admin.profect.partners.add');
    Route::get('/profect-partners/delete/{partner}',[HomeController::class,'delete_partner'])->name('admin.profect.partners.delete');


    Route::get('/about-profect/edit',[HomeController::class,'about'])->name('admin.about-profect.edit');
    Route::post('/about-profect/edit',[HomeController::class,'about_update'])->name('admin.about-profect.edit');
});

