<?php

namespace App\Repositories\Eloquent;

use App\Models\Review;
use App\Repositories\Contracts\ReviewRepositoryInterface;

class ReviewRepository implements ReviewRepositoryInterface
{

    public function getProductReviews(int $productId)
    {
        return Review::where('product_id', $productId)
            ->with('user')
            ->latest()
            ->get();
    }

    public function create(array $data)
    {
        return Review::create($data);
    }

    public function update(int $id, array $data)
    {
        $review = Review::findOrFail($id);
        $review->update($data);

        return $review;
    }

    public function delete(int $id)
    {
        return Review::destroy($id);
    }

    public function find(int $id)
    {
        return Review::findOrFail($id);
    }
}
