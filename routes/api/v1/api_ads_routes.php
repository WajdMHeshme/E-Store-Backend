<?php

use App\Http\Controllers\API\V1\Ads\AdsController;
use Illuminate\Support\Facades\Route;

Route::prefix('ads')->middleware('auth:sanctum', 'admin')->group(function () {
    Route::get('/', [AdsController::class, 'index']);
    Route::post('/', [AdsController::class, 'store']);
    Route::get('/{id}', [AdsController::class, 'show']);
    Route::put('/{id}', [AdsController::class, 'update']);
    Route::delete('/{id}', [AdsController::class, 'destroy']);
});
