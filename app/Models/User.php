<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users'; // có thể bỏ nếu đúng tên

    protected $primaryKey = 'user_id'; // vì bạn dùng user_id làm khóa chính
    public $timestamps = false; // vì không có created_at, updated_at

    protected $fillable = [
        'username',
        'email',
        'password_hash',
        'first_name',
        'last_name',
        'phone_number',
        'role',
    ];

    protected $hidden = [
        'password_hash',
    ];

    /**
     * Laravel sẽ gọi phương thức này để xác thực mật khẩu.
     * Mặc định nó dùng 'password', nhưng bạn đang dùng 'password_hash'.
     */
    public function getAuthPassword()
    {
        return $this->password_hash;
    }
}
