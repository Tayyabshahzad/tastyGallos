<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BogoModifier extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
    public function item()
    {
        return $this->belongsTo(Product::class,'item_id');
    }
    public function modifier()
    {
        return $this->belongsTo(Product::class,'modifier_id');
    }

    public function bogoModifier()
    {
        return $this->belongsTo(Modifier::class,'modifier_id');
    }
}
