<?php

namespace App\Repositories\Contracts;

interface CheckoutRepositoryInterface
{
    public function createOrder(array $data);
}
