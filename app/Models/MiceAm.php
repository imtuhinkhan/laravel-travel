<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MiceAm extends Model
{
    use HasFactory;


    protected $guarded = [];


    //----------- relations ---------
    public function images()
    {
        return $this->belongsToMany(Image::class, 'mice_am_images');
    }

    public function miceImages(){
        return $this->hasMany(MiceAmImage::class);
    }

    public function booking(){
        return $this->hasMany(BookingMice::class, 'mice_id');
    }
}
