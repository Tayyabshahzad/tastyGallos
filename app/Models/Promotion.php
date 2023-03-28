<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
class Promotion extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    public function franchises(){
        return $this->belongsToMany(Franchise::class);
    }
    public function products(){
        return $this->belongsToMany(Product::class);
    }
    public function buyProduct(){
        return $this->belongsTo(Product::class,'buy_product_id');
    }
    public function getProduct(){
        return $this->belongsTo(Product::class,'get_product_id');
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }


}
