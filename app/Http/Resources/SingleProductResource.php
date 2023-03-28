<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SingleProductResource extends JsonResource
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
            'sell_on_its_own' => $this->sell_on_its_own,
            'price' => $this->price,
            'sale_price' => $this->sale_price,
            'vat' => $this->vat,
            'status' => $this->status,
            'description'=>$this->description,
            'photo' => ProductMediaResource::collection($this->getMedia('products')),
            'modifiers' => ModifierResource::collection($this->modifierGroups),
           // 'products' => $this->modifierGroups,
            // 'categories' => $this->whenPivotLoaded('category_product',function(){
            //                         return $this->pivot->categories;
            //             }),
            'categories' => CategoryResource::collection($this->categories),
            //'modifiers' => ModifierResource::collection($this->modifierGroups),

            //'categories' =>   $this->categories,
        ];
    }
}
