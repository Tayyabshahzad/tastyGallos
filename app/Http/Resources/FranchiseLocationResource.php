<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FranchiseLocationResource extends JsonResource
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
            'lat' => $this->lat,
            'lng' => $this->lng,
             'payment_method' => $this->payment_method,
            // 'delivery_charge' => $this->delivery_charge,
            // 'pickup' => $this->pickup,
            // 'delivery' => $this->delivery,
            // 'about' => $this->about,
            // 'busy_time' => $this->busy_time,
            // 'free_time' => $this->free_time,
            // 'bank' => $this->bank,
            // 'account_holder' => $this->account_holder,
            // 'branch' => $this->branch,
            // 'account_number' => $this->account_number,
            // 'photo' => $this->getFirstMediaUrl('franchise_banner','thumb'),
           // 'promotions' => PromotionResource2::collection($this->promotions),

        ];
    }
}
