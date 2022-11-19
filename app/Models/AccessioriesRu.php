<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessioriesRu extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function images()
    {
        return $this->belongsToMany(Image::class, 'accessiories_ru_images');
    }

    // accessiories_images
    public function accessioriesImages()
    {
        return $this->hasMany(AccessioriesRuImage::class);
    }

    //booking 
    public function bookingAccessiories()
    {
        return $this->hasMany(BookingAccessiories::class);
    }


}
