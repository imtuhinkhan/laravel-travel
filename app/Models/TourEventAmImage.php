<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourEventAmImage extends Model
{
    use HasFactory;


    protected $guarded = [];

    public function tourEvent()
    {
        return $this->belongsTo(TourAmEvent::class);
    }

    public function image()
    {
        return $this->belongsTo(Image::class);
    }
}
