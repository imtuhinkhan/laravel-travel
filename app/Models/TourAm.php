<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourAm extends Model
{
    use HasFactory;
    protected $table = 'tours_am';
    protected $fillable = ['name','category_id','destination_id','	type_id','home_tour_id','related_id','Itenanary','duration','start_date','end_date','price','one_day_price','one_week_price','one_month_price','one_year_price'];


    //each tour has many tourImages
    public function tourImages(){
        return $this->hasMany(TourImageAm::class);
    }

    //with image
    public function images()
    {
        return $this->belongsToMany(Image::class, 'tour_images_am');
    }

    //relation with departureTable
    public function departureTable(){
        return $this->hasMany(DepartureAm::class);
    }



    //highlights
    public function highlights()
    {
        return $this->hasMany(TourAmHighlight::class, 'tour_am_id');
    }


    public function related()
    {
        return $this->hasMany(relatedTour::class);
    }

    //facility
    public function facility()
    {
        return $this->hasMany(TourAmFacility::class);
    }

    //program
    public function program()
    {
        return $this->hasMany(TourAmProgram::class);
    }

    //category
    public function category(){
        return $this->belongsTo(TourCategory::class);
    }

   //tour has many type
   public function types(){
       return $this->hasMany(Type::class, 'tour_id');
   }

   public function homeTour(){
       return $this->belongsTo(HomeTour::class, 'home_tours');
   }

   public function useful()
   {
       return $this->hasMany(TourAmUseful::class, 'tour_am_id');
   }

    public function booking()
    {
         return $this->hasMany(BookATour::class, 'tour_id');
    }


    public function bookingDeparture()
    {
         return $this->hasMany(BookATourDeparture::class, 'tour_id');
    }


}
