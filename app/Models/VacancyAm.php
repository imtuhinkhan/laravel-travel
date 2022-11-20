<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VacancyAm extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function images()
    {
        return $this->belongsToMany(Image::class, 'vacancy_am_images');
    }

    public function vacancyImages()
    {
        return $this->hasMany(VacancyAmImage::class);
    }

}
