<?php

namespace App\Http\Controllers\Company;

use App\Classes\Initialization\Inq;
use App\Classes\Initialization\Logistic;
use App\Classes\Initialization\Regular;
use App\DataTables\Company\InquiryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerDocumentRequest;
use App\Http\Requests\FileRequest;
use App\Http\Requests\InquiryStoreRequest;
use App\Http\Requests\PilotRequest;
use App\Http\Requests\RejectRequest;
use App\Http\Requests\SampleRequest;
use App\Mail\MainMail;
use App\Models\Admin;
use App\Models\Inquiry;
use App\Models\Material;
use App\Models\Notification;
use App\Models\Pilot;
use App\Models\Quotation;
use App\Models\Sample;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class InquiryController extends Controller
{
    //inquiry funcs
    public function index(Request $request)
    {
        $dataTable = new InquiryDataTable($request->all());
        return $dataTable->render('pages.company.inquiry.index');
    }


    public function create()
    {
        return view('pages.company.inquiry.create');
    }


    public function store(InquiryStoreRequest $request)
    {
        $validated = $request->validated();
        $company = auth()->user();
        try {

            $inq = new Inq;
            $inq->init();
            DB::beginTransaction();
            if ($request->mat_name){
                $mat = Material::updateOrCreate(['name'=>$request->mat_name],['name'=>$request->mat_name]);
                $validated['material_id'] = $mat->id;
            }
            $inquiry = $company->inquiries()->create(array_merge($validated,['status_name'=>$inq->_getStatusName([0,0]),'type'=>auth()->user()->account_type]));
            $inquiry->documents()->attach($request->document);
            if ($request->coa_attachment){
                $inquiry->files()->create([
                    'name'=>$request->coa_attachment,
                    'type'=>'coa'
                ]);
            }
            $inquiry->status_logs()->create([
                'status'=>'waiting quotation',
                'creator_type'=>'company',
                'created_by'=>auth()->user()->company_name,
                'creator_id'=>auth()->user()->id,
            ]);
            Notification::create([
                'for_admin'=>'yes',
                'inquiry_id'=>$inquiry->id,
                'title'=>'you have new inquiry'
            ]);
            $super_admin = Admin::where('super_admin','1')->first()->email;
            $admins = Admin::query()->where('blocked','0')->pluck('email');
            $msg = auth()->user()->company_name.'  made a new inquiry #'.mb_substr($inquiry->company_name, 0, 3, "UTF-8").'-'.($inquiry->id**2).' Go to  (<a href="'.route('admin.inquiry.show',$inquiry->id).'">inquiry page</a>) Please review it, and take necessary actions.';
            try {
                Mail::to($super_admin)->cc($admins)->send(new MainMail('New '.$inquiry->type.' inquiry',$msg));
            }catch (\Exception $exception){

            }
            DB::commit();
            flash('Inquiry Created Successfully')->success();
            return redirect()->route('company-inquiry-show',$inquiry->id);
        }catch (\Exception $exception){
            DB::rollBack();
            dd($exception);
            return back();
        }

    }


    public function show(Inquiry $inquiry)
    {
        checkOwner($inquiry);
        if ($inquiry->type == 'regular'){
            $extra = new Regular($inquiry);
        }elseif($inquiry->type == 'logistic'){
            $extra = new Logistic($inquiry);
        }
        return view('pages.company.inquiry.show',['data'=>$inquiry,'extra'=>$extra]);
    }

    //end inquiry funcs



   //quotation funcs
    public function quotationApprove(Quotation $quotation){
        checkOwner($quotation->inquiry);
        return view('pages.company.inquiry.approve_quotation',compact('quotation'));
    }
    public function quotationDoApprove(SampleRequest $request,Quotation $quotation){//approve quotation and request sample
        $validated = $request->validated();
        $inquiry = $quotation->inquiry;
        $inq = new Inq;
        $inq->init($inquiry);
        $funs = [
            ['name'=>'approve','data'=>$quotation],
            ['name'=>'makeSample','data'=>$validated],
        ];
        if ($request->coa_attachment){
            $inquiry->files()->updateOrCreate(['type'=>'coa'],[
                'name'=>$request->coa_attachment,
                'type'=>'coa'
            ]);
        }
        if ($inq->_continue($funs)){
            flash('Success')->success();
        }else{
            flash('Error')->error();
        }
        return redirect()->route('company-inquiry-show',$inquiry->id);
    }

    public function skip_sample(Quotation $quotation){
        $inquiry = $quotation->inquiry;
        $inq = new Inq(6);
        $inq->init($inquiry);
        $funs = [
            ['name'=>'approve','data'=>$quotation],
            ['name'=>'makeSample','data'=>['status'=>'received']],
        ];
        if ($inq->_continue($funs)){
            $sample = Sample::where('inquiry_id',$inquiry->id)->first();
            return redirect()->route('company-sample-approve',$sample->id);
        }else{
            flash('error')->error();
            return back();
        }

    }

    public function quotationReject(Request $request,Quotation $quotation){
        $inquiry = $quotation->inquiry;
        $inq = new Inq;
        $inq->init($inquiry);
        $funs = [
            ['name'=>'reject','data'=>$quotation],
        ];
        if ($inq->_reject($funs,$request->reason)){
            flash('Modification sent successfully')->success();
        }else{
            flash('Error')->error();
        }
        return back();
    }
    //end quotation funcs




    //sample funcs
    public function sampleReceive(Sample $sample){
        $inquiry = $sample->inquiry;
        $inq = new Inq;
        $inq->init($inquiry);
        $data = ['status'=>'received'];
        $funs = [
            ['name'=>'editSample','data'=>$data],
        ];
        if ($inq->_continue($funs)){
            flash('Sample Status Updated Successfully')->success();
        }else{
            flash('Error')->error();
        }
        return back();
    }
    public function sampleApprove(Sample $sample){
        checkOwner($sample->inquiry);
        return view('pages.company.inquiry.approve_sample',compact('sample'));
    }
    public function sampleDoApprove(PilotRequest $request ,Sample $sample){//approve sample and request pilot price
        $validated = $request->validated();
        $inquiry = $sample->inquiry;
        $inq = new Inq;
        $inq->init($inquiry);
        $funs = [
            ['name'=>'approve','data'=>$sample],
            ['name'=>'makePilot','data'=>$validated],
        ];
        if ($inq->_continue($funs)){
            flash('Success')->success();
        }else{
            flash('Error')->error();
        }

        return redirect()->route('company-inquiry-show',$inquiry->id);
    }
    public function sampleReject(RejectRequest $request,Sample $sample){
        $request->validated();
        $inquiry = $sample->inquiry;
        $inq = new Inq;
        $inq->init($inquiry);
        if ($request->doc){
            $f = [['name'=>'reject','data'=>$sample],['name'=>'uploadFile','data'=>['type'=>'rejection_report','name'=>$request->doc]]];
        }else{
            $f = [['name'=>'reject','data'=>$sample]];
        }
        $funs = $f;
        if ($inq->_reject($funs,$request->reason)){
            flash('Modification sent successfully')->success();
        }else{
            flash('Error')->error();
        }
        return back();
    }
    //end sample funcs


    //pilot funcs

    public function pilotApprove(Pilot $pilot){
        $inquiry = $pilot->inquiry;
        $inq = new Inq;
        $inq->init($inquiry);
        $funs = [
            ['name'=>'approve','data'=>$pilot],
        ];
        if ($inq->_continue($funs)){
            flash('Order Price Approved Successfully')->success();
        }else{
            flash('Error')->error();
        }
        return back();
    }

    public function pilotReject(RejectRequest $request,Pilot $pilot){
        $request->validated();
        $inquiry = $pilot->inquiry;
        $inq = new Inq;
        $inq->init($inquiry);
        $funs = [
            ['name'=>'reject','data'=>$pilot],
        ];
        if ($inq->_reject($funs,$request->reason)){
            flash('Modification sent successfully')->success();
        }else{
            flash('Error')->error();
        }
        return back();
    }

    public function poSend(FileRequest $request,Inquiry $inquiry){
        $validated = $request->validated();
        $inq = new Inq;
        $inq->init($inquiry);
        $funs = [
            ['name'=>'makePo','data'=>$request],
        ];
        if ($inq->_continue($funs)){
            flash('PO Sent Successfully')->success();
        }else{
            flash('Error')->error();
        }
        return back();
    }


    // logistic

    public function customerDocumentCreate(Inquiry $inquiry){
        checkOwner($inquiry);
        return view('pages.company.inquiry.customer_document_create',['data'=>$inquiry]);
    }

    public function customerDocumentStore(CustomerDocumentRequest $request,Inquiry $inquiry){
        $validated = $request->validated();

        $inq = new Inq;
        $inq->init($inquiry);
        $funs = [
            ['name'=>'makeCustomerDocument','data'=>$request],
        ];
        if ($inq->_continue($funs)){
            flash('customer document uploaded Successfully')->success();
        }else{
            flash('Error')->error();
        }
        return redirect()->route('company-inquiry-show',$inquiry->id);
    }

    public function customerDocumentEdit(Inquiry $inquiry){
        checkOwner($inquiry);
        return view('pages.admin.inquiry.customer_document_edit',['data'=>$inquiry]);
    }

    public function customerDocumentUpdate(Request $request,Inquiry $inquiry){
        checkOwner($inquiry);
        try {
            DB::beginTransaction();
            if ($request->hasFile('doc')){
                $files = $inquiry->files()->where('type','customerdoc')->get();
                foreach ($files as $file){
                    if (file_exists(asset('uploads/'.$file->name))){
                        unlink(asset('uploads/'.$file->name));
                    }
                    $file->delete();
                }
                foreach ($request->file('doc') as $file){
                    $inquiry->files()->create([
                        'name'=>$file,
                        'type'=>'customerdoc'
                    ]);
                }
                $inquiry->customer_docs()->sync($request->cdocs);
            }
            DB::commit();
            flash('customer document uploaded Successfully')->success();
        }catch (\Exception $exception){
            DB::rollBack();
            flash('Error')->error();
        }

        return back();
    }


    public function pcoaApprove(Inquiry $inquiry){
        $inq = new Inq;
        $inq->init($inquiry);
        $funs = [
            ['name'=>'fileApprove','data'=>'pcoa'],
        ];
        if ($inq->_continue($funs)){
            flash('PCOA Approved Successfully')->success();
        }else{
            flash('Error')->error();
        }
        return back();
    }

    public function pcoaReject(RejectRequest $request,Inquiry $inquiry){
        $request->validated();
        $inq = new Inq;
        $inq->init($inquiry);
        $funs = [
            ['name'=>'fileReject','data'=>'pcoa'],
        ];
        if ($inq->_reject($funs,$request->reason)){
            flash('Modification sent successfully')->success();
        }else{
            flash('Error')->error();
        }
        return back();
    }


    public function clearanceSend(FileRequest $request,Inquiry $inquiry){
        $validated = $request->validated();
        $inq = new Inq;
        $inq->init($inquiry);
        $funs = [
            ['name'=>'makeClearance','data'=>$request],
        ];
        if ($inq->_continue($funs)){
            flash('customer clearance document Sent Successfully')->success();
        }else{
            flash('Error')->error();
        }
        return back();
    }


    public function draftApprove(Inquiry $inquiry){
        $inq = new Inq;
        $inq->init($inquiry);
        $funs = [
            ['name'=>'fileApprove','data'=>'draft'],
        ];
        if ($inq->_continue($funs)){
            flash('Draft Files Approved Successfully')->success();
        }else{
            flash('Error')->error();
        }
        return back();
    }

    public function draftReject(RejectRequest $request,Inquiry $inquiry){
        $inq = new Inq;
        $inq->init($inquiry);
        $funs = [
            ['name'=>'fileReject','data'=>'draft'],
        ];
        if ($inq->_reject($funs,$request->reason)){
            flash('Modification sent successfully')->success();
        }else{
            flash('Error')->error();
        }
        return back();
    }


    public function finalApprove(Inquiry $inquiry){
        $inq = new Inq;
        $inq->init($inquiry);
        $funs = [
            ['name'=>'fileApprove','data'=>'final'],
        ];
        if ($inq->_continue($funs)){
            flash('Final Files Approved Successfully')->success();
        }else{
            flash('Error')->error();
        }
        return back();
    }

    public function finalReject(RejectRequest $request,Inquiry $inquiry){
        $inq = new Inq;
        $inq->init($inquiry);
        $funs = [
            ['name'=>'fileReject','data'=>'final'],
        ];
        if ($inq->_reject($funs,$request->reason)){
            flash('Modification sent successfully')->success();
        }else{
            flash('Error')->error();
        }
        return back();
    }




    public function swiftSend(Request $request,Inquiry $inquiry){
        $rules = [
            'doc'=>'required|array',
            'doc.*'=>'required|mimes:doc,pdf,jpg,png,jpeg',
        ];
        $request->validate($rules);
        checkOwner($inquiry);
        try {
            if ($request->hasFile('doc')){
                foreach ($request->file('doc') as $doc){
                    $inquiry->files()->create([
                        'name'=>$doc,
                        'type'=>'swift'
                    ]);
                }
            }

            flash('Swift file Sent Successfully')->success();
        }catch (\Exception $exception){
            flash('Error')->error();
        }
        return back();
    }


    public function from_po_form(){
        return view('pages.company.inquiry.from_po');
    }

    public function from_po(FileRequest $request){
        $validated = $request->validated();
        $company = auth()->user();
        try {

            $inq = new Inq;
            $inq->init();
            DB::beginTransaction();
            $inquiry = $company->inquiries()->create([
                'status'=>11,
                'status_name'=>$inq->_getStatusName([11,0]),
                'type'=>auth()->user()->account_type
            ]);

            $inquiry->status_logs()->create([
                'status'=>'sending po',
                'creator_type'=>'company',
                'created_by'=>auth()->user()->company_name,
                'creator_id'=>auth()->user()->id,
            ]);
            $inquiry->status_logs()->create([
                'status'=>$inquiry->status_name,
                'creator_type'=>'company',
                'created_by'=>auth()->user()->company_name,
                'creator_id'=>auth()->user()->id,
            ]);
            foreach ($request->file('doc') as $doc){
                $inquiry->files()->create(['name'=>$doc,'type'=>'po']);
            }
            DB::commit();
            flash('Inquiry Created Successfully')->success();
        }catch (\Exception $exception){
            DB::rollBack();
            dd($exception->getMessage());
            flash('An error has occurred')->error();
        }
        return redirect()->route('company-inquiry-show',$inquiry->id);
    }







}
