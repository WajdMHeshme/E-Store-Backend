<?php

namespace App\Services;

use App\Repositories\Contracts\ShippingCompanyRepositoryInterface;
use App\Exceptions\ResourceNotFoundException;

class ShippingCompanyService
{
    public function __construct(
        private ShippingCompanyRepositoryInterface $shippingCompanyRepo
    ) {}

    // جلب كل شركات الشحن
    public function getAllShippingCompanies()
    {
        return $this->shippingCompanyRepo->all();
    }

    // جلب شركة شحن واحدة
    public function getShippingCompany($id)
    {
        $company = $this->shippingCompanyRepo->findById($id);

        if (!$company) {
            throw new ResourceNotFoundException('ShippingCompany');
        }

        return $company;
    }

    // إنشاء شركة شحن جديدة
    public function createShippingCompany(array $data)
    {
        return $this->shippingCompanyRepo->create($data);
    }

    // تحديث شركة شحن
    public function updateShippingCompany($id, array $data)
    {
        $company = $this->shippingCompanyRepo->findById($id);

        if (!$company) {
            throw new ResourceNotFoundException('ShippingCompany');
        }

        return $this->shippingCompanyRepo->update($company, $data);
    }

    // حذف شركة شحن
    public function deleteShippingCompany($id)
    {
        $company = $this->shippingCompanyRepo->findById($id);

        if (!$company) {
            throw new ResourceNotFoundException('ShippingCompany');
        }

        return $this->shippingCompanyRepo->delete($company);
    }
}
