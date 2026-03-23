<?php

namespace App\Repositories\Eloquent;

use App\Models\Cart;
use App\Models\CartItems;
use App\Repositories\Contracts\CartRepositoryInterface;

class CartRepository implements CartRepositoryInterface
{

    public function getUserCart($userId)
    {
        return Cart::with('items.product')
            ->where('user_id', $userId)
            ->first();
    }

    public function createCart($userId)
    {
        return Cart::create([
            'user_id' => $userId
        ]);
    }

    public function findItem($cartId, $productId)
    {
        return CartItems::where('cart_id', $cartId)
            ->where('product_id', $productId)
            ->first();
    }

    public function addItem($cartId, $productId, $quantity)
    {
        return CartItems::create([
            'cart_id' => $cartId,
            'product_id' => $productId,
            'quantity' => $quantity
        ]);
    }

    public function updateItem($item, $quantity)
    {
        $item->update([
            'quantity' => $quantity
        ]);

        return $item;
    }

    public function removeItem($cartId, $productId)
    {
        return CartItems::where('cart_id', $cartId)
            ->where('product_id', $productId)
            ->delete();
    }

    public function clearCart($cartId)
    {
        return CartItems::where('cart_id', $cartId)->delete();
    }
}
