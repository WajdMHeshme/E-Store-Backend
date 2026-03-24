<?php

namespace App\Services;

use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Exceptions\ResourceNotFoundException;

class CategoryService
{
    public function __construct(private CategoryRepositoryInterface $categoryRepo) {}

    // جلب كل الفئات
    public function getAllCategories()
    {
        return $this->categoryRepo->getAll();
    }

    // جلب فئة واحدة
    public function getCategory($id)
    {
        $category = $this->categoryRepo->findById($id);

        if (!$category) {
            throw new ResourceNotFoundException('Category');
        }

        return $category;
    }

    // إنشاء فئة جديدة
    public function storeCategory(array $data)
    {
        return $this->categoryRepo->create($data);
    }

    // تحديث فئة
    public function updateCategory($id, array $data)
    {
        $category = $this->categoryRepo->findById($id);

        if (!$category) {
            throw new ResourceNotFoundException('Category');
        }

        return $this->categoryRepo->update($category, $data);
    }

    // حذف فئة
    public function deleteCategory($id)
    {
        $category = $this->categoryRepo->findById($id);

        if (!$category) {
            throw new ResourceNotFoundException('Category');
        }

        return $this->categoryRepo->delete($category);
    }
}
