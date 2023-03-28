<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deal extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    public function products(){
        return $this->belongsToMany(Product::class)->withPivot('product_quantity');
    }
    public function categories(){
        return $this->belongsToMany(Category::class);
    }
    public function franchises(){
        return $this->belongsToMany(Franchise::class);
    }
}
