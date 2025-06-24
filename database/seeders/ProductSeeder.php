<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Lấy ID của các danh mục để liên kết
        $categoryIdSneaker = DB::table('categories')->where('name', 'Giày Sneaker')->first()->category_id;
        $categoryIdSport = DB::table('categories')->where('name', 'Giày Thể Thao')->first()->category_id;
        $categoryIdRunning = DB::table('categories')->where('name', 'Giày Chạy Bộ')->first()->category_id;
        $categoryIdBoot = DB::table('categories')->where('name', 'Giày Bốt')->first()->category_id;

        DB::table('products')->insert([
            [
                'name' => 'Nike Air Max 270',
                'description' => 'Giày Nike Air Max 270 với đệm Air lớn mang lại sự êm ái tối đa.',
                'brand' => 'Nike',
                'category_id' => $categoryIdSneaker,
                'base_price' => 2800000.00,
                'image_url' => 'https://example.com/nike_airmax.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Adidas Ultraboost 22',
                'description' => 'Adidas Ultraboost 22 mang lại năng lượng hoàn trả vượt trội cho mỗi bước chạy.',
                'brand' => 'Adidas',
                'category_id' => $categoryIdRunning,
                'base_price' => 3200000.00,
                'image_url' => 'https://example.com/adidas_ultraboost.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Converse Chuck Taylor All Star',
                'description' => 'Mẫu giày kinh điển, phong cách vượt thời gian.',
                'brand' => 'Converse',
                'category_id' => $categoryIdSneaker,
                'base_price' => 1200000.00,
                'image_url' => 'https://example.com/converse_chuck.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Timberland Premium Boot',
                'description' => 'Giày bốt chống nước, bền bỉ và phong cách.',
                'brand' => 'Timberland',
                'category_id' => $categoryIdBoot,
                'base_price' => 4500000.00,
                'image_url' => 'https://example.com/timberland_boot.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}