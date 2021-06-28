<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Initialization\AdminLogistic;
use App\Classes\Initialization\AdminRegular;
use App\Classes\Initialization\Backward;
use App\Classes\Initialization\Inq;
use App\Classes\Initialization\Logistic;
use App\DataTables\InquiryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerDocumentRequest;
use App\Http\Requests\FileRequest;
use App\Http\Requests\PilotRequest;
use App\Http\Requests\QuotationStoreRequest;
use App\Http\Requests\SupplierPoRequest;
use App\Http\Requests\SupplierStoreRequest;
use App\Mail\MainMail;
use App\Models\Inquiry;
use App\Models\Pilot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use TheSeer\Tokenizer\Exception;


class InquiryController extends Controller
{
    public function index(Request $request){
        $dataTable = new InquiryDataTable($request->all());
        return $dataTable->render('pages.admin.inquiry.index');
    }


    public function regular(InquiryDataTable $dataTable){
        return $dataTable->render('pages.admin.inquiry.index');
    }





    public function show(Inquiry $inquiry){
        if ($inquiry->type == 'regular'){
            $extra = new AdminRegular($inquiry);
        }elseif($inquiry->type == 'logistic'){
            $extra = new AdminLogistic($inquiry);
        }
        return view('pages.admin.inquiry.show',['data'=>$inquiry,'extra'=>$extra]);
    }


    public function changeStatus(Request $request,Inquiry $inquiry){
        try {
            DB::beginTransaction();
                $inquiry->update(['status_name'=>$request->status_name]);
                if ($request->status_name == 'waiting payment'){
                    $inquiry->status_logs()
                        ->where('status','sending customer clearance documents')
                        ->orderByDesc('id')->firstOrFail()->update(['status'=>'waiting payment']);
                }else{
                    $inquiry->status_logs()->create([
                        'status'=>$request->status_name,
                        'creator_type'=>'admin',
                        'created_by'=>auth('admin')->user()->admin_name,
                        'creator_id'=>auth('admin')->user()->id
                    ]);
                }
            DB::commit();
            flash('success')->success();
        }catch (\Exception $exception){
            DB::rollBack();
            flash('error')->error();
        }
        return back();
    }


