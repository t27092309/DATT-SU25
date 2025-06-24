<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str; // Import Str facade để tạo slug

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
                'slug' => Str::slug('Nike Air Max 270'), // Tự động tạo slug
                'description' => 'Giày Nike Air Max 270 với đệm Air lớn mang lại sự êm ái tối đa.',
                'brand' => 'Nike',
                'category_id' => $categoryIdSneaker,
                'base_price' => 2800000.00,
                'sale_price' => 2500000.00,
                'sold_quantity' => 120,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Adidas Ultraboost 22',
                'slug' => Str::slug('Adidas Ultraboost 22'),
                'description' => 'Adidas Ultraboost 22 mang lại năng lượng hoàn trả vượt trội cho mỗi bước chạy.',
                'brand' => 'Adidas',
                'category_id' => $categoryIdRunning,
                'base_price' => 3200000.00,
                'sale_price' => null,
                'sold_quantity' => 85,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Converse Chuck Taylor All Star',
                'slug' => Str::slug('Converse Chuck Taylor All Star'),
                'description' => 'Mẫu giày kinh điển, phong cách vượt thời gian.',
                'brand' => 'Converse',
                'category_id' => $categoryIdSneaker,
                'base_price' => 1200000.00,
                'sale_price' => 1000000.00,
                'sold_quantity' => 250,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Timberland Premium Boot',
                'slug' => Str::slug('Timberland Premium Boot'),
                'description' => 'Giày bốt chống nước, bền bỉ và phong cách.',
                'brand' => 'Timberland',
                'category_id' => $categoryIdBoot,
                'base_price' => 4500000.00,
                'sale_price' => null,
                'sold_quantity' => 40,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}