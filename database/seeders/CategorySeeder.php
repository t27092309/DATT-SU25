<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; // Don't forget to import the Str facade

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Giày Thể Thao',
            'Giày Chạy Bộ',
            'Giày Bốt',
            'Giày Sneaker',
            'Giày Nam',
            'Giày Nữ',
            'Giày Trẻ Em',
            'Giày Công Sở',
        ];

        foreach ($categories as $categoryName) {
            DB::table('categories')->insert([
                'name' => $categoryName,
                'slug' => Str::slug($categoryName), // Generate slug from the category name
            ]);
        }
    }
}