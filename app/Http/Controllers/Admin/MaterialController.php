<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\MaterialDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\MaterialStoreRequest;
use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MaterialDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.material.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.material.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MaterialStoreRequest $request)
    {
        $validated = $request->validated();
        try {
            $material=Material::create($validated);
            $material->suppliers()->attach($request->suppliers);
            flash('Material Created Successfully')->success();
        }catch (\Exception $e){
            dd($e->getMessage());
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
    public function edit(Material $material)
    {
        return view('pages.admin.material.edit',['data'=>$material]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MaterialStoreRequest $request, Material $material)
    {
        try {
            $material->update($request->validated());
            if ($request->suppliers){
                $material->suppliers()->sync($request->suppliers);
            }
            flash('Material Updated Successfully')->success();
        }catch (\Exception $exception){
            flash('Erroe')->error();
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

    public function delete(Material $material){
        try {
            $material->delete();
            flash('Material Deleted Successfully')->success();
        }catch (\Exception $exception){
            flash('Error')->error();
        }
        return back();
    }


    public function getSuppliers(Material $material){
        $suppliers = $material->suppliers;
        return view('components.suppliers',compact('suppliers'));
    }
}
