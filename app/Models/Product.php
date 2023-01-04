<?php

namespace App\Models;


use App\Models\Gallery;
use App\Models\Category;
use App\Utilities\FilterBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'mpn', 'price', 'sale_price', 'vip_price', 'stock', 'availability', 'taglia', 'parent_id', 'title', 'description', 'link', 'image_link', 'product_type', 'eta', 'marche', 'genere', 'personaggi', 'colore'];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_category')->withTimestamps();
    }

    public function images()
    {
        return $this->hasMany(Gallery::class);
    }


    public function scopeFilterBy($query, $filters)
    {
        $namespace = 'App\Utilities\ProductFilters';
        $filter = new FilterBuilder($query, $filters, $namespace);

        return $filter->apply();
    }
}
