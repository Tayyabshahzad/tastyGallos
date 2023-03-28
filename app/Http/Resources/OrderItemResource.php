<?php

namespace App\Http\Resources;

use App\Models\Order;
use App\Models\OrderProductExtra;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $orderProductExtras = OrderProductExtra::where('order_id',$this->order_id)->with('extra')->get();
        $order = Order::select('id','items_extra','extras')->where('id',$this->order_id)->first();
        $price = ($order->items_extra + $order->extras);
        return [
            'id' => $this->id,
            'order_id' => $this->order_id,
            'product' => $this->product->name,
            'photo' => $this->product->getFirstMediaUrl('products','thumb'),
            'quantity' => $this->quantity,
            'price' => ($this->price+$price),
            'discount' =>$this->discount,
            'modifiers' =>OrderModifieresource::collection($this->items),
           //'extras' => ExtraResource::collection($this->product->extras),
            'extras' => OrderExtraResource::collection($orderProductExtras),

           // 'extras' => $this->id,
            //'extras' =>   $ff = Order::where('id',$this->order_id)->with('orderExtras','orderExtras.extra')->first(),

        ];
    }
}
