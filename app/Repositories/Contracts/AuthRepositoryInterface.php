<?php

namespace App\Repositories\Contracts;

use App\Models\User;

interface AuthRepositoryInterface {
    public function findUserByEmail(string $email) : ?User;
    public function createUser(array $data) : User;
}
