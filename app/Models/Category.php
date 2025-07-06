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
    protected $primaryKey = 'category_id';

    // Tắt timestamps nếu bảng không có cột `created_at` và `updated_at`
    public $timestamps = false; // Bảng categories của bạn không có timestamps

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', // Cho phép gán giá trị hàng loạt cho cột 'name'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        // Nếu bạn có các trường cần ép kiểu (ví dụ: boolean, datetime), hãy định nghĩa ở đây
    ];
}