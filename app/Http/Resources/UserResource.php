<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //return parent::toArray($request);

//        src="{{Auth::user()->getFirstMediaUrl('profile_photo', 'thumb')}}"



        return [

            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'gender' => $this->gender,
            'dob' => $this->dob,
            'registered_type' => $this->registered_type,
            'google_id' => $this->google_id,
            'facebook_id' => $this->facebook_id,
            'phone' => $this->phone,
            'photo' => $this->getFirstMediaUrl('profile_photo','thumb'),
            'notification_token' => $this->notification_token,
            'card'  =>  CardResource::make($this->creditCard),


        ];
    }
}
