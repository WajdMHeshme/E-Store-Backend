<?php


namespace App\Repositories\Contracts;

interface UserRepositoryInterface
{
    public function all();
    public function findById($id);
    public function create(array $user);
    public function update($id, array $user);
    public function delete($id);
}

