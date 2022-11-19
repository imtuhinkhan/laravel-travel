<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourRuProgram extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'tour_program_rus';
    public function tour()
    {
        return $this->belongsTo(TourRu::class);
    }
}
