<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function category()
    {
        return $this->belongsTo(category::class);
    }

    public function productColors()
    {
        return $this->hasMany(ProductColor::class);
    }
    public function details()
    {
        return $this->hasOne(ProductDetails::class);
    }

    public function galeries()
    {
        return $this->hasMany(ProductGalery::class);
    }

    public function options()
    {
        return $this->hasMany(ProductOption::class);
    }

    public function colors()
    {
        return $this->hasMany(ProductColor::class);
    }
}
