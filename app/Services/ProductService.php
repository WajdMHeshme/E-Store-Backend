<?php

namespace App\Services;

use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;
use App\Exceptions\ResourceNotFoundException;

class ProductService
{
    public function __construct(
        private ProductRepositoryInterface $productRepo
    ) {}

    //  Get all products
    public function getAllProducts()
    {
        return $this->productRepo->getAll();
    }

    //  Get a single product by ID
    public function getProduct($id)
    {
        $product = $this->productRepo->findById($id);

        if (!$product) {
            throw new ResourceNotFoundException('Product');
        }

        return $product;
    }

    //  Create a product with multiple images
    public function createProduct(array $data, array $images = [])
    {
        $product = $this->productRepo->create($data);

        // Handle product images
        foreach ($images as $image) {
            $path = $image->store('products', 'public');
            $product->images()->create(['path' => $path]);
        }

        return $product->load('images');
    }

    //  Update a product and manage images
    public function updateProduct($id, array $data, array $images = [], array $deleteImageIds = [])
    {
        $product = $this->productRepo->findById($id);

        if (!$product) {
            throw new ResourceNotFoundException('Product');
        }

        // Delete selected images if any
        if (!empty($deleteImageIds)) {
            $imagesToDelete = $product->images()->whereIn('id', $deleteImageIds)->get();
            foreach ($imagesToDelete as $img) {
                Storage::disk('public')->delete($img->path);
                $img->delete();
            }
        }

        // Add new images
        foreach ($images as $image) {
            $path = $image->store('products', 'public');
            $product->images()->create(['path' => $path]);
        }

        $this->productRepo->update($product, $data);

        return $product->load('images');
    }

    //  Delete a product along with its images
    public function deleteProduct($id)
    {
        $product = $this->productRepo->findById($id);

        if (!$product) {
            throw new ResourceNotFoundException('Product');
        }

        // Delete images from storage
        foreach ($product->images as $img) {
            Storage::disk('public')->delete($img->path);
        }

        return $this->productRepo->delete($id);
    }
}
