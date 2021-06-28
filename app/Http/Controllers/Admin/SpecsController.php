<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SpecDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\SpecStoreRequest;
use App\Models\Spec;
use Illuminate\Http\Request;

class SpecsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SpecDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.specs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.specs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SpecStoreRequest $request)
    {
        $validated = $request->validated();
        try {
            Spec::create($validated);
            flash('Specification Created Successfully')->success();
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
    public function edit(Spec $spec)
    {
        return view('pages.admin.specs.edit',['data'=>$spec]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SpecStoreRequest $request, Spec $spec)
    {
        try {
            $spec->update($request->validated());
            flash('Specification Updated Successfully')->success();
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

    public function delete(Spec $spec){
        try {
            $spec->delete();
            flash('Specification Deleted Successfully')->success();
        }catch (\Exception $exception){
            flash('Error')->error();
        }
        return back();
    }
}

