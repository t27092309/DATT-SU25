<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => 'Giày Thể Thao'],
            ['name' => 'Giày Chạy Bộ'],
            ['name' => 'Giày Bốt'],
            ['name' => 'Giày Sneaker'],
            ['name' => 'Giày Nam'],
            ['name' => 'Giày Nữ'],
            ['name' => 'Giày Trẻ Em'],
            ['name' => 'Giày Công Sở'],
        ]);
    }
}