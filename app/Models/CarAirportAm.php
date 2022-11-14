<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarAirportAm extends Model
{
    use HasFactory;
    protected $table = 'car_airpot_am';

    protected $fillable = [
        'details',
        'more_details',
    ];
}
