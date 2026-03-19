<?php

namespace App\Http\Controllers\API\V1\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\Category\StoreCategoryRequest;
use App\Http\Requests\API\V1\Category\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Services\CategoryService as ServicesCategoryService;

class CategoryController extends Controller
{
    public function __construct(private ServicesCategoryService $categoryService) {}

    public function index()
    {
        $categories = $this->categoryService->getAllCategories();
        return CategoryResource::collection($categories);
    }

    public function show($id)
    {
        $category = $this->categoryService->getCategory($id);
        return new CategoryResource($category);
    }

    public function store(StoreCategoryRequest $request)
    {
        $category = $this->categoryService->storeCategory($request->validated());
        return new CategoryResource($category);
    }

    public function update(UpdateCategoryRequest $request, $id)
    {
        $category = $this->categoryService->updateCategory($id, $request->validated());
        return new CategoryResource($category);
    }

    public function destroy($id)
    {
        $category = $this->categoryService->deleteCategory($id);
        return new CategoryResource($category);
    }
}
