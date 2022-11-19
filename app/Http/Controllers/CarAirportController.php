<?php

namespace App\Http\Controllers;

use App\Models\CarAirport;
use App\Models\CarAirportRu;
use App\Models\CarAirportAm;
use Illuminate\Http\Request;

class CarAirportController extends Controller
{
   
    public function index()
    {
        
        $carAirports = CarAirport::all();
        return view('Backend.Admin.Services.CarAtAirport.view', compact('carAirports'));
    }

  
    public function create()
    {
        return view('Backend.Admin.Services.CarAtAirport.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'details' => 'required',
            'more_details' => 'required',
        ]);
        $carAirport = new CarAirport();
        $carAirport->details = $request->details;
        $carAirport->more_details = $request->more_details;
        $carAirport->save();

        $carAirportAm = new CarAirportAm();
        $carAirportAm->details = $request->details_am;
        $carAirportAm->more_details = $request->more_details_am;
        $carAirportAm->save();

        $carAirportRu = new CarAirportRu();
        $carAirportRu->details = $request->details_ru;
        $carAirportRu->more_details = $request->more_details_ru;
        $carAirportRu->save();
        
        return redirect()->back()->with("msg", "Added successfully!")
        ->with("success", true);
    }

    
    public function show($id)
    {
        //
    }

  
    public function edit($id)
    {
        //
    }

  
    public function update(Request $request, $id)
    {
        
        $request->validate([
            'details' => 'required',
            'more_details' => 'required',
        ]);
        $carAirport = CarAirport::find($id);
        $carAirport->details = $request->details;
        $carAirport->more_details = $request->more_details;
        $carAirport->save();
        return redirect()->back()->with("msg", "Upadated successfully!")
        ->with("success", true);
    }

 
    public function destroy($id)
    {
        //
    }


    //get all car airport frontend
    public function getAllCarAirport($locale = null)
    {
        if (isset($locale) && in_array($locale, config('app.available_locales'))) {
            app()->setLocale($locale);
        }
        $carAirports = CarAirport::all();
        return view('Frontend.Cars.MeetTheTransfer', compact('carAirports'));
    }
}
