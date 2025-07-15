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
            $table->id('order_id'); // Khóa chính với tên order_id (phải khớp với $primaryKey trong model)
            $table->unsignedBigInteger('user_id');
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone', 20); // Giới hạn độ dài cho số điện thoại
            $table->string('shipping_address', 500); // Tăng độ dài cho địa chỉ
            $table->decimal('total_amount', 10, 2); // Tổng tiền của đơn hàng (10 chữ số, 2 số thập phân)
            $table->string('status')->default('pending'); // Trạng thái đơn hàng: pending, processing, completed, cancelled...
            $table->text('notes')->nullable(); // Ghi chú từ khách hàng
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps(); // created_at và updated_at
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
