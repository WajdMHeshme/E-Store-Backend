<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            'product_id' => $this->product_id,

            'product' => $this->whenLoaded('product'),

            'quantity' => $this->quantity,

            'price' => $this->price,

            'subtotal' => $this->price * $this->quantity
        ];
    }
}
