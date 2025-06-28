<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductVariantSeeder extends Seeder
{
    public function run(): void
    {
        $products = DB::table('products')->pluck('product_id', 'name');

        if ($products->isEmpty()) {
            $this->command->warn('Chưa có sản phẩm nào trong bảng products, vui lòng seed ProductSeeder trước.');
            return;
        }

        $variants = [
            // Nike Air Max 270
            ['product' => 'Nike Air Max 270', 'color' => 'Trắng', 'size' => '39', 'stock_quantity' => 10, 'price_modifier' => 0],
            ['product' => 'Nike Air Max 270', 'color' => 'Trắng', 'size' => '40', 'stock_quantity' => 15, 'price_modifier' => 0],
            ['product' => 'Nike Air Max 270', 'color' => 'Đen', 'size' => '41', 'stock_quantity' => 8, 'price_modifier' => 0],

            // Adidas Ultraboost 22
            ['product' => 'Adidas Ultraboost 22', 'color' => 'Đen', 'size' => '40.5', 'stock_quantity' => 12, 'price_modifier' => 0],
            ['product' => 'Adidas Ultraboost 22', 'color' => 'Xám', 'size' => '42', 'stock_quantity' => 7, 'price_modifier' => 100000],

            // Converse Chuck Taylor All Star
            ['product' => 'Converse Chuck Taylor All Star', 'color' => 'Trắng', 'size' => '37', 'stock_quantity' => 20, 'price_modifier' => 0],
            ['product' => 'Converse Chuck Taylor All Star', 'color' => 'Đen', 'size' => '38', 'stock_quantity' => 25, 'price_modifier' => 0],

            // Timberland Premium Boot
            ['product' => 'Timberland Premium Boot', 'color' => 'Nâu', 'size' => '42', 'stock_quantity' => 5, 'price_modifier' => 0],
        ];

        foreach ($variants as $variant) {
            $productId = $products[$variant['product']] ?? null;
            if ($productId) {
                DB::table('product_variants')->insert([
                    'product_id' => $productId,
                    'color' => $variant['color'],
                    'size' => $variant['size'],
                    'stock_quantity' => $variant['stock_quantity'],
                    'price_modifier' => $variant['price_modifier'],
                    'image_url_specific' => null
                ]);
            }
        }
    }
}
