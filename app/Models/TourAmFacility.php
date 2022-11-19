<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourAmFacility extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "tour_am_id",
        "unname"
    ];

    public function tour()
    {
        return $this->belongsTo(TourAm::class);
    }
}
