<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BogoProductExtraResource extends JsonResource
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
            'product_id' => $this->product_id,
            'product_name' => $this->product->name,
            'extra_name' => $this->extra->name,
            'extra_id' => $this->extra_id,
            'order_id' => $this->order_id,
            'price' => $this->price,
        ];
    }
}
