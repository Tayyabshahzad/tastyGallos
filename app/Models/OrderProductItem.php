<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProductItem extends Model
{
    use HasFactory;
    public function OrderProduct()
    {
        return $this->belongsTo(OrderProduct::class);
    }
    public function products()
    {
        return $this->hasManyThrough(Product::class, OrderProduct::class);
    }

    public function product(){
        return $this->belongsTo(Product::class, 'item_id', 'id');
    }
}
