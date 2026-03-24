<?php

namespace App\Exceptions;

class CartEmptyException extends ApiException
{
    public function __construct()
    {
        parent::__construct("Cart is empty", 400);
    }
}
