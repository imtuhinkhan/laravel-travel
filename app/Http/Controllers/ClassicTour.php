<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Tour;
use App\Models\TourRu;
use App\Models\TourAm;
use App\Models\TourCategory;
use App\Models\TourCMS;
use Illuminate\Http\Request;
use App\Models\RelatedTour;

class ClassicTour extends Controller
{
    public function getClasicTours($locale = null)
    {
        if (isset($locale) && in_array($locale, config('app.available_locales'))) {
            app()->setLocale($locale);
        }

        if(app()->getLocale()=='hy'){
            $tour = TourAm::with('images')->with('types')->where('category_id', 1)->orderBy('id', 'DESC')->simplePaginate(9);
        }
        elseif(app()->getLocale()=='ru'){
            $tour = TourRu::with('images')->with('types')->where('category_id', 1)->orderBy('id', 'DESC')->simplePaginate(9);

        }else{
            $tour = Tour::with('images')->with('types')->where('category_id', 1)->orderBy('id', 'DESC')->simplePaginate(9);
            
        }

        $category = TourCategory::where('id', 1)->first();

        $cms = TourCMS::all();

        return view('Frontend.BasicTours.BasicTours', compact('tour', 'category', 'cms'));
    }

    //get one day tour

    public function getClassicTour($id, $locale = null)
    {
        if (isset($locale) && in_array($locale, config('app.available_locales'))) {
            app()->setLocale($locale);
        }
        $related = RelatedTour::where('tour_id',$id)->pluck('related_tour_id');
        $relatedTour = [];
        foreach($related as $row){
            $relatedTour[]= $row;
        }
        if(app()->getLocale()=='hy'){
            $tour = TourAm::with('images')
            ->with('highlights')
            ->with('facility')
            ->with('program')
            ->with('types')
            ->with('useful')
            ->with('departureTable')
            ->where('id', $id)->first();
       
        //admin will select from the option tour to show in related tours sections

        $relatedTour = TourAm::whereIn('id', $relatedTour)
            ->with('category')
            // ->where('id', '!=', $tour->id)
            ->with('images')
            ->inRandomOrder()
            ->take(3)
            ->get();
        }
        elseif(app()->getLocale()=='ru'){
          
            $tour = TourRu::with('images')
            ->with('highlights')
            ->with('facility')
            ->with('program')
            ->with('types')
            ->with('useful')
            ->with('departureTable')
            ->where('id', $id)->first();
            $relatedTour = TourRu::whereIn('id', $relatedTour)
            ->with('category')
            // ->where('id', '!=', $tour->id)
            ->with('images')
            ->inRandomOrder()
            ->take(3)
            ->get();
        }else{

            $tour = Tour::with('images')
            ->with('highlights')
            ->with('facility')
            ->with('program')
            ->with('types')
            ->with('useful')
            ->with('departureTable')
            ->where('id', $id)->first();

            $relatedTour = Tour::whereIn('id', $relatedTour)
            ->with('category')
            // ->where('id', '!=', $tour->id)
            ->with('images')
            ->inRandomOrder()
            ->take(3)
            ->get();
         }

        $category = TourCategory::where('id', 1)->first();

        

        // $related = relatedTour::where($id, 'tour_id');


        //get reviews

        $reviews = Review::with('images')->where('category_id', 1)->take(4)->get();

        return view('Frontend.BasicTours.BasicTour', compact('tour', 'category', 'relatedTour',  'reviews'));
    }
}
