<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Deal;
use App\Models\DealExtra;
use App\Models\DealModifier;
use App\Models\Order;
use Illuminate\Support\Facades\Session;

class DealDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $deal =  Deal::where('id',$this->deal_id)->first();
        $order = Order::select('id','items_extra','extras')->where('id',$this->order_id)->first();
        $deal_extras_price = DealExtra::select('id','order_id','price')->where('order_id',$this->order_id)->sum('price');
        $deal_modifier_price = DealModifier::select('id','order_id','price')->where('order_id',$this->order_id)->sum('price');
        // $modifiers = DealModifier::with('item')->where('order_id',Session::get('order_id_for_deal_modifiers', 'default'))->get();
        $itemsPrice = ($deal_extras_price+$deal_modifier_price);
        Session::forget('deal_id_deal_data');
        Session::put('deal_id_deal_data',$deal->id);
        $price = ($order->items_extra + $order->extras);
        $dealTotal = ($this->price * $this->quantity);
        $final_Price = ($dealTotal+$itemsPrice);
        return [
            'title' =>$deal->title,
            'id' => $this->id,
            'order_id' => $this->order_id,
            'deal_id' => $this->deal_id,
            'quantity' => $this->quantity,
            'deal_price' => $this->price,
            'price' => $final_Price,
            'photo' => $deal->getFirstMediaUrl('deals','thumb'),
           //'products'=>    DealProductResource::collection($deal->products),
            'products'=>    OrderDealProducts::collection($order->orderDealProduct),
            //'extras'=> NewDealExtraResources::collection($extras),
            //'modifiers'=> NewDealModifierResources::collection($modifiers),
        ];
    }
}
