<?php

namespace App\Repositories\Eloquent;

use App\Models\ShippingCompany;
use App\Repositories\Contracts\ShippingCompanyRepositoryInterface;

class ShippingCompanyRepository implements ShippingCompanyRepositoryInterface
{
    public function all()
    {
        return ShippingCompany::all();
    }

    public function findById($id)
    {
        return ShippingCompany::findOrFail($id);
    }
    public function create(array $data)
    {
        return ShippingCompany::create($data);
    }

    public function update($id, array $data)
    {
        $shippingCompany = $this->findById($id);
        $shippingCompany->update($data);
        return $shippingCompany;
    }

    public function delete($id)
    {
        $shippingCompany = $this->findById($id);
        $shippingCompany->delete();
        return $shippingCompany;
    }
}
