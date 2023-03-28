<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FranchiseOrderResource extends JsonResource
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
            'address' => $this->address,
            'estimated_time' => $this->estimated_time,
            'photo' => $this->getFirstMediaUrl('franchise_banner','thumb'),
        ];
    }
}
