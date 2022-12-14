<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThingsToSeeCategory extends Model
{
    use HasFactory;
    protected $guarded = [];


    //relations
    public function thingsToSee(){
        return $this->hasMany(ThingsToSee::class);
    }
}
