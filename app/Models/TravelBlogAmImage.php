<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelBlogAmImage extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function travelBlog()
    {
        return $this->belongsTo(TravelAmBlog::class);
    }

    public function image()
    {
        return $this->belongsTo(Image::class);
    }
    
}
