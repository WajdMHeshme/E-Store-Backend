<?php

use App\Http\Controllers\API\V1\Auth\AuthController;
use Illuminate\Support\Facades\Route;

// مجموعة راوتات الـ Auth مع Rate Limiting
Route::prefix('auth')->group(function () {

    // تسجيل الدخول - محدود 5 مرات بالدقيقة لكل IP
    Route::post('/login', [AuthController::class, 'login'])
        ->middleware('custom.rate:1,5');

    // التسجيل - محدود 3 مرات بالدقيقة لكل IP (لتجنب spam)
    Route::post('/register', [AuthController::class, 'register'])
        ->middleware('custom.rate:1,3');

    // تسجيل الخروج - محدود 10 مرات بالدقيقة لكل مستخدم مسجل
    Route::post('/logout', [AuthController::class, 'logout'])
        ->middleware(['auth:sanctum', 'custom.rate:1,5']);
});
