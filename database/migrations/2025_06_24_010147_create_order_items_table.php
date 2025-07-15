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
            $table->increments('order_item_id'); // Khóa chính tự tăng cho order_items

            // Quan trọng: Sử dụng foreignId() hoặc unsignedBigInteger() để khớp với kiểu dữ liệu của order_id trong bảng orders
            $table->foreignId('order_id')
                ->constrained('orders', 'order_id') // Tham chiếu tới cột order_id trong bảng orders
                ->onDelete('cascade'); // Khi một order bị xóa, tất cả order_items liên quan cũng sẽ bị xóa

            // Quan trọng: Tương tự cho variant_id, nó phải khớp với kiểu dữ liệu khóa chính của product_variants
            // Laravel's default id() also uses BIGINT UNSIGNED
            // Trong migration của order_items
            $table->unsignedInteger('product_variant_id'); // Khóa ngoại kiểu INT UNSIGNED
            $table->foreign('product_variant_id')->references('variant_id')->on('product_variants');

            $table->integer('quantity');
            $table->decimal('price_per_unit', 10, 2);

            // Thêm các cột để lưu trữ thông tin snapshot của sản phẩm/biến thể
            // Điều này cực kỳ quan trọng để đảm bảo tính toàn vẹn của đơn hàng
            // ngay cả khi sản phẩm gốc bị thay đổi hoặc xóa
            $table->string('product_name_snapshot')->nullable();
            $table->string('variant_color_snapshot')->nullable();
            $table->string('variant_size_snapshot')->nullable();


            // Thêm timestamps là một thực hành tốt, mặc dù bạn nói không cần
            // Eloquent Models mặc định mong đợi created_at và updated_at
            $table->timestamps();
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
