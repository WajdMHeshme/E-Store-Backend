<?php

namespace App\Repositories\Contracts;

interface CategoryRepositoryInterface
{
    public function getAll();
    public function findById($id);
    public function create(array $data);
    public function update($category, array $data);
    public function delete($category);
}
