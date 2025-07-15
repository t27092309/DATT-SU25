<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $primaryKey = 'order_item_id'; // Khai báo khóa chính nếu không phải 'id'

    protected $fillable = [
        'order_id',
        'product_variant_id',
        'quantity',
        'price_per_unit', // Tên cột giá trong order_items
        'product_name_snapshot',
        'variant_color_snapshot',
        'variant_size_snapshot',
    ];

    // Mối quan hệ với Order
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }

    // Mối quan hệ với ProductVariant
    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id', 'variant_id');
    }
}