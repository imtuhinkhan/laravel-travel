<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessioriesRuImage extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function accessory()
    {
        return $this->belongsTo(AccessioriesRu::class);
    }

    public function image()
    {
        return $this->belongsTo(Image::class);
    }

}
