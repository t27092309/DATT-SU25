<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductVariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nikeAirMaxId = DB::table('products')->where('name', 'Nike Air Max 270')->first()->product_id;
        $adidasUltraboostId = DB::table('products')->where('name', 'Adidas Ultraboost 22')->first()->product_id;
        $converseChuckId = DB::table('products')->where('name', 'Converse Chuck Taylor All Star')->first()->product_id;
        $timberlandBootId = DB::table('products')->where('name', 'Timberland Premium Boot')->first()->product_id;

        DB::table('product_variants')->insert([
            // Nike Air Max 270
            ['product_id' => $nikeAirMaxId, 'color' => 'Trắng', 'size' => '39', 'stock_quantity' => 10, 'price_modifier' => 0.00],
            ['product_id' => $nikeAirMaxId, 'color' => 'Trắng', 'size' => '40', 'stock_quantity' => 15, 'price_modifier' => 0.00],
            ['product_id' => $nikeAirMaxId, 'color' => 'Đen', 'size' => '41', 'stock_quantity' => 8, 'price_modifier' => 0.00],

            // Adidas Ultraboost 22
            ['product_id' => $adidasUltraboostId, 'color' => 'Đen', 'size' => '40.5', 'stock_quantity' => 12, 'price_modifier' => 0.00],
            ['product_id' => $adidasUltraboostId, 'color' => 'Xám', 'size' => '42', 'stock_quantity' => 7, 'price_modifier' => 100000.00], // Ví dụ có tăng giá

            // Converse Chuck Taylor All Star
            ['product_id' => $converseChuckId, 'color' => 'Trắng', 'size' => '37', 'stock_quantity' => 20, 'price_modifier' => 0.00],
            ['product_id' => $converseChuckId, 'color' => 'Đen', 'size' => '38', 'stock_quantity' => 25, 'price_modifier' => 0.00],

            // Timberland Premium Boot
            ['product_id' => $timberlandBootId, 'color' => 'Nâu', 'size' => '42', 'stock_quantity' => 5, 'price_modifier' => 0.00],
        ]);
    }
}