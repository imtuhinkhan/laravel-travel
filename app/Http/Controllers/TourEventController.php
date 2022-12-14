<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use App\Models\TourEvent;
use App\Models\TourAmEvent;
use App\Models\TourRuEvent;

class TourEventController extends Controller
{
  
    public function index()
    {
        
        $tour_events = TourEvent::all();
        
        return view('Backend.Admin.Armenia.Events.view', compact('tour_events'));
        
    }

   
    public function create()
    {
        return view('Backend.Admin.Armenia.Events.create');
    }

  
    public function store(Request $request)
    {
       
        // $tour_event = new TourEvent;
        // $tour_event->name = $request->name;
        // $tour_event->location = $request->location;
        // $tour_event->time = $request->time;
        // $tour_event->type = $request->type;
        // $tour_event->period = $request->period;
        // $tour_event->settlement = $request->settlement;
        // $tour_event->distance = $request->distance;
        // $tour_event->duration = $request->duration;
        // $tour_event->price = $request->price;
        // $tour_event->save();


        
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'time' => 'required',
            'type' => 'required',
            'period' => 'required',
            'settlement' => 'required',
            'distance' => 'required',
            'duration' => 'required',
            'price' => 'required',
            'images' => 'required',

            'name_am' => 'required',
            'location_am' => 'required',
            'time_am' => 'required',
            'type_am' => 'required',
            'period_am' => 'required',
            'settlement_am' => 'required',
            'distance_am' => 'required',
            'duration_am' => 'required',
            'price_am' => 'required',
            'images_am' => 'required',

            'name_ru' => 'required',
            'location_ru' => 'required',
            'time_ru' => 'required',
            'type_ru' => 'required',
            'period_ru' => 'required',
            'settlement_ru' => 'required',
            'distance_ru' => 'required',
            'duration_ru' => 'required',
            'price_ru' => 'required',
            'images_ru' => 'required',

        ]);

        $tour_event = TourEvent::create([
            'name' => $request->name,
            'location' => $request->location,
            'time' => $request->time,
            'type' => $request->type,
            'period' => $request->period,
            'settlement' => $request->settlement,
            'distance' => $request->distance,
            'duration' => $request->duration,
            'price' => $request->price,
        
        ]);
        

        foreach ($request->file('images') as  $image) {

            $imageName = $image->getClientOriginalName();
            $image->move("Event/" . $tour_event->id . "/", $imageName);
            $image = new Image();
            $image["filename"] = $imageName;
            $image["path"] = "Event/" . $tour_event->id . "/" . $imageName;
            $image->save();
            $tour_event->images()->attach($image->id);
        
        }

        $tour_event = TourAmEvent::create([
            'name' => $request->name_am,
            'location' => $request->location_am,
            'time' => $request->time_am,
            'type' => $request->type_am,
            'period' => $request->period_am,
            'settlement' => $request->settlement_am,
            'distance' => $request->distance_am,
            'duration' => $request->duration_am,
            'price' => $request->price_am,
        
        ]);
        

        foreach ($request->file('images_am') as  $image) {
            $imageName = $image->getClientOriginalName();
            $image->move("Event/" . $tour_event->id . "/", $imageName);
            $image = new Image();
            $image["filename"] = $imageName;
            $image["path"] = "Event/" . $tour_event->id . "/" . $imageName;
            $image->save();
            $tour_event->images()->attach($image->id);
        
        }

        $tour_event = TourRuEvent::create([
            'name' => $request->name_ru,
            'location' => $request->location_ru,
            'time' => $request->time_ru,
            'type' => $request->type_ru,
            'period' => $request->period_ru,
            'settlement' => $request->settlement_ru,
            'distance' => $request->distance_ru,
            'duration' => $request->duration_ru,
            'price' => $request->price_ru,
        
        ]);
        

        foreach ($request->file('images_ru') as  $image) {
            $imageName = $image->getClientOriginalName();
            $image->move("Event/" . $tour_event->id . "/", $imageName);
            $image = new Image();
            $image["filename"] = $imageName;
            $image["path"] = "Event/" . $tour_event->id . "/" . $imageName;
            $image->save();
            $tour_event->images()->attach($image->id);
        
        }

        return redirect()->back()->with("msg", "Created successfully!")
        ->with("success", true);
        
    }

    public function show($id)
    {
        //show the details of the selected tour event
        
        $tour_event = TourEvent::find($id)
        ->with('images')
        ->where('id', $id)
        ->first();
        return view('Backend.Admin.Armenia.Events.show', compact('tour_event'));
        
    }

    public function edit($id)
    {
        //edit the selected tour event
        $tour_event = TourEvent::find($id)
        ->with('images')
        ->where('id', $id)
        ->first();
        $tour_event_am = TourAmEvent::find($id);
        $tour_event_ru = TourRuEvent::find($id);

        return view('Backend.Admin.Armenia.Events.update', compact('tour_event','tour_event_am','tour_event_ru'));
    }


  
    public function update(Request $request, $id)
    {
        //update the selected tour event
        $tour_event = TourEvent::find($id);
        $tour_event->name = $request->name;
        $tour_event->location = $request->location;
        $tour_event->time = $request->time;
        $tour_event->type = $request->type;
        $tour_event->period = $request->period;
        $tour_event->settlement = $request->settlement;
        $tour_event->distance = $request->distance;
        $tour_event->duration = $request->duration;
        $tour_event->price = $request->price;
        $tour_event->save();

        $tour_event = TourAmEvent::find($id);
        $tour_event->name = $request->name_am;
        $tour_event->location = $request->location_am;
        $tour_event->time = $request->time_am;
        $tour_event->type = $request->type_am;
        $tour_event->period = $request->period_am;
        $tour_event->settlement = $request->settlement_am;
        $tour_event->distance = $request->distance_am;
        $tour_event->duration = $request->duration_am;
        $tour_event->price = $request->price_am;
        $tour_event->save();

        $tour_event = TourRuEvent::find($id);
        $tour_event->name = $request->name_ru;
        $tour_event->location = $request->location_ru;
        $tour_event->time = $request->time_ru;
        $tour_event->type = $request->type_ru;
        $tour_event->period = $request->period_ru;
        $tour_event->settlement = $request->settlement_ru;
        $tour_event->distance = $request->distance_ru;
        $tour_event->duration = $request->duration_ru;
        $tour_event->price = $request->price_ru;
        $tour_event->save();
        
        return redirect()->back()->with("msg", "Updated successfully!")
        ->with("success", true);
    }


    public function destroy($id)
    {
        $tour_event = TourEvent::find($id);
        $tour_event->delete();
        return redirect()->back()->with("msg", "Deleted successfully!")
        ->with("success", true);
    }

    //show the data in the frontend
    public function showFrontend($locale = null)
    {
        
        if (isset($locale) && in_array($locale, config('app.available_locales'))) {
            app()->setLocale($locale);
        }
        if(app()->getLocale()=='hy'){
            $tour_events = TourAmEvent::all();
        }
        elseif(app()->getLocale()=='ru'){
            $tour_events = TourRuEvent::all();
        }
        else{
            $tour_events = TourEvent::all();
        }
        return view('Frontend.Conferences.Conferences', compact('tour_events'));
    }

    //show the data in the frontend
    public function showFrontendDetails($id, $locale = null)
    {
        if (isset($locale) && in_array($locale, config('app.available_locales'))) {
            app()->setLocale($locale);
        }

        if(app()->getLocale()=='hy'){
            $tour_event = TourAmEvent::find($id)
            ->with('images')
            ->where('id', $id)
            ->first();
        }
        elseif(app()->getLocale()=='ru'){
            $tour_event = TourRuEvent::find($id)
            ->with('images')
            ->where('id', $id)
            ->first();
        }
        else{
            $tour_event = TourEvent::find($id)
            ->with('images')
            ->where('id', $id)
            ->first();
        }
        
        
        return view('Frontend.Armenia.ThingsToSeePage', compact('tour_event'));
    }
}
