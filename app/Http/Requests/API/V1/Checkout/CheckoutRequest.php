<?php

namespace App\Http\Requests\API\V1\Checkout;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'shipping_company_id' => 'required|exists:shipping_companies,id',
            'shipping_address' => 'required|string|max:255'
        ];
    }
}
