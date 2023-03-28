<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Franchise extends Model  implements HasMedia
{
    use HasFactory , InteractsWithMedia;


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function workingHours()
    {
        return $this->hasMany(FranchiseWorkingHour::class);
    }
    public function promotions(){
        return $this->belongsToMany(Promotion::class);
    }
    public function activePromotions(){
        return $this->promotions()->where('is_schedule',true);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function refunds()
    {
        return $this->hasMany(Refund::class);
    }
    public function productSpecialPrice()
    {
        return $this->hasMany(SpecialPrice::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'franchise_product')->withPivot(['status']);
    }

    public function active_products()
    {
        return $this->belongsToMany(Product::class, 'franchise_product')->withPivot(['status']);
    }
    public function deals(){
        return $this->belongsToMany(Deal::class);
    }

}
