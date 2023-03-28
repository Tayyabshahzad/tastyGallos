<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function modifiers(){
        return $this->belongsToMany(Modifier::class,'modifier_item');
    }

    public function modifierGroups(){
        return $this->belongsToMany(Modifier::class,'product_modifier');
    }

    public function activeModifierGroups(){
        return $this->modifierGroups()->where('status','active');
    }

    public function promotions(){
        return $this->belongsToMany(Promotion::class);
    }

    public function ordeDetails()
    {
        return $this->hasMany(Product::class);
    }

    // public function specialPrice()
    // {
    //     return $this->hasOne(SpecialPrice::class,'product_id','franchise_id','price');
    // }


    public function specialPrice()
    {
        return $this->hasMany(SpecialPrice::class);
    }
    public function orderProductItems()
    {
        return $this->hasManyThrough(OrderProductItem::class, OrderProduct::class);
    }
    // public function promotion(){
    //     return $this->hasMany(Promotion::class,'buy_product_id');
    // }

    public function extras(){
        return $this->belongsToMany(Extra::class)->withPivot('price');
    }

    public function productStatus(){
        return $this->hasMany(ProductStatus::class);
    }
    public function deals(){
        return $this->belongsToMany(Deal::class)->withPivot('product_quantity');
    }

    public function franchises()
    {
        return $this->belongsToMany(Franchise::class, 'franchise_product')  ->withPivot(['status']);
    }

    public function active_products()
    {
        return $this->belongsToMany(Franchise::class, 'franchise_product')->withPivot(['status'])->wherePivot('status', 'active');
    }


}
