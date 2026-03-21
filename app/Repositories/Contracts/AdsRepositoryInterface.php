<?php

namespace App\Repositories\Contracts;

use App\Models\Ad;

interface AdsRepositoryInterface
{
    public function getAllAds();
    public function getAdById(int $id): ?Ad;
    public function createAd(array $data): Ad;
    public function updateAd(int $id, array $data): ?Ad;
    public function deleteAd(int $id): bool;
}
