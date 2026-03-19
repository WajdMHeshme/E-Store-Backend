<?php

namespace App\Services;

use App\Repositories\Contracts\ProductRepositoryInterface;

class ProductService
{
    public function __construct(
        private ProductRepositoryInterface $productRepo
    ) {}

    public function getAllProducts()
    {
        return $this->productRepo->getAll();
    }

    public function getProduct($id)
    {
        return $this->productRepo->findById($id);
    }
    public function createProduct(array $data)
    {
        return $this->productRepo->create($data);
    }

    public function updateProduct($id, array $data)
    {
        $product = $this->productRepo->findById($id);
        return $this->productRepo->update($product, $data);
    }
    public function deleteProduct($id)
    {

        return $this->productRepo->delete($id);
    }
}
