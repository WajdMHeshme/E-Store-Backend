<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

// Apply CORS middleware to all API routes
Route::middleware('api',)->group(function (): void {
    require_once __DIR__ . '/api_auth_routes.php';
    require_once __DIR__ . '/api_category_routes.php';
    require_once __DIR__ . '/api_products_routes.php';
});
