<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThingsToSeeRu extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function category(){
        return $this->belongsTo(ThingsToSeeCategory::class);
    }
    public function images()
    {
        return $this->belongsToMany(Image::class, 'things_to_see_ru_images');
    }

    public function thingsToSeeImages()
    {
        return $this->hasMany(ThingsToSeeImageRu::class);
    }

  
}