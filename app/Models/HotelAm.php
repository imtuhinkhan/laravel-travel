<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelAm extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function highlights()
    {
        return $this->hasMany(HotelAmHighlights::class);
    }



    public function rooms()
    {
        return $this->hasMany(HotelAmRoom::class);
    }

    public function images()
    {
        return $this->belongsToMany(Image::class, 'hotel_am_images');
    }


    public function hotelImages()
    {
        return $this->hasMany(HotelAmImage::class);
    }

    public function hotelFacilities()
    {
        return $this->hasMany(HotelAmFacility::class);
    }

    public function hotelInfo()
    {
        return $this->hasMany(HotelAmInfo::class);
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
        return $this->hasMany(HotelAmKey::class, 'hotel_am_id');
    }

    //booking a room
    public function bookingARoom()
    {
        return $this->hasMany(BookingARoom::class);
    }

  



}
