<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\ShippingCompany;
use App\Repositories\Contracts\CheckoutRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CheckoutService
{
    public function __construct(
        private CheckoutRepositoryInterface $checkoutRepository
    ) {}

    public function checkout($userId, array $data)
    {
        return DB::transaction(function () use ($userId, $data) {

            $cart = Cart::with('items.product')
                ->where('user_id', $userId)
                ->firstOrFail();

            if ($cart->items->isEmpty()) {
                throw new \Exception('Cart is empty');
            }

            $shippingCompany = ShippingCompany::findOrFail($data['shipping_company_id']);

            $order = $this->checkoutRepository->createOrder([
                'user_id' => $userId,
                'shipping_company_id' => $data['shipping_company_id'],
                'shipping_address' => $data['shipping_address'],
                'status' => 'pending',
                'total_amount' => 0
            ]);

            $total = 0;

            foreach ($cart->items as $item) {

                $price = $item->product->price;

                $order->items()->create([
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $price
                ]);

                $total += $price * $item->quantity;
            }

            $total += $shippingCompany->delivery_fee;

            $order->update([
                'total_amount' => $total
            ]);

            $cart->items()->delete();

            return $order->load('items.product','shippingCompany');
        });
    }
}
