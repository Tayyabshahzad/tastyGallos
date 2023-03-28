<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function franchise()
    {
        return $this->belongsTo(Franchise::class);
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }



}
