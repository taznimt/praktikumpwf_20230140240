<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// route default sanctum
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// login untuk mendapatkan token
Route::post('/login', [AuthController::class, 'getToken']);

// product - public GET
Route::get('/v1/product', [ProductController::class, 'index']);
Route::get('/v1/product/{id}', [ProductController::class, 'show']);

// category - public GET
Route::get('/v1/category', [CategoryController::class, 'index']);
Route::get('/v1/category/{id}', [CategoryController::class, 'show']);

// route yang butuh token sanctum
Route::middleware('auth:sanctum')->group(function () {
    // product
    Route::post('/v1/product', [ProductController::class, 'store']);
    Route::put('/v1/product/{id}', [ProductController::class, 'update']);
    Route::delete('/v1/product/{id}', [ProductController::class, 'destroy']);

    // category
    Route::post('/v1/category', [CategoryController::class, 'store']);
    Route::put('/v1/category/{id}', [CategoryController::class, 'update']);
    Route::delete('/v1/category/{id}', [CategoryController::class, 'destroy']);
});