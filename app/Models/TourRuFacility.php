<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourRuFacility extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "tour_ru_id",
        "unname"
    ];

    public function tour()
    {
        return $this->belongsTo(TourRu::class);
    }
}
