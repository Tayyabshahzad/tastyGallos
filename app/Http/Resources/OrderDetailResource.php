<?php

namespace App\Http\Resources;

use App\Models\Order;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\OrderProduct;
class OrderDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'status' => $this->status,
            'created_at'=>   $this->created_at->getPreciseTimestamp(3),
            'order_id' => $this->id,
            'order_type' => $this->type,
            'vat' => $this->tax,
            'discount' => $this->discount,
            'delivery_charges'=>   $this->delivery_charges,
            'has_review' => $this->has_review,
            'address' =>   json_decode($this->address),
            'franchise' => SingleOrderFranchiseResource::make($this->franchise),
            'items' => OrderItemResource::collection($this->orderProducts),

        ];
    }
}
