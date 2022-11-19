<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MiceAmImage extends Model
{
    use HasFactory;

    protected $guarded = [];

    //----------- relations ---------
    public function mice(){
        return $this->belongsTo(MiceAm::class);
    }

    public function image(){
        return $this->belongsTo(Image::class);
    }
    
}
