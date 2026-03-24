<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\Contracts\OrderRepositoryInterface;
use Illuminate\Support\Facades\DB;
use App\Exceptions\ResourceNotFoundException;

class OrderService
{
    public function __construct(private OrderRepositoryInterface $orders) {}

    // جلب كل الأوردرات
    public function getAllOrders()
    {
        return $this->orders->getAllOrders();
    }

    // جلب أوردر واحد
    public function getOrderById(int $id)
    {
        $order = $this->orders->getOrderById($id);

        if (!$order) {
            throw new ResourceNotFoundException('Order');
        }

        return $order;
    }

    // إنشاء أوردر
    public function createOrder(array $data)
    {
        return DB::transaction(function () use ($data) {

            $items = $data['items'] ?? [];
            unset($data['items']);

            $data['user_id'] = auth()->id();
            $data['status'] = 'pending';
            $data['total_amount'] = 0;

            $order = $this->orders->createOrder($data);

            $total = 0;

            foreach ($items as $item) {

                $product = Product::find($item['product_id']);

                if (!$product) {
                    throw new ResourceNotFoundException("Product with ID {$item['product_id']}");
                }

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

    // تحديث أوردر
    public function updateOrder(int $id, array $data)
    {
        $order = $this->orders->getOrderById($id);

        if (!$order) {
            throw new ResourceNotFoundException('Order');
        }

        return $this->orders->updateOrder($order, $data);
    }

    // حذف أوردر
    public function deleteOrder(int $id)
    {
        $order = $this->orders->getOrderById($id);

        if (!$order) {
            throw new ResourceNotFoundException('Order');
        }

        return $this->orders->deleteOrder($order);
    }
}
