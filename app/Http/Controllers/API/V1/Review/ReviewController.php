<?php

namespace App\Http\Controllers\API\V1\Review;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\Review\StoreReviewRequest;
use App\Http\Requests\API\V1\Review\UpdateReviewRequest;
use App\Http\Resources\ReviewResource;
use App\Services\ReviewService;

class ReviewController extends Controller
{

    public function __construct(
        private ReviewService $reviewService
    ) {}

    public function index($productId)
    {
        return ReviewResource::collection(
            $this->reviewService->getProductReviews($productId)
        );
    }

    public function store(StoreReviewRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();

        $review = $this->reviewService->createReview($data);

        return new ReviewResource($review);
    }

    public function update(UpdateReviewRequest $request, $id)
    {
        $review = $this->reviewService->updateReview(
            $id,
            $request->validated()
        );

        return new ReviewResource($review);
    }

    public function destroy($id)
    {
        $this->reviewService->deleteReview($id);

        return response()->json([
            'message' => 'Review deleted'
        ]);
    }
}
