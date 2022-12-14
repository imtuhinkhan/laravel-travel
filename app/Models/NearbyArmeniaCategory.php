<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NearbyArmeniaCategory extends Model
{
    use HasFactory;
    protected $guarded = [];

    //relation with model
    public function things()
    {
        return $this->hasMany(NearbyArmenia::class);
    }
}
