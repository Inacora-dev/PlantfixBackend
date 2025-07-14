<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderPlant extends Model
{
    protected $table = 'order_plant';

    protected $fillable = [
        'order_id',
        'plant_id',
        'quantity',
        'price',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function plant()
    {
        return $this->belongsTo(Plant::class);
    }
}
