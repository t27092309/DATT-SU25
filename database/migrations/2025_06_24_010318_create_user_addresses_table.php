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
            // Thay thế: $table->increments('address_id');
            // Bằng:
            $table->id('address_id'); // Khóa chính sẽ là BIGINT UNSIGNED (chuẩn Laravel)
                                      // Hoặc $table->bigIncrements('address_id');

            // Thay thế: $table->unsignedInteger('user_id'); // Khóa ngoại
            // Và: $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            // Bằng cách sử dụng foreignId() helper:
            $table->foreignId('user_id') // Sẽ tạo cột user_id kiểu BIGINT UNSIGNED
                  ->constrained('users') // Laravel mặc định sẽ tham chiếu đến cột 'id' trong bảng 'users'
                  ->onDelete('cascade'); // Khi một user bị xóa, các địa chỉ của user đó cũng sẽ bị xóa.

            $table->string('address_line_1', 255);
            $table->string('address_line_2', 255)->nullable();
            $table->string('city', 100);
            $table->string('district', 100);
            $table->string('province', 100);
            $table->string('postal_code', 20)->nullable();
            $table->string('country', 100);
            $table->boolean('is_default')->default(false);
            $table->timestamps();
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