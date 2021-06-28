<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyStoreRequest;
use App\Mail\MainMail;
use App\Models\Admin;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    public function login(){
        return view('pages.company.login');
    }

    public function do_login(Request $request){
        $credentials = ['email'=>$request->email,'password'=>$request->password];
        if (Auth::attempt($credentials,true)){
            if (auth()->user()->blocked == '1'){
                Auth::logout();
                flash('Sorry you are Blocked')->error();
                return redirect()->route('login');
            }
            return redirect()->route('dashboard');
        }
        flash('wrong credentials')->error();
        return redirect()->route('login');
    }

    public function register(){
        return view('pages.company.register');
    }

    public function do_register(CompanyStoreRequest $request){
        $validated = $request->validated();
        $super_admin = Admin::where('super_admin','1')->first()->email;
        $admins = Admin::query()->where('blocked','0')->pluck('email');
        try {
            $company = Company::create($validated);
            $msg = 'New company registered on Profect investment website Go check it now (<a href="'.route('admin.companies.show',$company->id).'">click here</a>)';
            Mail::to($super_admin)->cc($admins)->send(new MainMail('New company registration',$msg));
            flash('Congratulations Now you have account on '.config('app.name'))->success();
        }catch (\Exception $exception){
            flash('error')->error();
        }

        return back();
    }

    public function reset_password_form(){
        return view('pages.company.reset_password');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
