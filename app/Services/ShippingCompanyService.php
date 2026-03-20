<?php

namespace App\Services;

use App\Repositories\Contracts\ShippingCompanyRepositoryInterface;

class ShippingCompanyService
{
    public function __construct(
        private ShippingCompanyRepositoryInterface $shippingCompanyRepo
    ) {}

    public function getAllShippingCompanies()
    {
        return $this->shippingCompanyRepo->all();
    }

    public function getShippingCompany($id)
    {
        return $this->shippingCompanyRepo->findById($id);
    }
    public function createShippingCompany(array $data)
    {
        return $this->shippingCompanyRepo->create($data);
    }

    public function updateShippingCompany($id, array $data)
    {
        return $this->shippingCompanyRepo->update($id, $data);
    }
    public function deleteShippingCompany($id)
    {
        return $this->shippingCompanyRepo->delete($id);
    }
}
