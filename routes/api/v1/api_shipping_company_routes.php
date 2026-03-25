<?php

use App\Http\Controllers\API\V1\ShippingCompany\ShippingCompanyController;
use Illuminate\Support\Facades\Route;

Route::prefix('shipping-companies')->middleware(['auth:sanctum', 'admin' , 'custom.rate:1,10'])->group(function () {
    Route::get('/', [ShippingCompanyController::class, 'index']);
    Route::get('/{id}', [ShippingCompanyController::class, 'show']);
    Route::post('/', [ShippingCompanyController::class, 'store']);
    Route::put('/{id}', [ShippingCompanyController::class, 'update']);
    Route::delete('/{id}', [ShippingCompanyController::class, 'destroy']);
});
