<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FranchiseWorkingHour extends Model
{
    use HasFactory;
    protected $fillable = ['opening_time','closing_time','status'];

    public function franchise()
    {
        return $this->belongsTo(Franchise::class);
    }

}
