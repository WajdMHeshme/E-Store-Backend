<?php

namespace App\Http\Controllers\API\V1\Ads;

use App\Http\Controllers\Controller;
use App\Services\AdsService;
use App\Http\Resources\AdsResource;
use App\Http\Requests\API\V1\Ads\StoreAdsRequest;
use App\Http\Requests\API\V1\Ads\UpdateAdsRequest;

class AdsController extends Controller
{
    public function __construct(private AdsService $adsService) {}

    public function index()
    {
        $ads = $this->adsService->getAllAds();

        return AdsResource::collection($ads);
    }

    public function show(int $id)
    {
        $ad = $this->adsService->getAdById($id);

        return new AdsResource($ad);
    }

    public function store(StoreAdsRequest $request)
    {
        $data = $request->validated();

        $data['image'] = $request->file('image');

        $ad = $this->adsService->createAd($data);

        return new AdsResource($ad);
    }

    public function update(UpdateAdsRequest $request, int $id)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image');
        }

        $ad = $this->adsService->updateAd($id, $data);

        return new AdsResource($ad);
    }

    public function destroy(int $id)
    {
        $this->adsService->deleteAd($id);

        return response()->json([
            'message' => 'Ad deleted successfully'
        ]);
    }
}
