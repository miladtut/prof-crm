<?php

namespace Database\Seeders;

use App\Models\Customerdoc;
use Faker\Factory;
use Illuminate\Database\Seeder;

class CustomerDocumentSeeder extends Seeder
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
            Customerdoc::create([
                'name'=>$faker->name
            ]);
        }
    }
}
