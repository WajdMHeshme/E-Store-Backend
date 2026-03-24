<?php

use App\Http\Controllers\API\V1\Checkout\CheckoutController;
use Illuminate\Support\Facades\Route;

Route::prefix('checkout')->middleware('auth:sanctum')->group(function () {
    Route::post('', [CheckoutController::class, 'checkout']);
});