    //quotation funs
    public function quotationCreate(Inquiry $inquiry,$mode = null){
        return view('pages.admin.inquiry.quotation_create',['data'=>$inquiry,'mode'=>$mode]);
    }
    public function quotationStore(QuotationStoreRequest $request,Inquiry $inquiry,$mode=null)
    {
        $validated = $request->validated();
        $data = $validated;
        unset($data['document']);
        if($mode == 'update'){
            try {
                DB::beginTransaction();
                $inquiry->quotation()->update($data);
                if ($validated['document']){
                    $inquiry->quotation->documents()->sync($validated['document']);
                }
                DB::commit();
                flash('Quotation Updated Successfully')->success();
            }catch (\Exception $exception){
                DB::rollBack();
                flash('Error')->error();
            }

            return redirect()->route('admin.inquiry.show',$inquiry->id);
        }elseif ($mode == 'modify'){

            try {
                DB::beginTransaction();
                $res = $inquiry->quotation()->update(array_merge($data,['status'=>null]));
                $inquiry->update(['status'=>($inquiry->status - 1),'status_name'=>'quotation sent']);
                $inquiry->status_logs()->create([
                    'status'=>'quotation sent',
                    'creator_type'=>'admin',
                    'created_by'=>auth('admin')->user()->admin_name,
                    'creator_id'=>auth('admin')->user()->id
                ]);
                if ($validated['document']){
                    $inquiry->quotation->documents()->sync($validated['document']);
                }
                DB::commit();
                flash('Quotation Modified Successfully')->success();
            }catch (\Exception $exception){
                DB::rollBack();
                flash('Error')->error();
            }
            return redirect()->route('admin.inquiry.show',$inquiry->id);
        }else{
            $inq = new Inq;
            $inq->init($inquiry);
            if ($res = $inq->_continue([['name'=>'makeQuotation','data'=>$validated]])){
                $msg = 'Hello '.$inquiry->company->company_name.'

                        We have sent you a quotation for inquiry #'.mb_substr($inquiry->company_name, 0, 3, "UTF-8").'-'.($inquiry->id**2).' Go to <a href="'.route('company-inquiry-show',$inquiry->id).'">inquiry page</a>

                        Please review it, provide us with any modifications you have, or approve it so we can processed with sample.

                        Thank you :)

                        '.config('app.name').' Investment Team';
                try {
                    Mail::to($inquiry->company->email)->send(new MainMail('Quotation sent for inquiry #'.mb_substr($inquiry->company_name, 0, 3, "UTF-8").'-'.($inquiry->id**2),$msg));
                }catch (\Exception $exception){

                }
                flash('Quotation Created Successfully')->success();
            }else{
                flash('Error')->error();
            }
            return redirect()->route('admin.inquiry.show',$inquiry->id);
        }
    }



    //sample funs
    public function sampleStatusUpdate(Inquiry $inquiry,$status){
        $inq = new Inq;
        $inq->init($inquiry);
        $data = ['status'=>$status];
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

    public function sampleModify(Inquiry $inquiry){
        try {
            DB::beginTransaction();
            $res = $inquiry->sample()->update(['status'=>'waiting']);
            $inquiry->update(['status'=>($inquiry->status - 5),'status_name'=>'waiting sample']);
            $inquiry->status_logs()->create([
                'status'=>'waiting sample',
                'creator_type'=>'admin',
                'created_by'=>auth('admin')->user()->admin_name,
                'creator_id'=>auth('admin')->user()->id
            ]);
            DB::commit();
            flash('sample Modified Successfully')->success();
        }catch (\Exception $exception){
            DB::rollBack();
            flash('Error')->error();
        }
        return back();
    }

    //pilot funs
    public function pilotShow(Pilot $pilot,$mode=null)
    {
        return view('pages.admin.inquiry.pilot_edit',['pilot'=>$pilot,'mode'=>$mode]);
    }
    public function pilotSend(PilotRequest $request, Pilot $pilot,$mode =null)
    {

        $validated = $request->validated();
        $inquiry = $pilot->inquiry;
        if ($mode == 'modify'){
            try {
                DB::beginTransaction();
                $pilot->update(array_merge($validated,['status'=>'sent']));
                $inquiry->update(['status'=>($inquiry->status - 1),'status_name'=>'pilot price sent']);
                $inquiry->status_logs()->create([
                    'status'=>'pilot price sent',
                    'creator_type'=>'admin',
                    'created_by'=>auth('admin')->user()->admin_name,
                    'creator_id'=>auth('admin')->user()->id
                ]);
                DB::commit();
                flash('Pilot Updated Successfully')->success();
            }catch (\Exception $exception){
                DB::rollBack();
                flash('Error')->error();
            }

        }elseif ($mode == 'update'){
            if ($pilot->update($validated)){
                flash('Pilot Updated Successfully')->success();
            }else{
                flash('Error')->error();
            }
        }
        else{
            $inq = new Inq;
            $inq->init($inquiry);
            $funs = [
                ['name'=>'editPilot','data'=>array_merge($validated,['status'=>'sent'])],
            ];
            if ($inq->_continue($funs)){
                flash('Pilot Updated Successfully')->success();
            }else{
                flash('Error')->error();
            }
        }

        return redirect()->route('admin.inquiry.show',$inquiry->id);
    }


    public function piSend(FileRequest $request,Inquiry $inquiry,$mode=null){
        $validated = $request->validated();

        if ($mode == 'update'){
            try {
                DB::beginTransaction();
                $files = $inquiry->files()->where('type','pi')->get();
                foreach ($files as $file){
                    if (file_exists(asset('uploads/'.$file->name))){
                        unlink(asset('uploads/'.$file->name));
                    }
                    $file->delete();
                }
                foreach ($request->file('doc') as $doc){
                    $inquiry->files()->create(['type'=>'pi','name'=>$doc]);
                }
                DB::commit();
                flash('sample Modified Successfully')->success();
            }catch (\Exception $exception){
                DB::rollBack();
                flash('Error')->error();
            }
            return back();
        }
        else{
            $inq = new Inq;
            $inq->init($inquiry);
            $funs = [
                ['name'=>'makePi','data'=>$request],
            ];
            if ($inq->_continue($funs)){
                flash('Pi Sent Successfully')->success();
            }else{
                flash('Error')->error();
            }
            return back();
        }


    }

    public function poEdit(Inquiry $inquiry){
        return view('pages.admin.inquiry.po_edit',['data'=>$inquiry]);
    }
    public function poUpdate(Request $request,Inquiry $inquiry){
        try {
            DB::beginTransaction();
            $files = $inquiry->files()->where('type','po')->get();
            foreach ($files as $file){
                if (file_exists(asset('uploads/'.$file->name))){
                    unlink(asset('uploads/'.$file->name));
                }
                $file->delete();
            }
            foreach ($request->file('doc') as $doc){
                $inquiry->files()->create(['type'=>'po','name'=>$doc]);
            }
            DB::commit();
            flash('po files updated Successfully')->success();
        }catch (\Exception $exception){
            DB::rollBack();
            flash('Error')->error();
        }
        return back();
    }

    public function trackNoSend(Request $request,Inquiry $inquiry){
        $rules = ['tracking_no'=>'required'];
        $request->validate($rules);
        try {
            $inquiry->update([
                'tracking_number_of_original_documents'=>$request->tracking_no
            ]);
            flash('tracking number sent successfully')->success();
        }catch (\Exception $exception){
            flash('Error')->error();
        }
        return back();
    }

    public function swiftEdit(Inquiry $inquiry){
        return view('pages.admin.inquiry.swift_edit',['data'=>$inquiry]);
    }
    public function swiftUpdate(Request $request,Inquiry $inquiry){
        try {
            DB::beginTransaction();
            $files = $inquiry->files()->where('type','swift')->get();
            foreach ($files as $file){
                if (file_exists(asset('uploads/'.$file->name))){
                    unlink(asset('uploads/'.$file->name));
                }
                $file->delete();
            }
            foreach ($request->file('doc') as $doc){
                $inquiry->files()->create(['type'=>'swift','name'=>$doc]);
            }
            DB::commit();
            flash('swift files updated Successfully')->success();
        }catch (\Exception $exception){
            DB::rollBack();
            flash('Error')->error();
        }
        return back();
    }


    //logistic funcs
    public function spoCreate(Inquiry $inquiry,$mode=null){
        return view('pages.admin.inquiry.spo_create',['inquiry'=>$inquiry,'mode'=>$mode]);
    }

    public function spoStore(SupplierPoRequest $request,Inquiry $inquiry,$mode=null){
        $validated = $request->validated();
        if ($mode == 'update'){
            try {
                $data = $validated;
                $material_total_price = $data['material_qty'] * $data['material_price_per_unit'];
                $working_standard_total_price = $data['working_standard_qty'] * $data['working_standard_price_per_unit'];
                $po_total_price = $material_total_price + $working_standard_total_price;
                $ex = [
                    'material_total_price'=>$material_total_price,
                    'working_standard_total_price'=>$working_standard_total_price,
                    'po_total_price'=>$po_total_price
                ];
                $data = array_merge($data,$ex);
                $inquiry->s_po()->update($data);
                flash('Po created Successfully')->success();
            }catch (\Exception $exception){
                flash('Error')->error();
            }

        }else{
            $inq = new Inq;
            $inq->init($inquiry);
            $funs = [
                ['name'=>'makeSupplierPo','data'=>$validated],
            ];
            if ($inq->_continue($funs)){
                if (!$inquiry->material_id){
                    $inquiry->update(['material_id'=>$request->material_id,'qty'=>$request->material_qty,'qty_unit'=>$request->material_qty_unit]);
                }
                flash('Po created Successfully')->success();
            }else{
                flash('Error')->error();
            }
        }

        return redirect()->route('admin.inquiry.show',$inquiry->id);
    }

    public function sdocSend(FileRequest $request,Inquiry $inquiry,$mode=null){
        $validated = $request->validated();
        if ($mode == 'update'){
            try {
                DB::beginTransaction();
                $files = $inquiry->supplier_document()->get();
                foreach ($files as $file){
                    if (file_exists(asset('uploads/'.$file->name))){
                        unlink(asset('uploads/'.$file->name));
                    }
                    $file->delete();
                }
                foreach ($request->file('doc') as $doc){
                    $inquiry->supplier_document()->create([
                        'name' => 'supplier document',
                        'document' => $doc,
                        'supplier_id' => $inquiry->s_po->supplier->id
                    ]);
                }
                DB::commit();
                flash('supplier document Modified Successfully')->success();
            }catch (\Exception $exception){
                DB::rollBack();
                flash('Error')->error();
            }

        }else{
            $inq = new Inq;
            $inq->init($inquiry);
            $funs = [
                ['name'=>'makeSupplierDocument','data'=>$request],
            ];
            if ($inq->_continue($funs)){
                flash('supplier document Sent Successfully')->success();
            }else{
                flash('Error')->error();
            }

        }
        return back();
    }


    public function customerDocumentCreate(Inquiry $inquiry){
        return view('pages.admin.inquiry.customer_document_create',['data'=>$inquiry]);
    }

    public function customerDocumentStore(Request $request,Inquiry $inquiry){
//        $validated = $request->validated();
        $inq = new Inq;
        $inq->init($inquiry);
        $funs = [
            ['name'=>'makeCustomerDocument','data'=>$request->all()],
        ];
        if ($inq->_continue($funs)){
            flash('customer document uploaded Successfully')->success();
        }else{
            flash('Error')->error();
        }
        return redirect()->route('admin.inquiry.show',$inquiry->id);
    }

    public function customerDocumentEdit(Inquiry $inquiry){
        return view('pages.admin.inquiry.customer_document_edit',['data'=>$inquiry]);
    }

    public function customerDocumentUpdate(Request $request,Inquiry $inquiry){

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

        return redirect()->route('admin.inquiry.show',$inquiry->id);
    }



    public function pcoaSend(FileRequest $request,Inquiry $inquiry,$mode=null){
        $validated = $request->validated();
        if ($mode == 'modify'){
            try {
                DB::beginTransaction();
                $files = $inquiry->files()->where('type','pcoa')->get();
                foreach ($files as $file){
                    if (file_exists(asset('uploads/'.$file->name))){
                        unlink(asset('uploads/'.$file->name));
                    }
                    $file->delete();
                }
                foreach ($request->file('doc') as $doc){
                    $inquiry->files()->create(['type'=>'pcoa','name'=>$doc]);
                }
                $inquiry->update(['status'=>($inquiry->status - 1),'pcoa_status'=>null,'status_name'=>'PCOA sent']);
                $inquiry->status_logs()->create([
                    'status'=>'PCOA sent',
                    'creator_type'=>'admin',
                    'created_by'=>auth('admin')->user()->admin_name,
                    'creator_id'=>auth('admin')->user()->id
                ]);
                DB::commit();
                flash('sample Modified Successfully')->success();
            }catch (\Exception $exception){
                DB::rollBack();
                flash('Error')->error();
            }
            return back();
        }elseif ($mode == 'update'){
            try {
                DB::beginTransaction();
                $files = $inquiry->files()->where('type','pcoa')->get();
                foreach ($files as $file){
                    if (file_exists(asset('uploads/'.$file->name))){
                        unlink(asset('uploads/'.$file->name));
                    }
                    $file->delete();
                }
                foreach ($request->file('doc') as $doc){
                    $inquiry->files()->create(['type'=>'pcoa','name'=>$doc]);
                }
                DB::commit();
                flash('sample Modified Successfully')->success();
            }catch (\Exception $exception){
                DB::rollBack();
                flash('Error')->error();
            }
            return back();
        }
        else{
            if ($inquiry->type == 'logistic'){
                $inq = new Inq(15);
            }else{
                $inq = new Inq;
            }
            $inq->init($inquiry);
            $funs = [
                ['name'=>'makePcoa','data'=>$request],
            ];
            if ($inq->_continue($funs)){
                flash('Pcoa Sent Successfully')->success();
            }else{
                flash('Error')->error();
            }
            return back();
        }

    }


    public function orgSend(FileRequest $request,Inquiry $inquiry,$mode=null){
        $validated = $request->validated();
        if ($mode == 'update'){
            try {
                DB::beginTransaction();
                $files = $inquiry->files()->where('type','org')->get();
                foreach ($files as $file){
                    if (file_exists(asset('uploads/'.$file->name))){
                        unlink(asset('uploads/'.$file->name));
                    }
                    $file->delete();
                }
                foreach ($request->file('doc') as $doc){
                    $inquiry->files()->create(['type'=>'org','name'=>$doc]);
                }
                DB::commit();
                flash('original document updated Successfully')->success();
            }catch (\Exception $exception){
                DB::rollBack();
                flash('Error')->error();
            }
        }else{
            $inq = new Inq;
            $inq->init($inquiry);
            $funs = [
                ['name'=>'makeorg','data'=>$request],
            ];
            if ($inq->_continue($funs)){
                flash('org Sent Successfully')->success();
            }else{
                flash('Error')->error();
            }
        }

        return back();
    }


    public function notesSend(FileRequest $request,Inquiry $inquiry,$mode=null){
        $validated = $request->validated();
        if ($mode == 'update'){
            try {
                DB::beginTransaction();
                $files = $inquiry->files()->where('type','notes')->get();
                foreach ($files as $file){
                    if (file_exists(asset('uploads/'.$file->name))){
                        unlink(asset('uploads/'.$file->name));
                    }
                    $file->delete();
                }
                foreach ($request->file('doc') as $doc){
                    $inquiry->files()->create(['type'=>'notes','name'=>$doc]);
                }
                DB::commit();
                flash('delivery notes document updated Successfully')->success();
            }catch (\Exception $exception){
                DB::rollBack();
                flash('Error')->error();
            }
        }else{
            $inq = new Inq;
            $inq->init($inquiry);
            $funs = [
                ['name'=>'makenotes','data'=>$request],
            ];
            if ($inq->_continue($funs)){
                flash('delivery notes Sent Successfully')->success();
            }else{
                flash('Error')->error();
            }
        }

        return back();
    }


    public function draftSend(FileRequest $request,Inquiry $inquiry,$mode=null){
        $validated = $request->validated();
        if ($mode == 'modify'){
            try {
                DB::beginTransaction();
                $files = $inquiry->files()->where('type','draft')->get();
                foreach ($files as $file){
                    if (file_exists(asset('uploads/'.$file->name))){
                        unlink(asset('uploads/'.$file->name));
                    }
                    $file->delete();
                }
                foreach ($request->file('doc') as $doc){
                    $inquiry->files()->create(['type'=>'draft','name'=>$doc]);
                }
                $inquiry->update(['status'=>($inquiry->status - 1),'draft_status'=>null,'status_name'=>'draft ship file sent']);
                $inquiry->status_logs()->create([
                    'status'=>'draft ship file sent',
                    'creator_type'=>'admin',
                    'created_by'=>auth('admin')->user()->admin_name,
                    'creator_id'=>auth('admin')->user()->id
                ]);
                DB::commit();
                flash('sample Modified Successfully')->success();
            }catch (\Exception $exception){
                DB::rollBack();
                flash('Error')->error();
            }
            return back();
        }elseif ($mode == 'update'){
            try {
                DB::beginTransaction();
                $files = $inquiry->files()->where('type','draft')->get();
                foreach ($files as $file){
                    if (file_exists(asset('uploads/'.$file->name))){
                        unlink(asset('uploads/'.$file->name));
                    }
                    $file->delete();
                }
                foreach ($request->file('doc') as $doc){
                    $inquiry->files()->create(['type'=>'draft','name'=>$doc]);
                }
                DB::commit();
                flash('sample Modified Successfully')->success();
            }catch (\Exception $exception){
                DB::rollBack();
                flash('Error')->error();
            }
            return back();
        }
        else{
            $inq = new Inq;
            $inq->init($inquiry);
            $funs = [
                ['name'=>'makeDraft','data'=>$request],
            ];
            if ($inq->_continue($funs)){
                flash('Draft files Sent Successfully')->success();
            }else{
                flash('Error')->error();
            }
            return back();
        }

    }

    public function finalSend(FileRequest $request,Inquiry $inquiry,$mode=null){
        $validated = $request->validated();
        if ($mode == 'modify'){
            try {
                DB::beginTransaction();
                $files = $inquiry->files()->where('type','final')->get();
                foreach ($files as $file){
                    if (file_exists(asset('uploads/'.$file->name))){
                        unlink(asset('uploads/'.$file->name));
                    }
                    $file->delete();
                }
                foreach ($request->file('doc') as $doc){
                    $inquiry->files()->create(['type'=>'final','name'=>$doc]);
                }
                $inquiry->update(['status'=>($inquiry->status - 1),'final_status'=>null,'status_name'=>'final ship file sent']);
                $inquiry->status_logs()->create([
                    'status'=>'final ship file sent',
                    'creator_type'=>'admin',
                    'created_by'=>auth('admin')->user()->admin_name,
                    'creator_id'=>auth('admin')->user()->id
                ]);
                DB::commit();
                flash('sample Modified Successfully')->success();
            }catch (\Exception $exception){
                DB::rollBack();
                flash('Error')->error();
            }
            return back();
        }
        elseif ($mode == 'update'){
            try {
                DB::beginTransaction();
                $files = $inquiry->files()->where('type','final')->get();
                foreach ($files as $file){
                    if (file_exists(asset('uploads/'.$file->name))){
                        unlink(asset('uploads/'.$file->name));
                    }
                    $file->delete();
                }
                foreach ($request->file('doc') as $doc){
                    $inquiry->files()->create(['type'=>'final','name'=>$doc]);
                }
                DB::commit();
                flash('sample Modified Successfully')->success();
            }catch (\Exception $exception){
                DB::rollBack();
                flash('Error')->error();
            }
            return back();
        }
        else{
            $inq = new Inq;
            $inq->init($inquiry);
            $funs = [
                ['name'=>'makeFinal','data'=>$request],
            ];
            if ($inq->_continue($funs)){
                flash('Final files Sent Successfully')->success();
            }else{
                flash('Error')->error();
            }
            return back();
        }

    }


    public function close(Inquiry $inquiry){

        if ($inquiry->type == 'logistic'){
            $inq = new Inq(20);
            $inq->init($inquiry);
            $funs = [
                ['name'=>'closeInquiry','data'=>''],
            ];
            if ($inq->_continue($funs)){
                flash('Inquiry Closed Successfully')->success();
            }else{
                flash('Error')->error();
            }
        }else{
            $inq = new Inq;
            $inq->init($inquiry);
            $funs = [
                ['name'=>'closeInquiry','data'=>''],
            ];
            if ($inq->_continue($funs)){
                flash('Inquiry Closed Successfully')->success();
            }else{
                flash('Error')->error();
            }
        }

        return back();
    }



    public function backward(Request $request,Inquiry $inquiry,$type=null){
        $back = new Backward($inquiry);
        try {
            DB::beginTransaction();
            if ($type == 'logistic'){
                $back->run_logistic($request->step);
            }else{
                $back->run_regular($request->step);
            }
            DB::commit();
            flash('success')->success();
        }catch (\Exception $exception){
            DB::rollBack();
            flash('error')->error();
        }
        return back();

    }


    public function decline(Inquiry $inquiry){
        try {
            DB::beginTransaction();
            $inquiry->update(['status_name'=>'declined']);
            $inquiry->status_logs()->create([
                'status'=>'declined',
                'creator_type'=>'admin',
                'created_by'=>auth('admin')->user()->admin_name,
                'creator_id'=>auth('admin')->user()->id
            ]);
            DB::commit();
            flash('inquiry declined successfully')->success();
        }catch (\Exception $exception){
            DB::rollBack();
            flash('error')->error();
        }
        return back();

    }



}
