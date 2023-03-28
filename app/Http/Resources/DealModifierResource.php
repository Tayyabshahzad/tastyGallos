<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DealModifierResource extends JsonResource
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
            'deal'=> $this->order_deals_id,
            'deal_id'=>   $this->deal_id,
            'modifier_name'=>   $this->modifier->name,
            'modifier_id'=>   $this->modifier_id,
            'product_name' => $this->product->name,
            'product_id' => $this->product_id,
            'item_name' => $this->item->name,
            'item_id' => $this->item_id,
            'order_id' => $this->order_id,
            'price' => $this->price,
        ];
    }
}
