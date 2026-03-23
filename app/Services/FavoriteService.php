<?php

namespace App\Services;

use App\Repositories\Contracts\FavoriteRepositoryInterface;

class FavoriteService
{
    public function __construct(private FavoriteRepositoryInterface $favoriteRepository) {}

    public function addFavorite($userId, $productId)
    {
        return $this->favoriteRepository->addFavorite($userId, $productId);
    }

    public function removeFavorite($userId, $productId)
    {
        return $this->favoriteRepository->removeFavorite($userId, $productId);
    }

    public function getUserFavorites($userId)
    {
        return $this->favoriteRepository->getUserFavorites($userId);
    }
}
