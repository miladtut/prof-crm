<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CompanyDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyStoreRequest;
use App\Http\Requests\CompanyUpdateRequest;
use App\Mail\MainMail;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $dataTable = new CompanyDataTable($request->all());
        return $dataTable->render('pages.admin.companies.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyStoreRequest $request)
    {
        $validated = array_merge($request->validated(),['logo_img'=>$request->logo_img]);
        try {
            DB::beginTransaction();
            $company = Company::create(array_merge($validated,['register_type'=>'profect']));
            $msg = '<p>Dear '.$company->contact_person_name.'
                    Welcome to <a href="'.route('dashboard').'">'.config('app.name').' for investments website!</a>
                    We are waiting to receive your inquiry and we will get back to you ASAP,</p>
                    <p> dont hesitate to send us for any other requirement</p><p><b>Thanks & Best regards</b></p><p>profect admin</p>';
            Mail::to($company->email)->send(new MainMail('Welcome To '.config('app.name').' investment',$msg));
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
    public function show(Company $company)
    {
        return view('pages.admin.companies.show',['company'=>$company]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('pages.admin.companies.edit',['data'=>$company]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyUpdateRequest $request, Company $company)
    {

        if (is_file($request->logo_img)){

            $file = public_path().'/uploads/'.$company->logo_img;
            if (file_exists($file)){
                @unlink($file);
            }
            $validated = array_merge($request->validated(),['logo_img'=>$request->logo_img]);

        }else{
            if ($request->logo_img_remove){
                $file = public_path().'/uploads/'.$company->logo_img;
                if (file_exists($file)){
                    @unlink($file);
                }
                $validated = array_merge($request->validated(),['logo_img'=>null]);
            }else{
                $validated = $request->validated();
            }

        }
        try {
            $company->update($validated);
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
    public function destroy($id)
    {
        //
    }

    public function delete(Company $company){
        try {
            $company->delete();
            flash('Company Deleted Successfully')->success();
        }catch (\Exception $exception){
            flash('Error')->error();
        }
        return back();
    }

    public function block(Company $company){
        if ($company->blocked == '0'){
            $company->update(['blocked'=>'1']);
        }elseif ($company->blocked == '1'){
            $company->update(['blocked'=>'0']);
        }
        if ($company->blocked == 0){
            $json = ['message'=>'Company is Active now'];
        }else{
            $json = ['message'=>'Company is Blocked now'];
        }
        return response()->json($json);
    }
}
