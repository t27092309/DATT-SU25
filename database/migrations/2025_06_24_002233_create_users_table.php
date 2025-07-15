<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Laravel's default 'id' column (BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY)
            // Hoặc nếu bạn muốn rõ ràng tên là 'id' như cũ, thì vẫn là: $table->id('id');

            $table->string('name')->nullable(); // Thêm cột name để tương thích với Auth::user()->name
            // Hoặc bạn có thể sử dụng first_name và last_name để tạo tên đầy đủ
            $table->string('username', 100)->unique();
            $table->string('password'); // Laravel's default password column for hashing
            $table->string('email', 255)->unique();
            $table->string('first_name', 100)->nullable();
            $table->string('last_name', 100)->nullable();
            $table->string('phone_number', 20)->nullable();
            $table->string('role', 50)->default('customer'); // Thêm cột role, mặc định là 'customer'

            $table->timestamp('email_verified_at')->nullable(); // Cần cho tính năng xác minh email
            $table->rememberToken(); // Cần cho chức năng "remember me"
            $table->timestamps(); // **Quan trọng:** Thêm created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};