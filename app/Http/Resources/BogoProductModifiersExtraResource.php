<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BogoProductModifiersExtraResource extends JsonResource
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
            'id' => $this->id,
            'modifier_id' => $this->modifier_id,
            'modifier_name' => $this->modifier->name,
            'product_id' => $this->product->name,
            'item_id' => $this->item->name,
            'price' => $this->price,
            'order_id' => $this->order_id,
        ];
    }
}
