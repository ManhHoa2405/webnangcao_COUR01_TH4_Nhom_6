<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\UserAddress;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Trỏ về đúng bảng 'user'
    protected $table = 'user';

    // Cho phép fill dữ liệu hàng loạt
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'userAddress_id',
        'role',
    ];

    public function address()
    {
        return $this->hasOne(UserAddress::class, 'user_id');
    }

    // Ẩn các trường khi trả về JSON
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Cast dữ liệu
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
