<?php

namespace App\Repositories\Contracts;

interface FavoriteRepositoryInterface
{
    public function addFavorite($userId, $productId);

    public function removeFavorite($userId, $productId);

    public function getUserFavorites($userId);
}
