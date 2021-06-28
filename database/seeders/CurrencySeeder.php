<?php

namespace Database\Seeders;

use App\Models\Currency;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CurrencySeeder extends Seeder
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
            Currency::create([
                'currency_name'=>$faker->currencyCode
            ]);
        }
    }
}
