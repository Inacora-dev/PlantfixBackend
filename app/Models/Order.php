<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'order_date',
        'status',
        'total_price',
        'address',
        'city',
        'country',
        'phone_number',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
    
    public function plants() {
        return $this->belongsToMany(Plant::class)->withPivot('quantity', 'price');
    }    
}
