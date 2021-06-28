<?php

namespace Database\Seeders;

use App\Models\Country;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CountrySeeder extends Seeder
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
            Country::create([
                'name'=>$faker->country,
                'phone_key'=>rand(20,200)
            ]);
        }
    }
}
