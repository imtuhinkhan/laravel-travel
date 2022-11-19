<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NearbyArmeniaAmImages extends Model
{
    use HasFactory;
    protected $guarded = [];

    // relation with NearbyArmenia
    public function nearbyArmenia()
    {
        return $this->belongsTo(NearbyAmArmenia::class);
    }

    // relation with Image
    public function image()
    {
        return $this->belongsTo(Image::class);
    }

}
