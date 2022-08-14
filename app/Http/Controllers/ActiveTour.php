<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Tour;
use App\Models\TourCategory;
use App\Models\TourCMS;
use Illuminate\Http\Request;

class ActiveTour extends Controller
{
    public function getTours($locale = null)
    {

        if (isset($locale) && in_array($locale, config('app.available_locales'))) {
            app()->setLocale($locale);
        }
        
        $tour = Tour::with('images')->with('types')->where('category_id', 4)->orderBy('id', 'DESC')->simplePaginate(9);
        // $tour = Tour::with('images')->where('category_id', 4)->get();
        
        $category = TourCategory::where('id', 4)->first();

        $cms = TourCMS::all();
        
        return view('Frontend.ActiveTours.ActiveTours', compact('tour', 'category', 'cms'));
    }

    public function getClassicTour($id)
    {
        $tour = Tour::find($id);
        $relatedTour = Tour::where('category_id', 4)
        // ->where('id', '!=', $tour->id)
        ->with('images')
        ->with('types')
        ->with('useful')
        ->inRandomOrder()
        ->take(3)
        ->get();

        $reviews = Review::with('images')->where('category_id', 4)->take(4)->get();
        return view('Frontend.BasicTours.BasicTour', compact('tour','relatedTour','reviews'));
    }
}
