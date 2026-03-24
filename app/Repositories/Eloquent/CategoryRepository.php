<?php

namespace App\Repositories\Eloquent;

use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface as ContractsCategoryRepositoryInterface;

class CategoryRepository implements ContractsCategoryRepositoryInterface
{
    public function getAll()
    {
        return Category::all();
    }

    public function findById($id)
    {
        return Category::find($id);
    }

    public function create(array $data)
    {
        return Category::create($data);
    }

    public function update($category, array $data)
    {
        $category->update($data);
        return $category;
    }

    public function delete($category)
    {
        $category->delete();
        return $category;
    }
}
