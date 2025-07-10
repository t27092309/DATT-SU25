<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Có thể cần nếu bạn dùng Factory
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // use HasFactory; // Bỏ comment nếu bạn muốn sử dụng model factories

    // Nếu tên bảng không phải là 'orders' (ví dụ: 'my_orders'), bạn cần chỉ định:
    // protected $table = 'my_orders';

    // Nếu khóa chính không phải là 'id' (ví dụ: 'order_id'), bạn cần chỉ định:
    protected $primaryKey = 'order_id'; // Quan trọng: Đảm bảo khớp với tên cột trong migration

    // Các thuộc tính có thể được gán hàng loạt (mass assignable)
    protected $fillable = [
        'user_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'shipping_address',
        'total_amount',
        'status',
        'notes', // Nếu bạn quyết định dùng trường này
        'payment_method', // Nếu bạn quyết định dùng trường này
    ];

    // Các thuộc tính nên được ẩn khi chuyển đổi sang mảng/JSON (ví dụ: password)
    // protected $hidden = [];

    // Các thuộc tính nên được chuyển đổi sang kiểu dữ liệu cụ thể
    // protected $casts = [];


    /**
     * Get the user that owns the order.
     * Đây là mối quan hệ nếu bạn liên kết đơn hàng với người dùng đã đăng nhập.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id'); // 'id' là khóa chính của bảng users
    }

    /**
     * Get the order items for the order.
     * Đây là mối quan hệ 1-nhiều với OrderItem.
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'order_id'); // 'order_id' là khóa ngoại trong order_items trỏ tới khóa chính của orders
    }
}