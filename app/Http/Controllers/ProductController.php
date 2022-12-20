<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {

        // return Product::all()->take(12);
        // return Product::where('id', '21292')->whereHas('categories')->with('categories')->get();

        $categories = Category::where('name', 'MAMMA')->whereHas('products')->with('products')->get();

        foreach ($categories as $category) {
            return $category->products;
        }
        // return $categories;

        // return Product::whereHas('categories')
        //     ->with([
        //         'categories' => function ($query) {
        //             $query->where('name', 'like', 'MAMMA');
        //         }
        //     ])->get();


        // return Category::where('name', 'MAMMA')->get();

        // return Product::has('categorys', '=', "MAMMA");

    }

    public function show(Product $product)
    {
        return $product;
    }

    public function store(StoreProductRequest $request)
    {

        Product::create($request->validated());
        return response()->json('Product Created!');
    }

    public function update(StoreProductRequest $request, Product $product)
    {

        $product->update($request->validated());
        return response()->json('Product Updated!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json('Product Deleted!');
    }
}
