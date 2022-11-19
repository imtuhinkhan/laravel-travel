<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelAmRoom extends Model
{
    use HasFactory;
    protected $guarded = [];

    // public function hotel()
    // {
    //     return $this->hasMany(Hotel::class);
    // }

    public function booking()
    {
        return $this->hasMany(BookingARoom::class);
    }

    public function hotel()
    {
        return $this->belongsTo(HotelAm::class);
    }
}
