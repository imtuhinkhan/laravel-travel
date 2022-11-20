<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelAmBlog extends Model
{
    use HasFactory;

    protected $guarded = [];

    //----------- relations ---------
    public function images()
    {
        return $this->belongsToMany(Image::class, 'travel_blog_am_images');
    }

    public function travelBlogImages(){
        return $this->hasMany(TravelBlogAmImage::class);
    }


}
