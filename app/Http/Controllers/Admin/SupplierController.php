<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SupplierDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\SupplierStoreRequest;
use App\Models\File;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $dataTable = new SupplierDataTable($request->all());
        return $dataTable->render('pages.admin.suppliers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SupplierStoreRequest $request)
    {
        $validated = array_merge($request->validated(),['logo_img'=>$request->logo_img]);
        try {
            DB::beginTransaction();
            $sup = Supplier::create($validated);
            if ($request->hasFile('doc')){
                foreach ($request->file('doc') as $doc){
                    $sup->files()->create(['name'=>$doc]);
                }
            }
            DB::commit();
            flash('Company Created Successfully')->success();
        }catch (\Exception $exception){
            DB::rollBack();
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
    public function show(Supplier $supplier)
    {
        return view('pages.admin.suppliers.show',['supplier'=>$supplier]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        return view('pages.admin.suppliers.edit',['data'=>$supplier]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SupplierStoreRequest $request, Supplier $supplier)
    {

        if (is_file($request->logo_img)){

            $file = public_path().'/uploads/'.$supplier->logo_img;
            if (file_exists($file)){
                @unlink($file);
            }
            $validated = array_merge($request->validated(),['logo_img'=>$request->logo_img]);

        }else{
            if ($request->logo_img_remove){
                $file = public_path().'/uploads/'.$supplier->logo_img;
                if (file_exists($file)){
                    @unlink($file);
                }
                $validated = array_merge($request->validated(),['logo_img'=>null]);
            }else{
                $validated = $request->validated();
            }

        }
        if ($request->hasFile('doc')){
            foreach ($request->file('doc') as $doc){
                $supplier->files()->create(['name'=>$doc]);
            }
        }
        try {
            $supplier->update($validated);
            flash('Company Updated Successfully')->success();
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
    public function destroy(File $file)
    {
        $doc = asset('uploads/').$file->name;
        if (file_exists($doc)){
            @unlink($doc);
        }
        $file->delete();
        return back();
    }
}
