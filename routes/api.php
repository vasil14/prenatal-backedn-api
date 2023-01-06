<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;

// Product routes
Route::group(['prefix' => 'v1'], function () {
    Route::apiResource('products', ProductController::class);
});


Route::get('/v1/products/categoria-prodotto/{name}', [ProductController::class, 'category']);
Route::get('/v1/products/filter', [ProductController::class, 'filter']);


// Category routes
Route::get('/category', [CategoryController::class, 'index']);
Route::get('/categories', [CategoryController::class, 'getCategories']);


// User routes
Route::post('/user', [UserController::class, 'store']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);
