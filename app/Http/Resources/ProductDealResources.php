<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Session;

class ProductDealResources extends JsonResource
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
            'franchise_id' => Session::get('franchise_id_for_getting_product', 'default'),
            'name' => $this->name,
            'sell_on_its_own' => $this->sell_on_its_own,
            'price' => $this->specialPrice->where('franchise_id',Session::get('franchise_id_for_getting_product', 'default'))->first()->price ?? $this->final_price,
            'vat' => $this->vat,
            'status' => $this->status,
           // 'product_count'=> $this->deals->sum('pivot.product_quantity'),
            'product_count'=> $this->pivot->product_quantity,
            //'product_count'=>1,
            'description' => $this->description,
            'photo' => ProductMediaResource::collection($this->getMedia('products')),
            'categories' => CategoryResource::collection($this->categories),
            'extras' => ExtrasResource::collection($this->extras),
            'modifiers' => ModifierResource::collection($this->modifierGroups),
        ];
    }
}
