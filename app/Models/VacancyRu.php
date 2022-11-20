<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VacancyRu extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function images()
    {
        return $this->belongsToMany(Image::class, 'vacancy_ru_images');
    }

    public function vacancyImages()
    {
        return $this->hasMany(VacancyRuImage::class);
    }

}
