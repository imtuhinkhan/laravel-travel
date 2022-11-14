<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartureAm extends Model
{
    use HasFactory;

    protected $guarded = [];


    //relation with tour
    public function tour(){
        return $this->belongsTo(TourAm::class);
    }
}
