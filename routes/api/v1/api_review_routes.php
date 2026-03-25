<?php

use App\Http\Controllers\API\V1\Review\ReviewController;
use Illuminate\Support\Facades\Route;


Route::prefix('reviews')->middleware(['auth:sanctum' , 'custom.rate:1,10'])->group(function () {

        Route::get('/products/{product}', [ReviewController::class, 'index']);

        Route::post('/', [ReviewController::class, 'store']);

        Route::put('/{id}', [ReviewController::class, 'update']);

        Route::delete('/{id}', [ReviewController::class, 'destroy']);
    });
