<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CustomerDocumentDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerDocumentStoreRequest;
use App\Models\Customerdoc;
use Illuminate\Http\Request;

class CustomerDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CustomerDocumentDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.customer_documents.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.customer_documents.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerDocumentStoreRequest $request)
    {
        $validated = $request->validated();
        try {
            Customerdoc::create($validated);
            flash('Document Created Successfully')->success();
        }catch (\Exception $exception){
            dd($exception->getMessage());
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
    public function edit(Customerdoc $customerDocument)
    {
        return view('pages.admin.customer_documents.edit',['data'=>$customerDocument]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerDocumentStoreRequest $request, Customerdoc $customerDocument)
    {
        $validated = $request->validated();
        try {
            $customerDocument->update($validated);
            flash('Document Updated Successfully')->success();
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

    public function delete(Customerdoc $customerDocument){
        try {
            $customerDocument->delete();
            flash('Document Deleted Successfully')->success();
        }catch (\Exception $exception){
            flash('Error')->error();
        }
        return back();
    }
}
