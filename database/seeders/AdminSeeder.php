<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'admin_name'=>'super admin',
            'email'=>'admin@admin.com',
            'password'=>'00000000',
            'super_admin'=>'1',
            'role'=>'1'
        ]);
    }
}
