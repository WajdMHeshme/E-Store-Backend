<?php

namespace App\Repositories\Eloquent;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface as ContractsProductRepositoryInterface;

class ProductRepository implements ContractsProductRepositoryInterface
{
    public function getAll()
    {
        return Product::all();
    }

    public function findById($id)
    {
        return Product::findOrFail($id);
    }

    public function create(array $data)
    {
        return Product::create($data);
    }
    public function update($product, array $data)
    {
        $product->update($data);
        return $product;
    }
    public function delete($id)
    {
        $product = Product::findorFail($id);
        $product->delete();
        return $product;
    }
}
