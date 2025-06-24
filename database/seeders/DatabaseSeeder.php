<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,         
            ProductVariantSeeder::class,
            ProductImageSeeder::class,    
            UserSeeder::class,
            UserAddressSeeder::class,
        ]);
    }
}