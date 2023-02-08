<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;



class ProductController extends Controller
{
    public function index()
    {

        return Product::where('parent_id', 0)->filterBy(request()->all())->with('children')->take(10)->get();
    }

    public function show($id)
    {

        $product = Product::where('id', $id)->with('children')->with('images')->get();
        return $product;
    }

    public function productCategory($name)
    {
        $products = Product::where('parent_id', 0)
            ->whereHas('categories', function ($q) use ($name) {
                $q->where('name', '=', $name);
            })->filterBy(request()->all())
            ->with('children')
            ->with('images')
            ->paginate(12);

        $category = Category::where('name', $name)
            ->with('colors')
            ->get();


        return ['products' => $products, 'category' => $category];
    }
}
