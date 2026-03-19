<?php

namespace App\Services;

use App\Repositories\Contracts\CategoryRepositoryInterface;

class CategoryService
{
    public function __construct(private CategoryRepositoryInterface $categoryRepo) {}

    public function getAllCategories()
    {
        return $this->categoryRepo->getAll();
    }

    public function getCategory($id)
    {
        return $this->categoryRepo->findById($id);
    }

    public function storeCategory(array $data)
    {
        return $this->categoryRepo->create($data);
    }

    public function updateCategory($id, array $data)
    {
        $category = $this->categoryRepo->findById($id);
        return $this->categoryRepo->update($category, $data);
    }

    public function deleteCategory($id)
    {
        $category = $this->categoryRepo->findById($id);
        return $this->categoryRepo->delete($category);
    }
}
