<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MiceRuImage extends Model
{
    use HasFactory;

    protected $guarded = [];

    //----------- relations ---------
    public function mice(){
        return $this->belongsTo(MiceRu::class);
    }

    public function image(){
        return $this->belongsTo(Image::class);
    }
    
}
