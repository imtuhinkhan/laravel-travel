<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;

class CustomTourController extends Controller
{
  public function cityList(){
    $city = City::get();
    return view('Backend.Admin.CustomTour.city',compact('city'));
  }

  public function cityCreate(){
    return view('Backend.Admin.CustomTour.city_add_form');
  }

  public function cityStore(Request $request){
    $city = new City();
    $city->name = $request->name;
    $city->gmap = $request->map;
    $city->save();
    return redirect('/admin/city');
  }

  public function cityEdit($id){
    $city =  City::find($id);
    return view('Backend.Admin.CustomTour.city_edit_form',compact('city'));
  }

  public function cityUpdate(Request $request){
    $city =  City::find($request->cid);
    $city->name = $request->name;
    $city->gmap = $request->map;
    $city->save();
    return redirect('/admin/city');
  }

  public function cityDelete($id){
    $city =  City::find($id)->delete();
    return redirect()->back();
  }

  public function customTour(){

  }
}