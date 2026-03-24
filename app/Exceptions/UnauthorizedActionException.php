<?php

namespace App\Exceptions;

class UnauthorizedActionException extends ApiException
{
    public function __construct()
    {
        parent::__construct("Unauthorized action", 403);
    }
}
