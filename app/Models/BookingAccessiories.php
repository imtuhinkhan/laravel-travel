<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingAccessiories extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function accessiories()
    {
        return $this->belongsTo(Accessiories::class);
    }
    
}
