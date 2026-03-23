<?php

namespace App\Services;

use App\Repositories\Contracts\CartRepositoryInterface;

class CartService
{
    public function __construct(
        private CartRepositoryInterface $cartRepository
    ){}

    public function getCart($userId)
    {
        return $this->cartRepository->getUserCart($userId);
    }

    public function addToCart($userId,$productId,$quantity)
    {

        $cart = $this->cartRepository->getUserCart($userId);

        if(!$cart){
            $cart = $this->cartRepository->createCart($userId);
        }

        $item = $this->cartRepository->findItem($cart->id,$productId);

        if($item){

            $newQuantity = $item->quantity + $quantity;

            return $this->cartRepository->updateItem($item,$newQuantity);
        }

        return $this->cartRepository->addItem(
            $cart->id,
            $productId,
            $quantity
        );
    }

    public function removeItem($userId,$productId)
    {
        $cart = $this->cartRepository->getUserCart($userId);

        if(!$cart){
            return null;
        }

        return $this->cartRepository->removeItem($cart->id,$productId);
    }

    public function clearCart($userId)
    {
        $cart = $this->cartRepository->getUserCart($userId);

        if(!$cart){
            return null;
        }

        return $this->cartRepository->clearCart($cart->id);
    }
}
