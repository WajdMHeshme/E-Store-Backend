<?php

namespace App\Repositories\Eloquent;

use App\Models\Ad;
use App\Repositories\Contracts\AdsRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class AdsRepository implements AdsRepositoryInterface
{
    public function getAllAds()
    {
        return Ad::all();
    }

    public function getAdById(int $id): ?Ad
    {
        return Ad::find($id);
    }

    public function createAd(array $data): Ad
    {
        return Ad::create($data);
    }

   public function updateAd($id, array $data) : Ad
    {
        $ad = $this->getAdById($id);
        $ad->update($data);
        return $ad;
    }

    public function deleteAd(int $id): bool
    {
        $ad = Ad::find($id);
        return $ad->delete();
    }
}
