<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'Orders'; // bảng thực tế là Orders

    protected $fillable = ['user_id', 'product_id', 'quantity', 'total_amount', 'status'];

    // Một cart thuộc về user
    public function user() {
        return $this->belongsTo(User::class);
    }

    // Một cart chứa product
    public function product() {
        return $this->belongsTo(Product::class);
    }
}
