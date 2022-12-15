<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


Route::group(['prefix' => 'v1'], function () {
    Route::apiResource('products', ProductController::class);
});
