<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelRu extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function highlights()
    {
        return $this->hasMany(HotelRuHighlights::class);
    }



    public function rooms()
    {
        return $this->hasMany(HotelRuRoom::class);
    }

    public function images()
    {
        return $this->belongsToMany(Image::class, 'hotel_ru_images');
    }


    public function hotelImages()
    {
        return $this->hasMany(HotelRuImage::class);
    }

    public function hotelFacilities()
    {
        return $this->hasMany(HotelRuFacility::class);
    }

    public function hotelInfo()
    {
        return $this->hasMany(HotelRuInfo::class);
    }

    public function hotelType()
    {
        return $this->belongsTo(HotelType::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }


    public function hotelKeys()
    {
        return $this->hasMany(HotelRuKey::class, 'hotel_ru_id');
    }

    //booking a room
    public function bookingARoom()
    {
        return $this->hasMany(BookingARoom::class);
    }

  



}
