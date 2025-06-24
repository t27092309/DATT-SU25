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
            $table->increments('user_id'); // Khóa chính tự tăng
            $table->string('username', 100)->unique();
            $table->string('password_hash');
            $table->string('email', 255)->unique();
            $table->string('first_name', 100)->nullable();
            $table->string('last_name', 100)->nullable();
            $table->string('phone_number', 20)->nullable();
            $table->string('role', 50)->default('customer'); // Thêm cột role, mặc định là 'customer'
            $table->timestamp('registration_date')->useCurrent();
            // $table->rememberToken(); // Thêm nếu bạn muốn dùng chức năng "remember me"
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