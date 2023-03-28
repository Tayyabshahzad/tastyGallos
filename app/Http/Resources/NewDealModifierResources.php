<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NewDealModifierResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'id' => $this->id,
            'product_id' => $this->product_id,
            'item_id' => $this->item_id,
            'order_id'=>$this->order_id,
            'order_deal_id'=>$this->order_deal_id,
            'price'=>$this->price,
            'item_name'=>$this->item->name,
            'item_price'=>$this->item->price,
        ];
    }
}
