<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Carbon instance fields
    protected $dates = ['time_ago'];

    protected $fillable = [
        'payment_clear',
    ];


    public function review()
    {
        return $this->hasOne(Review::class);
    }

    public function franchise()
    {
        return $this->belongsTo(Franchise::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function orderPromotions()
    {
        return $this->hasMany(OrderPromotion::class);
    }
    public function refund()
    {
        return $this->hasOne(Refund::class);
    }
    public function orderExtras()
    {
        return $this->hasMany(OrderProductExtra::class);
    }

    public function orderDeals()
    {
        return $this->hasMany(OrderDeal::class);
    }
    public function orderDealsExtra()
    {
        return $this->hasMany(DealExtra::class);
    }
    public function orderDealsModifiers()
    {
        return $this->hasMany(DealModifier::class);
    }

    public function bogoProducts()
    {
        return $this->hasMany(BogoProduct::class);
    }
    public function bogoExtras()
    {
        return $this->hasMany(BogoExtra::class);
    }

    public function bogoModifiers2()
    {
        return $this->hasMany(BogoModifier::class,'order_id');
    }


    public function orderDealProduct()
    {
        return $this->hasMany(OrderDealProduct::class);
    }
}
