<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Session;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'id' => $this->id,
            'user_name' => 'tayyab',
            'franchise_id' => Session::get('franchise_id_for_getting_product', 'default'),
            'name' => $this->name,
            'sell_on_its_own' => $this->sell_on_its_own,
            'price' => $this->specialPrice->where('franchise_id',Session::get('franchise_id_for_getting_product', 'default'))->first()->price ?? $this->final_price,
            //'franchise_id' => Session::get('franchise_id_for_getting_product', 'default'),
           // 'id' => $this->id,
            //'name' => $this->name,
            //'sell_on_its_own' => $this->sell_on_its_own,
            //  'price' =>$this->specialPrice->where('franchise_id',$GLOBALS['franchise_id_for_getting_product'])->first()->price?? $this->final_price,

            //'price' => $this->specialPrice->where('franchise_id', 4)->first()->price ?? $this->final_price,
            'vat' => $this->vat,
            'status' => $this->status,
            'description' => $this->description,
            //'photo' => $this->getFirstMediaUrl('products','thumb'),
            'photo' => ProductMediaResource::collection($this->getMedia('products')),
            'modifiers' => ModifierResource::collection($this->activeModifierGroups),
            // 'products' => $this->modifierGroups,
            // 'categories' => $this->whenPivotLoaded('category_product',function(){
            //                         return $this->pivot->categories;
            //             }),
            'categories' => CategoryResource::collection($this->categories),
            'extras' => ExtrasResource::collection($this->extras),
            'promotions' => PromotionResource2::collection($this->promotions),

            //'modifiers' => ModifierResource::collection($this->modifierGroups),

            //'categories' =>   $this->categories,
        ];

    }
}
