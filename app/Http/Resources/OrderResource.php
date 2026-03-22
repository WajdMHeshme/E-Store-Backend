<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\OrderItemsResource;

class OrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            'user_id' => $this->user_id,

            'shipping_company' => $this->shippingCompany,

            'shipping_address' => $this->shipping_address,

            'total_amount' => $this->total_amount,

            'status' => $this->status,

            'items' => OrderItemsResource::collection(
                $this->whenLoaded('items')
            ),

            'created_at' => $this->created_at,

            'updated_at' => $this->updated_at,
        ];
    }
}
