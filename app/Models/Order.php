<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $table = 'Orders';
    protected $fillable = ['user_id', 'total_amount', 'status','note'];

    public function details()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'order_id');
    }

    public function user() {
    return $this->belongsTo(User::class);
}

}
