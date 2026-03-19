<?php

namespace App\Repositories\Eloquent;
use App\Models\User;
use App\Repositories\Contracts\AuthRepositoryInterface as ContractsAuthRepositoryInterface;

class AuthRepository implements ContractsAuthRepositoryInterface
{
    public function findUserByEmail(string $email) : ?User {
        return User::where('email', $email)->first();
    }

    public function createUser(array $data) : User {
        return User::create($data);
    }
}
