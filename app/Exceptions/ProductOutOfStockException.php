<?php

namespace App\Exceptions;

class ProductOutOfStockException extends ApiException
{
    public function __construct()
    {
        parent::__construct("Product is out of stock", 422);
    }
}
