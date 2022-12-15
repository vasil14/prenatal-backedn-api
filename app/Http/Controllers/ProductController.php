<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json("Products Index");
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => 'required',
            'color' => 'required'
        ]);

        Product::create($formFields);
        return response()->json('Product Created');
    }
}
