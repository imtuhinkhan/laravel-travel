<?php

namespace App\Http\Controllers;

use App\Models\relatedTour;
use App\Models\Review;
use App\Models\Tour;
use App\Models\TourAm;
use App\Models\TourRu;
use App\Models\TourCategory;
use App\Models\TourCMS;
use Illuminate\Http\Request;

class GuranteeTour extends Controller
{
    public function getTours($locale = null)
    {

        if (isset($locale) && in_array($locale, config('app.available_locales'))) {
            app()->setLocale($locale);
        }

        if(app()->getLocale()=='hy'){
            $tour = TourAm::with('images')->with('types')->where('category_id', 2)->orderBy('id', 'DESC')->simplePaginate(9);
        }
        elseif(app()->getLocale()=='ru'){
            $tour = TourRu::with('images')->with('types')->where('category_id', 2)->orderBy('id', 'DESC')->simplePaginate(9);
        }
        else{
            $tour = Tour::with('images')->with('types')->where('category_id', 2)->orderBy('id', 'DESC')->simplePaginate(9);
        }

        $category = TourCategory::where('id', 2)->first();
        $cms = TourCMS::all();
        
        return view('Frontend.GuaranteeTour.Guarantee', compact('tour', 'category','cms'));
    }

    public function getClassicTour($id)
    {
        if(app()->getLocale()=='hy'){
            $tour = TourAm::find($id);
            $relatedTour = TourAm::where('related_id', $id)
            ->with('category')
            // ->where('id', '!=', $tour->id)
            ->with('images')
            ->inRandomOrder()
            ->take(3)
            ->get();
        }
        elseif(app()->getLocale()=='ru'){
            $tour = TourRu::find($id);
            $relatedTour = TourRu::where('related_id', $id)
            ->with('category')
            // ->where('id', '!=', $tour->id)
            ->with('images')
            ->inRandomOrder()
            ->take(3)
            ->get();
        }
        else{
            $tour = Tour::find($id);
            $relatedTour = Tour::where('related_id', $id)
            ->with('category')
            // ->where('id', '!=', $tour->id)
            ->with('images')
            ->inRandomOrder()
            ->take(3)
            ->get();
        }
        

        // $related = relatedTour::where('tour_id', $id)->get();

        $reviews = Review::with('images')->where('category_id', 2)->take(4)->get();
        return view('Frontend.BasicTours.BasicTour', compact('tour','relatedTour','reviews'));
    }
}
