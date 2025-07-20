<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plant extends Model
{
    protected $fillable = [
        'name',
        'price',
        'description',
        'stock',
        'image_url',
        'plant_family_id',
    ];
     
    public function plantFamily()
    {
        return $this->belongsTo(PlantFamily::class, 'plant_family_id');
    }
    
    public function orders() {
        return $this->belongsToMany(Order::class)->withPivot('quantity', 'price');
    }
}
