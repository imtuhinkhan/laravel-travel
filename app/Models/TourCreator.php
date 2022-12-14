<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourCreator extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function creatorDestination()
    {
        return $this->belongsTo(CreatorDestination::class, 'creator_destinations_id');
    }


}
