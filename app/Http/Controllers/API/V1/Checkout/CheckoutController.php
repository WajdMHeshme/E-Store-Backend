<?php

namespace App\Http\Controllers\API\V1\Checkout;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\Checkout\CheckoutRequest;
use App\Http\Resources\OrderResource;
use App\Services\CheckoutService;

class CheckoutController extends Controller
{
    public function __construct(
        private CheckoutService $checkoutService
    ) {}

    public function checkout(CheckoutRequest $request)
    {
        $order = $this->checkoutService->checkout(
            auth()->id(),
            $request->validated()
        );

        return new OrderResource($order);
    }
}
