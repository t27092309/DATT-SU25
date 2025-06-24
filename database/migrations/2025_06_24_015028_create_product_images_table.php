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
        Schema::create('product_images', function (Blueprint $table) {
            $table->increments('image_id'); // Khóa chính
            $table->unsignedInteger('product_id'); // Khóa ngoại liên kết với bảng products
            $table->string('image_url'); // Đường dẫn URL của hình ảnh
            $table->string('alt_text')->nullable(); // Văn bản thay thế cho hình ảnh (SEO)
            $table->integer('order')->default(0); // Thứ tự hiển thị của hình ảnh
            $table->boolean('is_thumbnail')->default(false); // Đánh dấu ảnh đại diện
            $table->timestamps(); // created_at, updated_at

            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_images');
    }
};