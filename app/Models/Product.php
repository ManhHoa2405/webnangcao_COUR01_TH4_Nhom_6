<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'Products';

    // Cho phép gán dữ liệu hàng loạt
     protected $fillable = [
        'name', 'price', 'qualityStock', 'category', 'image_url', 'status'
    ];

    // Một product có thể nằm trong nhiều cart
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function menu()
{
    return $this->belongsTo(Menu::class, 'menu_id');
}
}
