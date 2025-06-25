<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Nike Air Max 270',
                'brand' => 'Nike',
                'category_id' => 4,
                'base_price' => 2800000,
                'sale_price' => 2500000,
                'description' => 'Giày Nike Air Max 270 với đệm Air lớn mang lại sự êm ái tối đa.',
                'sold_quantity' => 120,
                'slug' => 'nike-air-max-270'
            ],
            [
                'name' => 'Adidas Ultraboost 22',
                'brand' => 'Adidas',
                'category_id' => 2,
                'base_price' => 3200000,
                'sale_price' => 2900000,
                'description' => 'Adidas Ultraboost 22 mang lại năng lượng hoàn trả vượt trội cho mỗi bước chạy.',
                'sold_quantity' => 85,
                'slug' => 'adidas-ultraboost-22'
            ],
            [
                'name' => 'Converse Chuck Taylor All Star',
                'brand' => 'Converse',
                'category_id' => 4,
                'base_price' => 1200000,
                'sale_price' => 1000000,
                'description' => 'Mẫu giày kinh điển, phong cách vượt thời gian.',
                'sold_quantity' => 250,
                'slug' => 'converse-chuck-taylor-all-star'
            ],
            [
                'name' => 'Timberland Premium Boot',
                'brand' => 'Timberland',
                'category_id' => 3,
                'base_price' => 4500000,
                'sale_price' => 4200000,
                'description' => 'Giày bốt chống nước, bền bỉ và phong cách.',
                'sold_quantity' => 40,
                'slug' => 'timberland-premium-boot'
            ]
        ];

        foreach ($products as $product) {
            DB::table('products')->updateOrInsert(
                ['slug' => $product['slug']],
                array_merge($product, [
                    'created_at' => now(),
                    'updated_at' => now()
                ])
            );
        }
    }
}
