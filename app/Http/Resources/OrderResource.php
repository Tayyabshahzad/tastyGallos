<?php

namespace App\Http\Resources;

use App\Models\BogoProduct;
use App\Models\Order;
use App\Models\OrderDeal;
use App\Models\OrderProduct;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
       $dealTotal =  OrderDeal::where('order_id',$this->id)->sum('quantity');
       $itemTotal =  OrderProduct::where('order_id',$this->id)->sum('quantity');
       $bogoTotal =  BogoProduct::where('order_id',$this->id)->sum('quantity');
        return [
            'id' => $this->id,
            'order_number' => $this->order_number,
            'total' => $this->total,
            'sub_total' => $this->sub_total,
            'status' => $this->status,
            'items' => ($itemTotal+$dealTotal+$bogoTotal),
            'franchise' => FranchiseOrderResource::make($this->franchise),
            'order_type' => $this->type,
            "payment_method" => $this->payment_method,
            'discount' => $this->discount,
            'address' =>   json_decode($this->address),
            'created_at'=>   $this->created_at->getPreciseTimestamp(3),
            'has_review'=>   $this->has_review,
            'note'=>   $this->note,
            'vat'=>   $this->tax,
            'delivery_charges'=>   $this->delivery_charges,
            'grandTotal'=>   $this->grandTotal,
            //'categories' => CategoryResource::collection($this->categories),
            //'extras' => ExtrasResource::collection($this->extras),
            //'modifiers' => ModifierResource::collection($this->modifierGroups),

            //'categories' =>   $this->categories,
        ];
    }
}
