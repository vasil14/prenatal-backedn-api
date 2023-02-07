<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

use App\Http\Requests\StoreProductRequest;

class ProductController extends Controller
{

    public function filter()
    {
        $products =  Product::whereRaw('parent_id=0')->filterBy(request()->all())->with('children')->with()->paginate(20);
        return $products;
    }


    public function category($name)
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

        $response = [
            'products' => $products,
            'category' => $category
        ];

        return response(compact('products', 'category'));
    }


    public function index()
    {

        return Product::where('parent_id', 0)->filterBy(request()->all())->with('children')->take(10)->get();
    }

    public function show($id)
    {

        $product = Product::where('id', $id)->with('children')->with('images')->get();
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
