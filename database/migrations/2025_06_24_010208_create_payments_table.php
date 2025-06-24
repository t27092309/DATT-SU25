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
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('payment_id'); // Khóa chính tự tăng
            $table->unsignedInteger('order_id'); // Khóa ngoại
            $table->string('transaction_id')->unique()->nullable(); // ID giao dịch từ cổng thanh toán
            $table->decimal('amount', 10, 2);
            $table->timestamp('payment_date')->useCurrent();
            $table->string('payment_status'); // Ví dụ: 'Success', 'Failed', 'Pending'
            $table->text('payment_method_details')->nullable();

            $table->foreign('order_id')->references('order_id')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};