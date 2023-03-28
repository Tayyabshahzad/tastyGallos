<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Session;

class OrderDealResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
       // Session::forget('bogo_product_extra');
         // Session::put('bogo_product_extra',$this->bogoExtras);
       // Session::forget('bogo_product_modifiers');
       // Session::put('bogo_product_modifiers',$this->bogoExtras);

       Session::forget('order_id_for_getting_deal_modifiers_and_extras');
       Session::put('order_id_for_getting_deal_modifiers_and_extras',$this->id,);
        return [
            'status' => $this->status,
            'created_at'=>   $this->created_at->getPreciseTimestamp(3),
            'order_id' => $this->id,
            'order_type' => $this->type,
            'order_number' => $this->order_number,
            'payment_method' => $this->payment_method,
            'vat' => $this->tax,
            'discount' => $this->discount,
            'delivery_charges'=>   $this->delivery_charges,
            'has_review' => $this->has_review,
            'address' =>   json_decode($this->address),
            'order_products'=> OrderItemResource::collection($this->orderProducts),
            //'orderExtras'=>  $this->orderDealsExtra,
            'deals'=> DealDetailResource::collection($this->orderDeals),
            // //'deals'=> $this->orderDeals,
           // 'deal-extras'=> DealExtraResource::collection($this->orderDealsExtra),
            //'deal_modifiers'=> DealModifierResource::collection($this->orderDealsModifiers),
            'bogo_products'=> BogoProductResource::collection($this->bogoProducts),
            //'franchise'=> $this->franchise_id,

            'franchise'=>FranchiseOrderResource::make($this->franchise),
            // 'bogo_extras'=> BogoProductExtraResource::collection($this->bogoExtras),
            // 'bogo_modifiers'=> BogoProductModifiersExtraResource::collection($this->bogoModifiers),
        ];
    }
}
