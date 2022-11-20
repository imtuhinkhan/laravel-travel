<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourEventRuImage extends Model
{
    use HasFactory;


    protected $guarded = [];

    public function tourEvent()
    {
        return $this->belongsTo(TourRuEvent::class);
    }

    public function image()
    {
        return $this->belongsTo(Image::class);
    }
}
