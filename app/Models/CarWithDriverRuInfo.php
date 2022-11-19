<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarWithDriverRuInfo extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'overview', 'model', 'type', 'seats', 'cancelation_fee'];
}
