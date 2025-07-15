<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Tên bảng nếu khác với tên số nhiều của model (mặc định là 'categories', trùng với bạn)
    protected $table = 'categories';

    // Định nghĩa khóa chính nếu nó không phải là 'id'
    protected $primaryKey = 'category_id'; // <-- REMOVED THE EXTRA COMMA HERE!

    // Tắt timestamps nếu bảng không có cột `created_at` và `updated_at`
    // Based on your CategorySeeder, you ARE inserting created_at and updated_at.
    // If your categories table *does* have these columns, then you should set this to true (or remove the line as true is default).
    // If your categories table *does NOT* have these columns, then false is correct.
    public $timestamps = true; // <-- Changed to true, assuming your table has timestamps from the seeder

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
    ];

    /**
     * Get the route key for the model.
     * This is for Route Model Binding by slug.
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        // No casting defined, which is fine if you don't need any special type conversions.
    ];

    /**
     * A Category has many Products.
     * Define the relationship with products.
     */
    public function products()
    {
        // Tell Laravel:
        // 1. The related model is Product::class.
        // 2. The foreign key on the 'products' table is 'category_id'.
        // 3. The local key on *this* 'categories' table (which the foreign key refers to) is 'category_id'.
        return $this->hasMany(Product::class, 'category_id', 'category_id');
    }
}