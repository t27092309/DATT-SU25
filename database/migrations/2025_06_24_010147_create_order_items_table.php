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
        Schema::create('order_items', function (Blueprint $table) {
            $table->increments('order_item_id'); // Khóa chính tự tăng
            $table->unsignedInteger('order_id'); // Khóa ngoại
            $table->unsignedInteger('variant_id'); // Khóa ngoại
            $table->integer('quantity');
            $table->decimal('price_per_unit', 10, 2);
            // Không cần timestamps cho order_items

            $table->foreign('order_id')->references('order_id')->on('orders')->onDelete('cascade');
            $table->foreign('variant_id')->references('variant_id')->on('product_variants');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};