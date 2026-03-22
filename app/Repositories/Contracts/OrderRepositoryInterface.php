<?php

namespace App\Repositories\Contracts;

interface OrderRepositoryInterface
{
    public function getAllOrders();
    public function getOrderById(int $id);
    public function createOrder(array $data);
    public function updateOrder(int $id, array $data);
    public function deleteOrder(int $id);
}
