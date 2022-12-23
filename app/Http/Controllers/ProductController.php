<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;

class ProductController extends Controller
{
    public function index()
    {

        // return Product::all()->take(12);
        $products = Product::whereRaw('id = parent_id')
            ->whereHas('categories', function ($q) {
                $q->where([
                    ['name', '=', 'MAMMA'],
                ]);
            })->with('images')
            ->get();

        return $products;
    }

    public function show($id)
    {
        $product = Product::where('id', $id)->with('images')->get();
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
