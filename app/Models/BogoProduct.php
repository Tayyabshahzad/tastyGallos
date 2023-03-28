<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BogoProduct extends Model
{
    use HasFactory;
    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
    public function freeProduct()
    {
        return $this->belongsTo(Product::class,'free_product');
    }

    public function bogoExtra()
    {
        return $this->hasMany(BogoExtra::class,'bogo_product_id');
    }

    public function bogoModifiers()
    {
        return $this->hasMany(BogoModifier::class,'bogo_product_id');
    }

}
