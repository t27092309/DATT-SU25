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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->increments('cart_item_id'); // Khóa chính tự tăng
            $table->unsignedInteger('cart_id'); // Khóa ngoại
            $table->unsignedInteger('variant_id'); // Khóa ngoại
            $table->integer('quantity')->default(1);
            $table->decimal('price_at_addition', 10, 2);
            // Không cần timestamps cho cart_items

            $table->foreign('cart_id')->references('cart_id')->on('carts')->onDelete('cascade');
            $table->foreign('variant_id')->references('variant_id')->on('product_variants')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};