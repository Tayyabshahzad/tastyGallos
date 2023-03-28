<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PromotionResource2 extends JsonResource
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
            'type' => $this->type,
            'start_date_time' => $this->start_date_time,
            'end_date_time' => $this->end_date_time,
            'buy_product_id' => $this->buy_product_id,
            'get_product_id' => $this->get_product_id,
            'amount' => $this->amount,
            'on_all_franchises' => $this->on_all_franchises,
            'discount_type'=>$this->discount_type,
            'status' => $this->status,
            'photo' => $this->getFirstMediaUrl('promotions','thumb'),
            'is_schedule' => $this->is_schedule,
            //'franchises'=>$this->franchises,
            //'promotions' => PromotionResource::collection($this->promotions),
            'products'=> ProductResource2::collection($this->products),
        ];
    }
}
