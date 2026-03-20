<?php

namespace App\Http\Controllers\API\V1\User;

use Illuminate\Support\Facades\Route;

Route::prefix('users')->middleware('auth:sanctum', 'admin')->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::post('/', [UserController::class, 'store']);
    Route::put('/{id}', [UserController::class, 'update']);
    Route::delete('/{id}', [UserController::class, 'destroy']);
});
