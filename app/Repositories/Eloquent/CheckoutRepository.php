<?php

namespace App\Repositories\Eloquent;

use App\Models\Order;
use App\Repositories\Contracts\CheckoutRepositoryInterface;

class CheckoutRepository implements CheckoutRepositoryInterface
{
    public function createOrder(array $data)
    {
        return Order::create($data);
    }
}
