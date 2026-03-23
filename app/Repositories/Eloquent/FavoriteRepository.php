<?php

namespace App\Repositories\Eloquent;

use App\Models\Favorite;
use App\Repositories\Contracts\FavoriteRepositoryInterface;

class FavoriteRepository implements FavoriteRepositoryInterface
{
    public function addFavorite($userId, $productId)
    {
        return Favorite::create([
            'user_id' => $userId,
            'product_id' => $productId,
        ]);
    }

    public function removeFavorite($userId, $productId)
    {
        $favorite = Favorite::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();
        if (!$favorite) {
            return null;
        }
        $favorite->delete();
        return $favorite;
    }

    public function getUserFavorites($userId)
    {
        return Favorite::with('product')
            ->where('user_id', $userId)
            ->get();
    }
}
