<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarAirportRu extends Model
{
    use HasFactory;
    protected $table = 'car_airpot_ru';

    protected $fillable = [
        'details',
        'more_details',
    ];
}
