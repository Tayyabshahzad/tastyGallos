<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NewDealExtraResources extends JsonResource
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
            'product_id' => $this->product_id,
            'extra_id' => $this->extra_id,
            'order_id' => $this->order_id,
            'order_deal_id'=>$this->order_deal_id,
            'price'=>$this->price,
            'deal_id'=>$this->deal_id,
            'extra_name'=>$this->extra->name,
            'extra_price'=>$this->extra->price,
        ];
    }
}
