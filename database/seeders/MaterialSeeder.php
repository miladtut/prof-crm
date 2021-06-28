<?php

namespace Database\Seeders;

use App\Models\Material;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MaterialSeeder extends Seeder
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
           $material= Material::create([
                'name'=>$faker->company,
            ]);
           $material->suppliers()->attach([1,2,3]);
        }
    }
}
