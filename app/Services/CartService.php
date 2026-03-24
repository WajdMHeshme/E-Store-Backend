<?php

namespace App\Services;

use App\Repositories\Contracts\CartRepositoryInterface;
use App\Exceptions\ResourceNotFoundException;

class CartService
{
    public function __construct(private CartRepositoryInterface $cartRepository){}

    // جلب السلة
    public function getCart($userId)
    {
        $cart = $this->cartRepository->getUserCart($userId);

        if (!$cart) {
            throw new ResourceNotFoundException('Cart for this user');
        }

        return $cart;
    }

    // إضافة عنصر للسلة
    public function addToCart($userId, $productId, $quantity)
    {
        $cart = $this->cartRepository->getUserCart($userId);

        if (!$cart) {
            $cart = $this->cartRepository->createCart($userId);

            if (!$cart) {
                throw new \Exception('Failed to create cart');
            }
        }

        $item = $this->cartRepository->findItem($cart->id, $productId);

        if ($item) {
            $newQuantity = $item->quantity + $quantity;
            $updated = $this->cartRepository->updateItem($item, $newQuantity);

            if (!$updated) {
                throw new \Exception('Failed to update cart item');
            }

            return $updated;
        }

        $added = $this->cartRepository->addItem($cart->id, $productId, $quantity);

        if (!$added) {
            throw new \Exception('Failed to add item to cart');
        }

        return $added;
    }

    // إزالة عنصر من السلة
    public function removeItem($userId, $productId)
    {
        $cart = $this->cartRepository->getUserCart($userId);

        if (!$cart) {
            throw new ResourceNotFoundException('Cart for this user');
        }

        $removed = $this->cartRepository->removeItem($cart->id, $productId);

        if (!$removed) {
            throw new ResourceNotFoundException('Cart item not found');
        }

        return $removed;
    }

    // تفريغ السلة
    public function clearCart($userId)
    {
        $cart = $this->cartRepository->getUserCart($userId);

        if (!$cart) {
            throw new ResourceNotFoundException('Cart for this user');
        }

        $cleared = $this->cartRepository->clearCart($cart->id);

        if (!$cleared) {
            throw new \Exception('Failed to clear cart');
        }

        return $cleared;
    }
}
