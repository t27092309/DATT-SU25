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
                'password_hash' => Hash::make('password123'),
                'email' => 'john.doe@example.com',
                'first_name' => 'John',
                'last_name' => 'Doe',
                'phone_number' => '0901234567',
                'role' => 'customer',
                'registration_date' => Carbon::now()->subMonths(6),
            ],
            [
                'username' => 'jane.smith',
                'password_hash' => Hash::make('password456'),
                'email' => 'jane.smith@example.com',
                'first_name' => 'Jane',
                'last_name' => 'Smith',
                'phone_number' => '0907654321',
                'role' => 'customer',
                'registration_date' => Carbon::now()->subMonths(3),
            ],
            [
                'username' => 'superadmin', // Tài khoản admin mới
                'password_hash' => Hash::make('adminpassword'),
                'email' => 'admin@example.com',
                'first_name' => 'Admin',
                'last_name' => 'Toàn Quyền',
                'phone_number' => '0987654321',
                'role' => 'super_admin', // Vai trò 'super_admin'
                'registration_date' => Carbon::now(),
            ],
            [
                'username' => 'product_manager', // Tài khoản quản lý sản phẩm
                'password_hash' => Hash::make('managerpass'),
                'email' => 'manager@example.com',
                'first_name' => 'Quản lý',
                'last_name' => 'Sản phẩm',
                'phone_number' => '0912345678',
                'role' => 'product_manager', // Vai trò 'product_manager'
                'registration_date' => Carbon::now(),
            ],
        ]);
    }
}