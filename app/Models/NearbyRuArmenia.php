<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NearbyRuArmenia extends Model
{
    use HasFactory;
    protected $guarded = [];


    //relation with category
    public function category()
    {
        return $this->belongsTo(NearbyArmeniaCategory::class, 'category_id');
    }


    public function images()
    {
        return $this->belongsToMany(Image::class, 'nearby_armenia_ru_images');
    }

    // relation with NearbyArmeniaImages
    public function nearbyArmeniaImages()
    {
        return $this->hasMany(NearbyArmeniaRuImages::class);
    }

}
