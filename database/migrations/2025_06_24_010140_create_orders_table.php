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
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('order_id'); // Khóa chính tự tăng
            $table->unsignedInteger('user_id'); // Khóa ngoại
            $table->timestamp('order_date')->useCurrent();
            $table->decimal('total_amount', 10, 2);
            $table->text('shipping_address'); // Lưu địa chỉ đầy đủ
            $table->string('payment_method');
            $table->string('order_status'); // Ví dụ: 'Pending', 'Processing', 'Delivered'
            $table->string('tracking_number')->nullable();

            $table->foreign('user_id')->references('user_id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};