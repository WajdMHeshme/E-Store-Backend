<?php

use App\Http\Controllers\API\V1\Category\CategoryController;
use Illuminate\Support\Facades\Route;

Route::prefix('categories')->middleware(['auth:sanctum' , 'custom.rate:1,10'])->group(function () {
    Route::get('/', [CategoryController::class, 'index']);
    // Get all categories
    Route::get('/{id}', [CategoryController::class, 'show']);
    // Get single category
    Route::post('/', [CategoryController::class, 'store']);
    // Create category
    Route::put('/{id}', [CategoryController::class, 'update']);
    // Update category
    Route::delete('/{id}', [CategoryController::class, 'destroy']);
    // Delete category
});
