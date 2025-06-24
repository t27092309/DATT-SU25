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
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->increments('address_id'); // Khóa chính tự tăng
            $table->unsignedInteger('user_id'); // Khóa ngoại liên kết với bảng Users
            $table->string('address_line_1', 255);
            $table->string('address_line_2', 255)->nullable();
            $table->string('city', 100);
            $table->string('district', 100);
            $table->string('province', 100);
            $table->string('postal_code', 20)->nullable(); // Mã bưu điện
            $table->string('country', 100);
            $table->boolean('is_default')->default(false); // Đánh dấu địa chỉ mặc định
            $table->timestamps(); // created_at, updated_at

            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_addresses');
    }
};