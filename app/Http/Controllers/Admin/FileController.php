<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Status\InquiryStatus;
use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function pi(Request $request,Inquiry $inquiry){
        $status = new InquiryStatus($inquiry->company->account_type);
        try {
            DB::beginTransaction();
            $inquiry->files()->create([
                'name'=>$request->pi,
                'type'=>'pi',
            ]);
            $inquiry->status_logs()->create([
                'status'=>$status->status($inquiry->status[0] + 1,0),
                'creator_type'=>'admin',
                'created_by'=>auth('admin')->user()->admin_name,
                'creator_id'=>auth('admin')->user()->id
            ]);
            $inquiry->stages()->create([
                'name'=>$status->status($inquiry->status[0] + 1 ,0),
                'ordering'=>6,
            ]);
            $inquiry->update([
                'status'=>[$inquiry->status[0] + 1 ,0]
            ]);
            DB::commit();
            flash('Pi Sent Successfully')->success();
        }catch (\Exception $exception){
            DB::rollBack();
            flash('Error')->error();
        }
        return back();
    }
    public function piUpdate(Request $request,Inquiry $inquiry){
        try {
            $file = $inquiry->files()->where('type','pi')->first();
            if (file_exists(public_path($file->name))){
                unlink(public_path($file->name));
            }
            $file->update([
                'name'=>$request->pi,
                'type'=>'pi',
            ]);
            flash('Success')->success();
        }catch (\Exception $exception){
            flash('Error')->error();
        }
        return back();

    }

    public function pcoa(Request $request,Inquiry $inquiry){
        $status = new InquiryStatus($inquiry->company->account_type);
        try {
            DB::beginTransaction();
            $inquiry->files()->create([
                'name'=>$request->pcoa,
                'type'=>'pcoa',
            ]);
            $inquiry->status_logs()->create([
                'status'=>$status->status($inquiry->status[0] + 1,0),
                'creator_type'=>'admin',
                'created_by'=>auth('admin')->user()->admin_name,
                'creator_id'=>auth('admin')->user()->id
            ]);

            $inquiry->update([
                'status'=>[$inquiry->status[0] + 1 ,0]
            ]);
            DB::commit();
            flash('PCOA Sent Successfully')->success();
        }catch (\Exception $exception){
            DB::rollBack();
            flash('Error')->error();
        }
        return back();
    }


    public function draft(Request $request,Inquiry $inquiry){
        $status = new InquiryStatus($inquiry->company->account_type);
        try {
            DB::beginTransaction();
            $inquiry->files()->create([
                'name'=>$request->draft,
                'type'=>'draft',
            ]);
            $inquiry->status_logs()->create([
                'status'=>$status->status($inquiry->status[0] + 1,0),
                'creator_type'=>'admin',
                'created_by'=>auth('admin')->user()->admin_name,
                'creator_id'=>auth('admin')->user()->id
            ]);

            $inquiry->update([
                'status'=>[$inquiry->status[0] + 1 ,0]
            ]);
            DB::commit();
            flash('draft Sent Successfully')->success();
        }catch (\Exception $exception){
            DB::rollBack();
            flash('Error')->error();
        }
        return back();
    }

    public function finalFile(Request $request,Inquiry $inquiry){
        $status = new InquiryStatus($inquiry->company->account_type);
        try {
            DB::beginTransaction();
            $inquiry->files()->create([
                'name'=>$request->final,
                'type'=>'final',
            ]);
            $inquiry->status_logs()->create([
                'status'=>$status->status($inquiry->status[0] + 1,0),
                'creator_type'=>'admin',
                'created_by'=>auth('admin')->user()->admin_name,
                'creator_id'=>auth('admin')->user()->id
            ]);

            $inquiry->update([
                'status'=>[$inquiry->status[0] + 1 ,0]
            ]);
            DB::commit();
            flash('draft Sent Successfully')->success();
        }catch (\Exception $exception){
            DB::rollBack();
            flash('Error')->error();
        }
        return back();
    }



}
