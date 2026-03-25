<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\Product\ProductController;

Route::prefix('products')->middleware(['auth:sanctum' , 'admin', 'custom.rate:1,20'])->group(function () {

    Route::get('/', [ProductController::class, 'index']);
    // Get all products
    Route::get('/{id}', [ProductController::class, 'show']);
    // Get single product
    Route::post('/', [ProductController::class, 'store']);
    // Create product
    Route::put('/{id}', [ProductController::class, 'update']);
    // Update product
    Route::delete('/{id}', [ProductController::class, 'destroy']);
    // Delete product

});
