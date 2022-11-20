<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VacancyAmImage extends Model
{
    use HasFactory;

    protected $guarded = [];


    //----------- relations ---------
    public function vacancy()
    {
        return $this->belongsTo(VacancyRu::class);
    }

    public function image()
    {
        return $this->belongsTo(Image::class);
    }
}
