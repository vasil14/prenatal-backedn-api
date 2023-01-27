<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

use App\Http\Requests\StoreProductRequest;

class ProductController extends Controller
{

    public function filter()
    {
        $products =  Product::whereRaw('id = parent_id')->filterBy(request()->all())->paginate(20);
        return $products;
    }


    public function category($name)
    {
        $products = Product::whereRaw('id = parent_id')
            ->filterBy(request()->all())
            ->whereHas('categories', function ($q) use ($name) {
                $q->where('name', 'like', '%' . $name . '%');
            })->with('images')->paginate(12);

        return $products;
    }

    public function subCategory($catName, $subCat)
    {
        $products = Product::whereRaw('id = parent_id')
            ->filterBy(request()->all())
            ->whereHas('categories', function ($q) use ($catName) {
                $q->where('name', 'like', '%' . $catName . '%');
            })->whereHas('categories', function ($q) use ($subCat) {
                $q->where('name', 'like', '%' . $subCat . '%');
            })
            ->with('images')->paginate(12);

        return $products;
    }
    public function index()
    {

        return Product::whereRaw('id = parent_id')->filterBy(request()->all())->take(10)->get();
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
