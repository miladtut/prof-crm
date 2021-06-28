<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\PaymentTermDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentTermsStoreRequest;
use App\Models\PaymentTerm;
use Illuminate\Http\Request;

class PaymenTermsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PaymentTermDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.payment_terms.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.payment_terms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentTermsStoreRequest $request)
    {
        $validated = $request->validated();
        try {
            PaymentTerm::create($validated);
            flash('Country Saved Successfully')->success();
        }catch (\Exception $exception){
            flash('Error')->error();
        }
        return back();
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
    public function edit(PaymentTerm $paymentTerm)
    {
        return view('pages.admin.payment_terms.edit',['data'=>$paymentTerm]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PaymentTermsStoreRequest $request, PaymentTerm $paymentTerm)
    {
        try {
            $paymentTerm->update($request->all());
            flash('Country Updated Successfully')->success();
        }catch (\Exception $exception){
            flash('Error')->error();
        }

        return back();
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

    public function delete(PaymentTerm $paymentTerm){
        try {
            $paymentTerm->delete();
            flash('Country deleted Successfully')->success();
        }catch (\Exception $exception){
            flash('Error')->error();
        }
        return back();
    }
}
