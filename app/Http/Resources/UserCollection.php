<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
     //   return parent::toArray($request);

        return [

            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'gender' => $this->gender,
            'dob' => $this->dob,
            'registered_type' => $this->registered_type,
            'google_id' => $this->google_id,
            'facebook_id' => $this->facebook_id,
            'photo' => $this->getFirstMediaUrl('profile_photo','thumb'),
            'card'  =>  CardResource::make($this->creditCard),

        ];
    }
}
