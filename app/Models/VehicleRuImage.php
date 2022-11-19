<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleRuImage extends Model
{
    use HasFactory;
    protected $guarded = [];


    //relations
    public function vehicle()
    {
        return $this->belongsTo(VehicleRu::class);
    }

    public function image()
    {
        return $this->belongsTo(Image::class);
    }

 
 

    
}
