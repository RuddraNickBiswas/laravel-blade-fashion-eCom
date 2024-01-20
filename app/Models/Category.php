<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function category_groups()
    {
        return $this->belongsToMany(CategoryGroup::class);;
    }

    public function scopeWithoutParent($query)
    {
        return $query->whereNull('parent_id');
    }
}
