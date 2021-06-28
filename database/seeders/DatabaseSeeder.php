<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call([
             AdminSeeder::class,
             CountrySeeder::class,
             CompanySeeder::class,
             SpecSeeder::class,
             CurrencySeeder::class,
             DocumentSeeder::class,
             SupplierSeeder::class,
             MaterialSeeder::class,
             PaymentSeeder::class,
             ShippingSeeder::class,
             CustomerDocumentSeeder::class,
         ]);
    }
}
