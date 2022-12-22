<?php

namespace App\Models;

use App\Models\Product;
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
}
