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
        Schema::create('products', function (Blueprint $table) {
            $table->increments('product_id'); // Khóa chính tự tăng
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('brand')->nullable();
            $table->unsignedInteger('category_id'); // Khóa ngoại, không dấu để liên kết với category_id
            $table->integer('sold_quantity')->default(0);
            $table->decimal('sale_price', 10, 2)->nullable();
            $table->decimal('base_price', 10, 2);
            $table->string('image_url')->nullable();
            $table->timestamps(); // Tạo cột created_at và updated_at

            $table->foreign('category_id')->references('category_id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
