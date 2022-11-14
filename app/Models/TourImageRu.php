<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourImageRu extends Model
{
    use HasFactory;
    protected $fillable = [
        "tour_id",
        "image_id"
    ];

    //----------- relations ---------
    public function tour(){
        return $this->belongsTo(TourRu::class);
    }

    // public function related(){
    //     return $this->belongsTo(relatedTour::class);
    // }

    
    public function image(){
        return $this->belongsTo(Image::class);
    }
    



    
}
