<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodArmeniaRuImages extends Model
{
    use HasFactory;
    protected $guarded = [];

    //relation with image
    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    //relation with food and drink
    public function foodArmenia()
    {
        return $this->belongsTo(FoodRuArmenia::class);
    }
    
}
