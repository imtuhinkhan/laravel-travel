<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourAmEvent extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function tourEventImages()
    {
        return $this->hasMany(TourEventAmImage::class);
    }

    public function images()
    {
        return $this->belongsToMany(Image::class, 'tour_event_am_images');
    }
}
