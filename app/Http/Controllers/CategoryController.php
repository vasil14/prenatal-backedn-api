<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    //


    public function index()
    {
        return Category::all();
    }

    public function show($name)
    {
        $category = Category::where('name',  $name)
            ->whereHas('products', function ($q) {
                $q->where('parent_id',  0);
            })->get();

        return $category;
    }


    public function getCategories($name)
    {
        $categories = Category::where('name', 'like', $name)
            ->with('children')
            ->whereNull('parent_id')
            ->get();

        return response()->json($categories);
    }
}
