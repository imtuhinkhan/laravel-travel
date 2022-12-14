<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThingsToDoAm extends Model
{
    use HasFactory;
    protected $guarded = [];

    //relation with category
    public function category()
    {
        return $this->belongsTo(ThingsToDoCategory::class, 'category_id');
    }

    public function images()
    {
        return $this->belongsToMany(Image::class, 'things_to_do_am_images');
    }

    public function thingsToDoImages()
    {
        return $this->hasMany(ThingsToDoAmsImages::class);
    }
}
