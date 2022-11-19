<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourRu extends Model
{
    use HasFactory;
    protected $table = 'tours_ru';
    protected $fillable = ['name','category_id','destination_id','	type_id','home_tour_id','related_id','Itenanary','duration','start_date','end_date','price','one_day_price','one_week_price','one_month_price','one_year_price'];


    //each tour has many tourImages
    public function tourImages(){
        return $this->hasMany(TourRuImage::class);
    }

    //with image
    public function images()
    {
        return $this->belongsToMany(Image::class, 'tour_images_ru');
    }

    //relation with departureTable
    public function departureTable(){
        return $this->hasMany(DepartureRu::class);
    }



    //highlights
    public function highlights()
    {
        return $this->hasMany(TourRuHighlight::class, 'tour_ru_id');
    }


    public function related()
    {
        return $this->hasMany(relatedTour::class);
    }

    //facility
    public function facility()
    {
        return $this->hasMany(TourRuFacility::class);
    }

    //program
    public function program()
    {
        return $this->hasMany(TourRuProgram::class);
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
       return $this->hasMany(TourRuUseful::class, 'tour_ru_id');
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
