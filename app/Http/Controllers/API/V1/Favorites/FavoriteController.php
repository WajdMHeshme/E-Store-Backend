<?php

namespace App\Http\Controllers\API\V1\Favorites;

use App\Http\Controllers\Controller;
use App\Http\Requests\FavoriteRequest;
use App\Http\Resources\FavoriteResource;
use App\Services\FavoriteService;

class FavoriteController extends Controller
{
    public function __construct(private FavoriteService $favoriteService) {}

    public function index()
    {
        $favorites = $this->favoriteService->getUserFavorites(auth()->id());
        return FavoriteResource::collection($favorites);
    }

    public function store(FavoriteRequest $request)
    {

        $favorite = $this->favoriteService->addFavorite(auth()->id(), $request->validated());
        return response()->json(new FavoriteResource($favorite), 201);
    }

    public function destroy($productId)
    {
        $deleted = $this->favoriteService->removeFavorite(auth()->id(), $productId);

        if (!$deleted) {
            return response()->json([
                'message' => 'Favorite not found'
            ], 404);
        }

        return response()->json([
            'message' => 'Favorite removed successfully'
        ], 200);
    }
}
