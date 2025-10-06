<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    //
    protected $table = 'Order_detail';
    protected $fillable = ['order_id','product_id','product_name','product_price','quantity'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }

}
