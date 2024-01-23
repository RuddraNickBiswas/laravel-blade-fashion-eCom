<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getSaleAttribute()
       {
           return !is_null($this->attributes['discounted_price']);
       }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    
    public function sizes()
    {
        return $this->hasMany(ProductSize::class);
    }
    public function details()
    {
        return $this->hasOne(ProductDetails::class);
    }

    public function galleries()
    {
        return $this->hasMany(ProductGallery::class);
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
