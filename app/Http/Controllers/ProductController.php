<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
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
            })
            ->get();

        return $products;
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
