<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function subCategories($name)
    {
        $categories = Category::where('name', 'like', $name)
            ->with('children')
            ->whereNull('parent_id')
            ->get();

        return response()->json($categories);
    }
}
