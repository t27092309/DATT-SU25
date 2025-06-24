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
            UserSeeder::class,           // UserSeeder giờ chứa cả admin roles
            UserAddressSeeder::class,
            // Carts, Cart_Items, Orders, Order_Items, Payments (nếu bạn có seeder cho chúng)
        ]);
    }
}