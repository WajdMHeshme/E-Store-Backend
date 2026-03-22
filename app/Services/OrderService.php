<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\Contracts\OrderRepositoryInterface;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function __construct(private OrderRepositoryInterface $orders) {}

    public function getAllOrders()
    {
        return $this->orders->getAllOrders();
    }

    public function getOrderById(int $id)
    {
        return $this->orders->getOrderById($id);
    }

    public function createOrder(array $data)
    {
        return DB::transaction(function () use ($data) {

            $items = $data['items'];
            unset($data['items']);

            $data['user_id'] = auth()->id();
            $data['status'] = 'pending';
            $data['total_amount'] = 0;

            $order = $this->orders->createOrder($data);

            $total = 0;

            foreach ($items as $item) {

                $product = Product::findOrFail($item['product_id']);

                $price = $product->price;

                $order->items()->create([
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $price
                ]);

                $total += $price * $item['quantity'];
            }

            $order->update([
                'total_amount' => $total
            ]);

            return $order->load('items.product','shippingCompany');
        });
    }

    public function updateOrder(int $id, array $data)
    {
        return $this->orders->updateOrder($id, $data);
    }

    public function deleteOrder(int $id)
    {
        return $this->orders->deleteOrder($id);
    }
}
