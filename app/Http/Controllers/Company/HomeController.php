<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountUpdateRequest;
use App\Mail\MainMail;
use App\Models\Admin;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.company.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createDoc(Request $request)
    {
        try {
            $doc = Document::updateOrCreate(['name'=>$request->name],['name'=>$request->name]);
            return response()->json(['status'=>'success','name'=>$doc->name,'id'=>$doc->id]);
        }catch (\Exception $exception){
            return response()->json(['status'=>'error']);
        }

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

    public function download(Request $request){
        if (file_exists('uploads/'.$request->path)){
            return response()->download(public_path('uploads/'.$request->path));
        }else{
            flash('file not exists')->error();
            return back();
        }
    }

    public function edit_account(){
        return view('pages.company.account.edit');
    }

    public function account_update(AccountUpdateRequest $request){
        $company = auth()->user();
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
            flash('Account Updated Successfully')->success();
        }catch (\Exception $exception){
            flash('Error')->error();
        }

        return back();

    }

    public function change_password(){
        return view('pages.company.account.change_password');
    }

    public function password_update(Request $request){
        $rules = [
            'old_password'=>'required',
            'new_password'=>'required|min:6|max:60',
            'confirm_new_password'=>'required_with:new_password|same:new_password'
        ];
        $request->validate($rules);
        if (Hash::check($request->old_password,auth()->user()->password)){
            auth()->user()->update(['password'=>$request->new_password]);
            flash('password updated successfully')->success();
        }else{
            flash('current password doesnt match')->error();
        }
        return back();
    }

    public function partners(){
        return view('pages.company.profect.partners');
    }

    public function about(){
        return view('pages.company.profect.about');
    }

    public function contact_us(Request $request){
        $super_admin = Admin::where('super_admin','1')->first()->email;
        $admins = Admin::query()->where('blocked','0')->pluck('email');
        $msg = '<div><b>name:</b> '.$request->c_name.'</div>'.
            '<div><b>email:</b> '.$request->c_email.'</div>'.
            '<div><b>phone:</b> '.$request->c_phone.'</div>'.
            '<div><b>website:</b> '.$request->c_website.'</div>'.
            '<div><b>message:</b> '.$request->c_message.'</div>';
        try {
            Mail::to($super_admin)->cc($admins)->send(new MainMail('website contact us',$msg));
            return back()->with('success','you message sent successfully');
        }catch (\Exception $exception){
            dd($exception->getMessage());
            return back()->with('fail','error');
        }


    }


}
