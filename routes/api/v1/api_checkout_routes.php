<?php

use App\Http\Controllers\API\V1\Checkout\CheckoutController;
use Illuminate\Support\Facades\Route;

Route::prefix('checkout')->middleware(['auth:sanctum' , 'custom.rate:1,10'])->group(function () {
    Route::post('', [CheckoutController::class, 'checkout']);
});
