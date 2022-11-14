<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourAmProgram extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'tour_program_ams';

    public function tour()
    {
        return $this->belongsTo(TourAm::class);
    }
}
