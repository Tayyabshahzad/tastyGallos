<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DealModifier extends Model
{
    use HasFactory;
    public function modifier()
    {
        return $this->belongsTo(Modifier::class,'modifier_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
    public function item()
    {
        return $this->belongsTo(Product::class,'item_id');
    }
}
