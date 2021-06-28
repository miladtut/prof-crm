<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Faker\Factory;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Factory::create();
        for ($i=1;$i<10;$i++){
            Supplier::create([
                'supplier_name'=>$faker->company,
                'contact_person_name'=>$faker->name,
                'phone_key'=>$faker->countryCode,
                'phone'=>$faker->phoneNumber,
                'email'=>$faker->email,
                'country'=>1,
                'no_of_logistics_inquiries'=>0,
                'no_of_materials'=>0,
            ]);
        }
    }
}
