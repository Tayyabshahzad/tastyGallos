<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class BogoModiferResource extends JsonResource
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
            'product_id' => $this->product_id,
            'item_id' => $this->item_id,
            'item_name' => Product::select('id','name')->where('id',$this->item_id)->first()->name,
            'price' => $this->price,
            'order_id' => $this->order_id,
            'price' => $this->product->final_price,
            'is_free' =>$this->is_free,
            'bogo_product_id' =>$this->bogo_product_id,
        ];
    }
}
