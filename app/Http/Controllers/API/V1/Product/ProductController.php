<?php

namespace App\Http\Controllers\API\V1\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\Product\StoreProductRequest;
use App\Http\Requests\API\V1\Product\UpdateProductRequest;
use App\Services\ProductService as ServicesProductService;

class ProductController extends Controller
{
    public function __construct(private ServicesProductService $productService) {}

    public function index()
    {
        $products = $this->productService->getAllProducts();
        return response()->json($products);
    }

    public function show($id)
    {
        $product = $this->productService->getProduct($id);
        return response()->json($product);
    }

public function store(StoreProductRequest $request)
{
    $data = $request->validated();
    $images = $request->file('images', []);

    $product = $this->productService->createProduct($data, $images);

    return response()->json($product);
}

public function update($id, UpdateProductRequest $request)
{
    $data = $request->validated();
    $images = $request->file('images', []);
    $deleteImageIds = $request->input('delete_image_ids', []);

    $product = $this->productService->updateProduct($id, $data, $images, $deleteImageIds);

    return response()->json($product);
}
    public function destroy($id)
    {
        $this->productService->deleteProduct($id);
        return response()->json(['message' => 'Product deleted successfully']);
    }
}
