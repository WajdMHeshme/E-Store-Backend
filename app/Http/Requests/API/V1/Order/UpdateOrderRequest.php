<?php

namespace App\Http\Requests\API\V1\Order;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'shipping_company_id' => 'sometimes|exists:shipping_companies,id',
            'total_amount' => 'sometimes|numeric|min:0',
            'status' => 'sometimes|string|max:255',
            'shipping_address' => 'sometimes|string'
        ];
    }
}
