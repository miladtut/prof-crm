<?php

namespace App\Http\Controllers\Company;

use App\Classes\Status\InquiryStatus;
use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        //
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

    public function po(Request $request,Inquiry $inquiry){
        checkOwner($inquiry);
        $status = new InquiryStatus($inquiry->company->account_type);
        try {
            DB::beginTransaction();
            $inquiry->files()->create([
                'name'=>$request->po,
                'type'=>'po',
            ]);
            $inquiry->status_logs()->create([
                'status'=>$status->status($inquiry->status[0] + 1,0),
                'creator_type'=>'company',
                'created_by'=>auth()->user()->company_name,
                'creator_id'=>auth()->user()->id
            ]);
            $inquiry->stages()->create([
                'name'=>$status->status($inquiry->status[0] + 1 ,0),
                'ordering'=>7,
            ]);
            $inquiry->update([
                'status'=>[$inquiry->status[0] + 1 ,0]
            ]);
            DB::commit();
            flash('Po Sent Successfully')->success();
        }catch (\Exception $exception){
            DB::rollBack();
            flash('Error')->error();
        }
        return back();
    }
}
