<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Meal;
use App\Models\Trip;
use App\Models\TripType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $trips = Trip::all();
    }

    /**
     * Show the trip form for creating a new trip.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $destinations = Destination::whereNull('deleted_at')->get();
        $types = TripType::whereNull('deleted_at')->get();
        $meals = Meal::whereNull('deleted_at')->get();
        
        //add view name
        return view("", [
            "destinations" => $destinations,
            "types" => $types,
            "meals" => $meals
        ]);
    }

    /**
     * Store a newly created trip in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(),[
            "name"=>"required|string",
            "destination_id"=>"required|integer",
             "start_date"=>"required",
             "adults"=>"required|integer",
             "children"=>"required|integer"
        ]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
