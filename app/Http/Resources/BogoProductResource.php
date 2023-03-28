<?php

namespace App\Http\Resources;

use App\Models\BogoModifier;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Session;

class BogoProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $modfiiferCollection = BogoModifier::where('bogo_product_id',$this->id,)->get();
        return [
            'id' => $this->id,
            'order_id' => $this->order_id,
            'product_id' => $this->product_id,
            'product_name' => $this->product->name,
            'quantity' => $this->quantity,
            'product_photo' => $this->product->getFirstMediaUrl('products','thumb'),
            'price' => $this->product->final_price,
            'extras' => BoGoExtraResource::collection($this->bogoExtra),
            'modifiers' => BogoModiferResource::collection($modfiiferCollection),
            'free_product' => [
                'product_name' => $this->freeProduct->name,
                'product_photo' => $this->freeProduct->getFirstMediaUrl('products','thumb'),
                'price' => $this->freeProduct->final_price,
                //'extras' => BogoProductExtraResource::collection(Session::get('bogo_product_extra', 'default')),
                //'modifiers' => BogoProductExtraResource::collection(Session::get('bogo_product_extra', 'default')),
             ],

            // 'free_product' => $this->free_product,

            // 'free_product_name' => $this->freeProduct->name,
            // 'quantity' => $this->quantity,

        ];
    }
}
