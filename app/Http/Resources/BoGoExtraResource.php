<?php

namespace App\Http\Resources;

use App\Models\Extra;
use Illuminate\Http\Resources\Json\JsonResource;

class BoGoExtraResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $extra = Extra::select('id','name','price')->where('id',$this->extra_id)->first();
        return [
            'id' => $this->id,
            'bogo_product_id' => $this->bogo_product_id,
            'extra_id' => $this->extra_id,
            'extra_name' => $extra->name,
            'is_free' => $this->is_free,
            'price' => $extra->price,
        ];
    }
}
