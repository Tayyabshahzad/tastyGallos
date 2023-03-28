<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BogoExtra extends Model
{
    use HasFactory;
    public function bogoExtras(){
        return $this->belongsTo(BogoProduct::class);
    }

    public function extra(){
        return $this->belongsTo(Extra::class);
    }

}
