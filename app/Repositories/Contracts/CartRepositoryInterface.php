<?php

namespace App\Repositories\Contracts;

interface CartRepositoryInterface
{
    public function getUserCart($userId);

    public function createCart($userId);

    public function findItem($cartId, $productId);

    public function addItem($cartId, $productId, $quantity);

    public function updateItem($item, $quantity);

    public function removeItem($cartId, $productId);

    public function clearCart($cartId);
}
