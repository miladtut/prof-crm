<?php

namespace App\Http\Controllers\Company;

use App\Classes\Status\InquiryStatus;
use App\Http\Controllers\Controller;
use App\Models\Stage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FinalController extends Controller
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

    public function approve(Stage $stage){
        $inquiry = $stage->inquiry;
        checkOwner($inquiry);
        $status = new InquiryStatus($inquiry->company->account_type);
        try {
            DB::beginTransaction();
            $inquiry->stages()->create([
                'name'=>$status->status($inquiry->status[0] + 1 ,0),
                'ordering'=>10,
            ]);
            $inquiry->status_logs()->create([
                'status'=>$status->status($inquiry->status[0] + 1,0),
                'creator_type'=>'company',
                'created_by'=>auth()->user()->company_name,
                'creator_id'=>auth()->user()->id
            ]);
            $stage->update([
                'status'=>'approved'
            ]);
            $inquiry->update([
                'status'=>[$inquiry->status[0] + 1 ,0]
            ]);
            DB::commit();
            flash('draft Approved')->success();
        }catch (\Exception $exception){
            DB::rollBack();
            flash('Error')->error();
        }

        return back();
    }

    public function reject(Stage $stage){
        $inquiry = $stage->inquiry;
        try {
            $stage->update([
                'status'=>'rejected'
            ]);
            flash('PCOA rejected')->success();
        }catch (\Exception $exception){
            flash('Error')->error();
        }

        return back();
    }
}
