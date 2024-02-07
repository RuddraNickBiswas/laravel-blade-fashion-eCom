<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function user() {
        return $this->belongsTo(User::class);
    }
    public function orderProducts() {
        return $this->hasMany(OrderProduct::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'delivery_city_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'delivery_city_id')
                    ->via('city');
    }

}
