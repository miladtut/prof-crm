<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ShippingTermDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingTermsStoreRequest;
use App\Models\ShippingTerm;
use Illuminate\Http\Request;

class ShippingTermsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ShippingTermDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.shipping_terms.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.shipping_terms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShippingTermsStoreRequest $request)
    {
        $validated = $request->validated();
        try {
            ShippingTerm::create($validated);
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
    public function edit(ShippingTerm $shippingTerm)
    {
        return view('pages.admin.shipping_terms.edit',['data'=>$shippingTerm]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ShippingTermsStoreRequest $request, ShippingTerm $shippingTerm)
    {
        try {
            $shippingTerm->update($request->validated());
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

    public function delete(ShippingTerm $shippingTerm){
        try {
            $shippingTerm->delete();
            flash('Country deleted Successfully')->success();
        }catch (\Exception $exception){
            flash('Error')->error();
        }
        return back();
    }
}
