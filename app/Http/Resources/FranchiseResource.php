<?php

namespace App\Http\Resources;

use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class FranchiseResource extends JsonResource
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
            'name' => $this->name,
            'contact_phone' => $this->contact_phone,
            'contact_email' => $this->contact_email,
            'vat' => $this->vat,
            'lat' => $this->lat,
            'lng' => $this->lng,
            'address' => $this->address,
            'delivery_charges' => $this->delivery_charge,
            'pickup' => $this->pickup,
            'delivery' => $this->delivery,
            'about' => $this->about,
            'busy_time' => $this->busy_time,
            'free_time' => $this->free_time,
            'bank' => $this->bank,
            'account_holder' => $this->account_holder,
            'branch' => $this->branch,
            'account_number' => $this->account_number,
            'timings' => Carbon::parse($this->franchiseTimings)->format('h:i a'),
            'photo' => $this->getFirstMediaUrl('franchise_banner','thumb'),
            'promotions' => PromotionResource2::collection($this->activePromotions),
            'rating' =>  Review::where('franchise_id',$this->id)->sum('rating'),
            'review_total' =>  Review::where('franchise_id',$this->id)->count(),
            'workingHours' =>  WorkingHoursResource::collection($this->workingHours),
            'payment_method' =>  $this->payment_method,
        ];
    }
}
