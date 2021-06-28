<?php

namespace Database\Seeders;

use App\Models\PaymentTerm;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PaymentSeeder extends Seeder
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
            PaymentTerm::create([
                'payment_name'=>$faker->creditCardType
            ]);
        }
    }
}
