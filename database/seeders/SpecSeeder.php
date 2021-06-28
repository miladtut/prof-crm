<?php

namespace Database\Seeders;

use App\Models\Spec;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SpecSeeder extends Seeder
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
            Spec::create([
                'name'=>$faker->word
            ]);
        }
    }
}
