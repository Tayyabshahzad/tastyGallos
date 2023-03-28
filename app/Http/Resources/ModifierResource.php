<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ModifierResource extends JsonResource
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
            'select_min_options' => $this->select_min_options,
            'select_max_options' => $this->select_max_options,
            'option_selected_times' => $this->option_selected_times,
            'status' => $this->status,
            'choose_quantity' => $this->choose_quantity,
            'items' => ModifierItemResource::collection($this->items),
        ];
    }
}
