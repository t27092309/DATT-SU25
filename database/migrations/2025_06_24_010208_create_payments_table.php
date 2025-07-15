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
            // Thay thế: $table->increments('payment_id');
            // Bằng:
            $table->id('payment_id'); // Khóa chính sẽ là BIGINT UNSIGNED (chuẩn Laravel)
                                      // Hoặc $table->bigIncrements('payment_id');

            // Thay thế: $table->unsignedInteger('order_id');
            // Bằng:
            $table->foreignId('order_id') // Khóa ngoại sẽ là BIGINT UNSIGNED
                  ->constrained('orders', 'order_id') // Tham chiếu tới cột 'order_id' trong bảng 'orders'
                  ->onDelete('cascade'); // Tùy chọn: Khi một order bị xóa, các payment liên quan cũng sẽ bị xóa.
                                          // Hoặc onUpdate/onDelete khác tùy logic nghiệp vụ của bạn.

            $table->string('transaction_id')->unique()->nullable(); // ID giao dịch từ cổng thanh toán
            $table->decimal('amount', 10, 2);
            $table->timestamp('payment_date')->useCurrent(); // Thời điểm thanh toán
            $table->string('payment_status'); // Ví dụ: 'Success', 'Failed', 'Pending'
            $table->text('payment_method_details')->nullable(); // Chi tiết phương thức thanh toán (JSON/text)

            // Khuyến nghị: Thêm timestamps cho bảng payments để theo dõi thời gian tạo/cập nhật
            $table->timestamps();
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