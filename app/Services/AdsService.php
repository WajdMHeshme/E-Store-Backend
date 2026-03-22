<?php

namespace App\Services;

use App\Repositories\Contracts\AdsRepositoryInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class AdsService
{
    public function __construct(private AdsRepositoryInterface $ads) {}

    public function getAllAds()
    {
        return $this->ads->getAllAds();
    }

    public function getAdById(int $id)
    {
        return $this->ads->getAdById($id);
    }

    public function createAd(array $data)
    {
        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {

            $data['image'] = $data['image']->store('ads', 'public');
        }

        return $this->ads->createAd($data);
    }

    public function updateAd(int $id, array $data)
    {
        $ad = $this->ads->getAdById($id);

        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {

            if ($ad->image) {
                Storage::disk('public')->delete($ad->image);
            }

            $data['image'] = $data['image']->store('ads', 'public');
        }

        return $this->ads->updateAd($id, $data);
    }

    public function deleteAd(int $id)
    {
        $ad = $this->ads->getAdById($id);

        if ($ad->image) {
            Storage::disk('public')->delete($ad->image);
        }

        return $this->ads->deleteAd($id);
    }
}
