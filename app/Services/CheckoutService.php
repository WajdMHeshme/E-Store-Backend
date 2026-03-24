<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\ShippingCompany;
use App\Repositories\Contracts\CheckoutRepositoryInterface;
use Illuminate\Support\Facades\DB;

// Exceptions
use App\Exceptions\CartEmptyException;
use App\Exceptions\ResourceNotFoundException;

class CheckoutService
{
    public function __construct(
        private CheckoutRepositoryInterface $checkoutRepository
    ) {}

    public function checkout($userId, array $data)
    {
        return DB::transaction(function () use ($userId, $data) {

            // 🔹 جلب السلة مع المنتجات
            $cart = Cart::with('items.product')
                ->where('user_id', $userId)
                ->first();

            if (!$cart) {
                throw new ResourceNotFoundException('Cart');
            }

            if ($cart->items->isEmpty()) {
                throw new CartEmptyException();
            }

            // 🔹 جلب شركة الشحن
            $shippingCompany = ShippingCompany::find($data['shipping_company_id']);
            if (!$shippingCompany) {
                throw new ResourceNotFoundException('Shipping Company');
            }

            // 🔹 إنشاء الطلب
            $order = $this->checkoutRepository->createOrder([
                'user_id' => $userId,
                'shipping_company_id' => $data['shipping_company_id'],
                'shipping_address' => $data['shipping_address'],
                'status' => 'pending',
                'total_amount' => 0
            ]);

            $total = 0;

            // 🔹 إنشاء عناصر الطلب
            foreach ($cart->items as $item) {
                $product = $item->product;

                if (!$product) {
                    throw new ResourceNotFoundException('Product');
                }

                $price = $product->price;

                $order->items()->create([
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $price
                ]);

                $total += $price * $item->quantity;
            }

            // 🔹 إضافة رسوم الشحن
            $total += $shippingCompany->delivery_fee;

            $order->update([
                'total_amount' => $total
            ]);

            // 🔹 مسح السلة بعد الانتهاء
            $cart->items()->delete();

            // 🔹 إعادة الطلب مع العلاقات
            return $order->load('items.product', 'shippingCompany');
        });
    }
}
