<?php

namespace App\Http\Controllers\API\V1\Cart;

use App\Http\Controllers\Controller;
use App\Services\CartService;
use App\Http\Requests\API\V1\Cart\CartItemRequest;

class CartController extends Controller
{

    public function __construct(
        private CartService $cartService
    ) {}

    public function index()
    {
        $cart = $this->cartService->getCart(auth()->id());

        return response()->json($cart);
    }

    public function add(CartItemRequest $request)
    {
        $validated = $request->validated();

        $item = $this->cartService->addToCart(
            auth()->id(),
            $validated['product_id'],
            $validated['quantity']
        );

        return response()->json($item, 201);
    }

    public function remove($productId)
    {
        $this->cartService->removeItem(
            auth()->id(),
            $productId
        );

        return response()->json([
            'message' => 'Item removed'
        ]);
    }

    public function clear()
    {
        $this->cartService->clearCart(auth()->id());

        return response()->json([
            'message' => 'Cart cleared'
        ]);
    }
}
