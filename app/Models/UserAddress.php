<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserAddress extends Model
{
    //
    use HasFactory;

    protected $table = 'useraddress';

    protected $fillable = [
        'user_id',
        'homeAddress',
        'province_id',
        'district_id',
        'ward_id',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

}
