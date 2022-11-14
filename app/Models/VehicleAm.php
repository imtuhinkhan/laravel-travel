<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image;


class VehicleAm extends Model
{
    use HasFactory;
    protected $guarded = [];

    //relations
    public function type()
    {
        return $this->belongsTo(VehicleType::class);
    }

    public function images()
    {
        return $this->belongsToMany(Image::class, 'vehicle_images');
    }


    public function vehicleImages()
    {
        return $this->hasMany(VehicleAmImage::class);
    }


    public function booking()
    {
        return $this->hasMany(BookingACar::class);
    }

    // public function bookingDriver()
    // {
    //     return $this->hasMany(BookingACarWithDriver::class);
    // }





  

  


}


