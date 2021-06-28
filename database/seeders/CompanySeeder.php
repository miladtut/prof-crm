<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::create([
            'company_name'=>'test Company',
            'contact_person_name'=>'anne',
            'phone_key'=>'20',
            'phone'=>'01222222222',
            'email'=>'regular@company.com',
            'password'=>'123456',
            'register_type'=>'website',
            'account_type'=>'regular',
            'country'=>1,
        ]);
        Company::create([
            'company_name'=>'logistic Company',
            'contact_person_name'=>'anne2',
            'phone_key'=>'20',
            'phone'=>'0122222228',
            'email'=>'logistic@company.com',
            'password'=>'123456',
            'register_type'=>'website',
            'account_type'=>'logistic',
            'country'=>1,
        ]);
    }
}
