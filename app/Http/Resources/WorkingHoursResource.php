<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkingHoursResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $open = Carbon::parse($this->opening_time)->valueOf();
        $close = Carbon::parse($this->closing_time)->valueOf();
        return [

            'status' => $this->status,
            'opening_time'=> $open,
            'closing_time'=> $close,
            //'opening_time' => $this->opening_time,
            //'closing_time' => $this->closing_time,
            'day' => $this->day,
        ];
    }
}
