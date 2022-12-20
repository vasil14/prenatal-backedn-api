<?php

namespace App\Models;

use App\Models\Category;
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
}
