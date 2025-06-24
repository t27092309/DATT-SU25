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
        Schema::create('product_variants', function (Blueprint $table) {
            $table->increments('variant_id'); // Khóa chính tự tăng
            $table->unsignedInteger('product_id'); // Khóa ngoại
            $table->string('color');
            $table->string('size'); // Hoặc $table->decimal('size', 4, 1); nếu bạn dùng số thập phân
            $table->integer('stock_quantity')->default(0);
            $table->decimal('price_modifier', 10, 2)->default(0.00);
            $table->string('image_url_specific')->nullable();
            // Không cần timestamps cho biến thể vì nó phụ thuộc vào product_id

            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};