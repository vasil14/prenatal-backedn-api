<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Colore extends Model
{
    use HasFactory;

    protected $fillable = ['name'];


    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_colors', 'category_id', 'colore_id');
    }
}
