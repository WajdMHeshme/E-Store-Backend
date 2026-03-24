<?php

namespace App\Repositories\Eloquent;

use App\Models\Order;
use App\Repositories\Contracts\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{
    public function getAllOrders()
    {
        if (auth()->user()->is_admin) {
            return Order::with('items.product','shippingCompany')->get();
        }

        return Order::with('items.product','shippingCompany')
            ->where('user_id', auth()->id())
            ->get();
    }

    public function getOrderById(int $id)
    {
        return Order::with('items.product','shippingCompany')->find($id);
    }

    public function createOrder(array $data)
    {
        return Order::create($data);
    }

    public function updateOrder(int $id, array $data)
    {
        $order = $this->getOrderById($id);
        $order->update($data);

        return $order;
    }

    public function deleteOrder(int $id)
    {
        $order = Order::find($id);

        return $order->delete();
    }
}
