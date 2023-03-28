<?php

namespace App\Http\Resources;

use App\Models\DealExtra;
use App\Models\DealModifier;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderDealProducts extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $extras = DealExtra::with('extra')->where('order_deal_product_id',$this->id)->get();
        $modifiers = DealModifier::with('item')->where('order_deal_product_id',$this->id)->get();
        return [
            'id' =>$this->id,
            'order_id' =>$this->order_id,
            'deal_id' =>$this->deal_id,
            'product_id' =>$this->product_id,
            'product_name' =>$this->product->name,
            'extras'=> NewDealExtraResources::collection($extras),
            'modifiers'=> NewDealModifierResources::collection($modifiers),
        ];
    }
}
