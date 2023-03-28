<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DealExtraResource extends JsonResource
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
            'deal_id' => $this->order_deal_id, //  The Forgin key of Deal Table
            'product_id' => $this->product_id,
            'product_name' => $this->product->name,
            'extra' => $this->extra->name,
            'price'=>  $this->price,
            //'order_deal_id'=>$this->order_deal_id,
        ];
    }
}
