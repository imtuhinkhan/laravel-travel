<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelRuHighlights extends Model
{
    use HasFactory;

    protected $guarded = [];



    public function hotel()
    {
        return $this->belongsTo(HotelRu::class);
    }
}
