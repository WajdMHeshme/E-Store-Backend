<?php

namespace App\Services;

use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use App\Exceptions\ResourceNotFoundException;

class UserService
{
    public function __construct(private UserRepositoryInterface $userRepo) {}

    public function getAllUsers()
    {
        return $this->userRepo->all();
    }

    public function getUserById($user_id)
    {
        $user = $this->userRepo->findById($user_id);

        if (!$user) {
            throw new ResourceNotFoundException('User');
        }

        return $user;
    }

    public function createUser(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        return $this->userRepo->create($data);
    }

    public function updateUser($user_id, array $data)
    {
        $user = $this->userRepo->findById($user_id);

        if (!$user) {
            throw new ResourceNotFoundException('User');
        }

        return $this->userRepo->update($user, $data);
    }

    public function deleteUser($user_id)
    {
        $user = $this->userRepo->findById($user_id);

        if (!$user) {
            throw new ResourceNotFoundException('User');
        }

        return $this->userRepo->delete($user);
    }
}
