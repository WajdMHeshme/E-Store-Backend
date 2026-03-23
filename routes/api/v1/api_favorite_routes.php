<?php

use App\Http\Controllers\API\V1\Favorites\FavoriteController;
use Illuminate\Support\Facades\Route;

Route::prefix('favorites')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [FavoriteController::class, 'index']);
    Route::post('/', [FavoriteController::class, 'store']);
    Route::delete('/{id}', [FavoriteController::class, 'destroy']);
});
