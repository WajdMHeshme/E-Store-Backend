<?php

use App\Http\Controllers\API\V1\Order\OrderController;
use Illuminate\Support\Facades\Route;

Route::prefix('orders')->middleware('auth:sanctum')->group(function () {
    // Index orders - 20 requests/min per user
    Route::get('/', [OrderController::class, 'index'])->middleware('custom.rate:1,20');

    // Create order - 10 requests/min per user
    Route::post('/', [OrderController::class, 'store'])->middleware('custom.rate:1,10');

    // Show specific order - 20 requests/min per user
    Route::get('/{id}', [OrderController::class, 'show'])->middleware('custom.rate:1,20');

    // Update order - 5 requests/min per user
    Route::put('/{id}', [OrderController::class, 'update'])->middleware('custom.rate:1,5');

    // Delete order - 5 requests/min per user
    Route::delete('/{id}', [OrderController::class, 'destroy'])->middleware('custom.rate:1,5');
});
