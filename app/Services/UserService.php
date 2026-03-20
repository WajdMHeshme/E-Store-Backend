<?php

namespace App\Services;

use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserService
{

    public function __construct(private UserRepositoryInterface $userRepo) {}

    public function getAllUsers()
    {
        return $this->userRepo->all();
    }

    public function getUserById($user_id)
    {
        return $this->userRepo->findById($user_id);
    }

    public function createUser(array $data)
    {
        $data['password'] = Hash::make($data['password']);

        return $this->userRepo->create($data);
    }

public function updateUser($user_id, array $data)
{
    return $this->userRepo->update($user_id, $data);
}

    public  function deleteUser($user_id)
    {
        return $this->userRepo->delete($user_id);
    }
}
