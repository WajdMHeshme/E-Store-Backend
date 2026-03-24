<?php

namespace App\Services;

use App\Repositories\Contracts\ProductRepositoryInterface;

// Exceptions
use App\Exceptions\ResourceNotFoundException;

class ProductService
{
    public function __construct(
        private ProductRepositoryInterface $productRepo
    ) {}

    // 🔹 جلب كل المنتجات
    public function getAllProducts()
    {
        return $this->productRepo->getAll();
    }

    // 🔹 جلب منتج واحد
    public function getProduct($id)
    {
        $product = $this->productRepo->findById($id);

        if (!$product) {
            throw new ResourceNotFoundException('Product');
        }

        return $product;
    }

    // 🔹 إنشاء منتج
    public function createProduct(array $data)
    {
        return $this->productRepo->create($data);
    }

    // 🔹 تحديث منتج
    public function updateProduct($id, array $data)
    {
        $product = $this->productRepo->findById($id);

        if (!$product) {
            throw new ResourceNotFoundException('Product');
        }

        return $this->productRepo->update($product, $data);
    }

    // 🔹 حذف منتج
    public function deleteProduct($id)
    {
        $product = $this->productRepo->findById($id);

        if (!$product) {
            throw new ResourceNotFoundException('Product');
        }

        return $this->productRepo->delete($id);
    }
}
