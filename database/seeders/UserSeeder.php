<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'username' => 'john.doe',
                'password' => Hash::make('password123'),
                'email' => 'john.doe@example.com',
                'first_name' => 'John',
                'last_name' => 'Doe',
                'phone_number' => '0901234567',
                'role' => 'customer',
                'created_at' => Carbon::now()->subMonths(6), // Changed from registration_date
                'updated_at' => Carbon::now()->subMonths(6), // Add this too for consistency
                'email_verified_at' => Carbon::now()->subMonths(6), // If you have this column
            ],
            [
                'username' => 'jane.smith',
                'password' => Hash::make('password456'),
                'email' => 'jane.smith@example.com',
                'first_name' => 'Jane',
                'last_name' => 'Smith',
                'phone_number' => '0907654321',
                'role' => 'customer',
                'created_at' => Carbon::now()->subMonths(3), // Changed from registration_date
                'updated_at' => Carbon::now()->subMonths(3), // Add this too
                'email_verified_at' => Carbon::now()->subMonths(3),
            ],
            [
                'username' => 'superadmin',
                'password' => Hash::make('adminpassword'),
                'email' => 'admin@example.com',
                'first_name' => 'Admin',
                'last_name' => 'Toàn Quyền',
                'phone_number' => '0987654321',
                'role' => 'super_admin',
                'created_at' => Carbon::now(), // Changed from registration_date
                'updated_at' => Carbon::now(), // Add this too
                'email_verified_at' => Carbon::now(),
            ],
            [
                'username' => 'product_manager',
                'password' => Hash::make('managerpass'),
                'email' => 'manager@example.com',
                'first_name' => 'Quản lý',
                'last_name' => 'Sản phẩm',
                'phone_number' => '0912345678',
                'role' => 'product_manager',
                'created_at' => Carbon::now(), // Changed from registration_date
                'updated_at' => Carbon::now(), // Add this too
                'email_verified_at' => Carbon::now(),
            ],
        ]);
    }
}