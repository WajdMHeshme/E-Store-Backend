<?php

namespace App\Services;

use App\Repositories\Contracts\FavoriteRepositoryInterface;
use App\Exceptions\ResourceNotFoundException;

class FavoriteService
{
    public function __construct(private FavoriteRepositoryInterface $favoriteRepository) {}

    // إضافة عنصر للمفضلة
    public function addFavorite($userId, $productId)
    {
        $favorite = $this->favoriteRepository->addFavorite($userId, $productId);

        if (!$favorite) {
            throw new \Exception('Failed to add favorite'); // خطأ عام
        }

        return $favorite;
    }

    // إزالة عنصر من المفضلة
    public function removeFavorite($userId, $productId)
    {
        $removed = $this->favoriteRepository->removeFavorite($userId, $productId);

        if (!$removed) {
            throw new ResourceNotFoundException('Favorite item'); // العنصر غير موجود
        }

        return $removed;
    }

    // جلب جميع المفضلات للمستخدم
    public function getUserFavorites($userId)
    {
        $favorites = $this->favoriteRepository->getUserFavorites($userId);

        if ($favorites->isEmpty()) {
            throw new ResourceNotFoundException('Favorites for this user');
        }

        return $favorites;
    }
}
