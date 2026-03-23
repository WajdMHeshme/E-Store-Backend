<?php

use App\Http\Controllers\API\V1\Cart\CartController;
use Illuminate\Support\Facades\Route;

Route::prefix('cart')->middleware('auth:sanctum')->group(function () {

    Route::get('/', [CartController::class,'index']);

    Route::post('/add', [CartController::class,'add']);

    Route::delete('/remove/{productId}', [CartController::class,'remove']);

    Route::delete('/clear', [CartController::class,'clear']);

});
