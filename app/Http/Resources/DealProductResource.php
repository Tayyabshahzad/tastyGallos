<?php

namespace App\Http\Resources;

use App\Models\DealExtra;
use App\Models\DealModifier;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Session;

class DealProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
       // $extras = DealExtra::with('extra')->where('product_id',Session::get('deal_id_deal_data', 'default'))->get();
        $extras = DealExtra::with('extra')->where('product_id',$this->id)->where('order_id',Session::get('order_id_for_getting_deal_modifiers_and_extras','default'))->get();
        $modifiers = DealModifier::with('item')->where('product_id',$this->id)->where('order_id',Session::get('order_id_for_getting_deal_modifiers_and_extras','default'))->get();
        return [
            'id' => $this->id,
            'deal_id' => Session::get('deal_id_deal_data', 'default'),
            'name' => $this->name,
            'product_id' => $this->id,
            'description' => $this->description,
            'extras'=> NewDealExtraResources::collection($extras),
            'modifiers'=> NewDealModifierResources::collection($modifiers),
        ];
    }
}
