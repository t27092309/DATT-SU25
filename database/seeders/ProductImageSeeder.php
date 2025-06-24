<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Lấy product_id để liên kết hình ảnh
        $nikeAirMaxId = DB::table('products')->where('name', 'Nike Air Max 270')->first()->product_id;
        $adidasUltraboostId = DB::table('products')->where('name', 'Adidas Ultraboost 22')->first()->product_id;
        $converseChuckId = DB::table('products')->where('name', 'Converse Chuck Taylor All Star')->first()->product_id;
        $timberlandBootId = DB::table('products')->where('name', 'Timberland Premium Boot')->first()->product_id;

        DB::table('product_images')->insert([
            // Hình ảnh cho Nike Air Max 270
            [
                'product_id' => $nikeAirMaxId,
                'image_url' => 'https://example.com/nike_airmax_main.jpg',
                'alt_text' => 'Nike Air Max 270 màu trắng',
                'order' => 1,
                'is_thumbnail' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'product_id' => $nikeAirMaxId,
                'image_url' => 'https://example.com/nike_airmax_side.jpg',
                'alt_text' => 'Nike Air Max 270 góc nhìn bên',
                'order' => 2,
                'is_thumbnail' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Hình ảnh cho Adidas Ultraboost 22
            [
                'product_id' => $adidasUltraboostId,
                'image_url' => 'https://example.com/adidas_ultraboost_main.jpg',
                'alt_text' => 'Adidas Ultraboost 22 màu đen',
                'order' => 1,
                'is_thumbnail' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Hình ảnh cho Converse Chuck Taylor All Star
            [
                'product_id' => $converseChuckId,
                'image_url' => 'https://example.com/converse_chuck_main.jpg',
                'alt_text' => 'Converse Chuck Taylor All Star màu đen',
                'order' => 1,
                'is_thumbnail' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Hình ảnh cho Timberland Premium Boot
            [
                'product_id' => $timberlandBootId,
                'image_url' => 'https://example.com/timberland_main.jpg',
                'alt_text' => 'Timberland Premium Boot màu nâu',
                'order' => 1,
                'is_thumbnail' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}