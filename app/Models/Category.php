<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
class Category extends Model
{
    use HasFactory , LogsActivity;

    protected $fillable = ['name','status'];
    // public function getActivitylogOptions(): LogOptions
    // {
    //     return LogOptions::defaults()
    //     ->logOnly(['name', 'status']);
    //     // Chain fluent methods for configuration options
    // }


    public function products(){
        return $this->belongsToMany(Product::class);
    }

    public function deals(){
        return $this->belongsToMany(Deal::class);
    }
}
