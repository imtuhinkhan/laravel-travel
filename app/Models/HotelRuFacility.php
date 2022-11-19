<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelRuFacility extends Model
{
    use HasFactory;
    protected $guarded = [];

    //----------- relations ---------
    public function hotel()
    {
        return $this->belongsTo(HotelRu::class);
    }
}
