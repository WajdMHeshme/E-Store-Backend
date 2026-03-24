<?php

namespace App\Services;

use App\Repositories\Contracts\ReviewRepositoryInterface;

class ReviewService
{
    public function __construct(
        private ReviewRepositoryInterface $reviews
    ) {}

    public function getProductReviews($productId)
    {
        return $this->reviews->getProductReviews($productId);
    }

    public function createReview(array $data)
    {
        return $this->reviews->create($data);
    }

    public function updateReview(int $id, array $data)
    {
        return $this->reviews->update($id, $data);
    }

    public function deleteReview(int $id)
    {
        return $this->reviews->delete($id);
    }
}
