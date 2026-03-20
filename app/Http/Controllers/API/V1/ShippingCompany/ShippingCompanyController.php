<?php

namespace App\Http\Controllers\API\V1\ShippingCompany;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\ShippingCompany\StoreShippingCompanyRequest;
use App\Http\Requests\API\V1\ShippingCompany\UpdateShippingCompanyRequest;
use App\Http\Resources\ShippingCompanyResource;
use App\Services\ShippingCompanyService;

class ShippingCompanyController extends Controller
{
    public function __construct(
        private ShippingCompanyService $shippingCompanyService
    ) {}

    public function index()
    {
        return ShippingCompanyResource::collection(
            $this->shippingCompanyService->getAllShippingCompanies()
        );
    }

    public function show($id)
    {
        return new ShippingCompanyResource(
            $this->shippingCompanyService->getShippingCompany($id)
        );
    }

    public function store(StoreShippingCompanyRequest $request)
    {
        $shippingCompany = $this->shippingCompanyService
            ->createShippingCompany($request->validated());

        return response()->json([
            'message' => 'Shipping company created successfully',
            'data' => new ShippingCompanyResource($shippingCompany)
        ], 201);
    }

    public function update(UpdateShippingCompanyRequest $request, $id)
    {
        $shippingCompany = $this->shippingCompanyService
            ->updateShippingCompany($id, $request->validated());

        return response()->json([
            'message' => 'Shipping company updated successfully',
            'data' => new ShippingCompanyResource($shippingCompany)
        ]);
    }

    public function destroy($id)
    {
        $this->shippingCompanyService->deleteShippingCompany($id);

        return response()->json([
            'message' => 'Shipping company deleted successfully'
        ]);
    }
}
