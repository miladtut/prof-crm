<?php

namespace App\Http\Controllers\Admin;


use App\Classes\Status\InquiryStatus;
use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\Partner;
use App\Models\Profect;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('pages.admin.dashboard');
    }
    public function download(Request $request){
        if (file_exists('uploads/'.$request->path)){
            return response()->download(public_path('uploads/'.$request->path));
        }else{
            flash('file not exists')->error();
            return back();
        }
    }
    public function partners(){
        return view('pages.admin.profect.partners');
    }
    public function add_partner(Request $request){
        $rules = [
            'name'=>'required|max:200',
            'logo'=>'required|mimes:jpg,jpeg,png'
        ];
        $request->validate($rules);
        $data = $request->all();
        Partner::create($data);
        return back();
    }
    public function delete_partner(Partner $partner){
        $file = asset('uploads/').$partner->logo;
        if (file_exists($file)){
            @unlink($file);
        }
        $partner->delete();
        return back();
    }

    public function about(){
        return view('pages.admin.profect.about_profect');
    }
    public function about_update(Request $request){
        $rules = ['about_us'=>'required'];
        $request->validate($rules);
        Profect::query()->updateOrCreate(['id'=>1],$request->all());
        return back();
    }
}
