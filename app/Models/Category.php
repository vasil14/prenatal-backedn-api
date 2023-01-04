<?php

namespace App\Models;

use App\Models\Product;
use App\Utilities\FilterBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['_id', 'name', 'parent_id'];


    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_category')->withTimestamps();
    }


    public function scopeFilterBy($query, $filters)
    {
        $namespace = 'App\Utilities\CategoryFilters';
        $filter = new FilterBuilder($query, $filters, $namespace);

        return $filter->apply();
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', '_id')->with('children');
    }
}
