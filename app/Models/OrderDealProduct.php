<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDealProduct extends Model
{
    use HasFactory;

    public function order()
    {
        return $this->belongsTo(Order::class);
    }


    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }




    public function dealExtras()
    {
        return $this->hasMany(DealExtra::class);
    }

    public function dealModifiers()
    {
        return $this->hasMany(DealModifier::class);
    }

}
