<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourRuEvent extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function tourEventImages()
    {
        return $this->hasMany(TourEventRuImage::class);
    }

    public function images()
    {
        return $this->belongsToMany(Image::class, 'tour_event_ru_images');
    }
}
