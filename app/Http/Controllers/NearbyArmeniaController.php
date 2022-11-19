<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\NearbyArmenia;
use App\Models\NearbyRuArmenia;
use App\Models\NearbyAmArmenia;
use App\Models\NearbyArmeniaCategory;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class NearbyArmeniaController extends Controller
{
    
    public function index()
    {
        
        $categories = NearbyArmeniaCategory::all();
        $things = NearbyArmenia::simplePaginate(9);
        return view('Backend.Admin.Armenia.TODO.view', compact('categories','things'));

    }

   
    public function create()
    {
        $categories = NearbyArmeniaCategory::all();
        return view('Backend.Admin.Armenia.TODO.create', compact('categories'));
    }

  
    public function store(Request $request)
    {
        $request->validate([
         "name" => "required|string",
         "description" => "required|string",
         "time" => "required|string",
         "address" => "required|string",
         "duration" => "required|string",
         "period" => "required|string",
         "distance" => "required|string",
         "price" => "required|string",
         "category_id" => "required",
         "map" => "required",
         "images" => "required",
     ]);

     $things = NearbyArmenia::create([
         "name" => $request->name,
         "description" => $request->description,
         "time" => $request->time,
         "address" => $request->address,
         "duration" => $request->duration,
         "period" => $request->period,
         "distance" => $request->distance,
         "price" => $request->price,
         "map" => $request->map,
         "category_id" => $request->category_id,
     ]);



       
     foreach ($request->file('images') as  $image) {

         $imageName = $image->getClientOriginalName();
         $image->move("Nearby/" . $things->id . "/", $imageName);
         $image = new Image();
         $image["filename"] = $imageName;
         $image["path"] = "Nearby/" . $things->id . "/" . $imageName;
         $image->save();
         $things->images()->attach($image->id);
     
     }

     $things = NearbyAmArmenia::create([
        "name" => $request->name_am,
        "description" => $request->description_am,
        "time" => $request->time_am,
        "address" => $request->address_am,
        "duration" => $request->duration_am,
        "period" => $request->period_am,
        "distance" => $request->distance_am,
        "price" => $request->price_am,
        "map" => $request->map_am,
        "category_id" => $request->category_id_am,
    ]);



      
    foreach ($request->file('images_am') as  $image) {

        $imageName = $image->getClientOriginalName();
        $image->move("Nearby/" . $things->id . "/", $imageName);
        $image = new Image();
        $image["filename"] = $imageName;
        $image["path"] = "Nearby/" . $things->id . "/" . $imageName;
        $image->save();
        $things->images()->attach($image->id);
    
    }

    $things = NearbyRuArmenia::create([
        "name" => $request->name_ru,
        "description" => $request->description_ru,
        "time" => $request->time_ru,
        "address" => $request->address_ru,
        "duration" => $request->duration_ru,
        "period" => $request->period_ru,
        "distance" => $request->distance_ru,
        "price" => $request->price_ru,
        "map" => $request->map_ru,
        "category_id" => $request->category_id_ru,
    ]);



      
    foreach ($request->file('images_ru') as  $image) {

        $imageName = $image->getClientOriginalName();
        $image->move("Nearby/" . $things->id . "/", $imageName);
        $image = new Image();
        $image["filename"] = $imageName;
        $image["path"] = "Nearby/" . $things->id . "/" . $imageName;
        $image->save();
        $things->images()->attach($image->id);
    
    }

     return redirect()->back()->with("msg", "Created successfully!")
     ->with("success", true);
        
    }

 
    public function edit($id)
    {
        $categories = NearbyArmeniaCategory::all();
        $things = NearbyArmenia::find($id);
        $thingsRu = NearbyRuArmenia::find($id);
        $thingsAm = NearbyAmArmenia::find($id);
        return view('Backend.Admin.Armenia.TODO.update', compact('categories','things','thingsRu','thingsAm'));
    }


  
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            "name" => "required|string",
            "description" => "required|string",
            "time" => "required|string",
            "address" => "required|string",
            "duration" => "required|string",
            "period" => "required|string",
            "distance" => "required|string",
            "price" => "required|string",
            "category_id" => "required|string",
            
        ]);
        if ($validate->fails()) {
           
            return redirect()
                ->back()
                ->with("msg", $validate->errors()->first())
                ->with("fail", true);
        }
        try {
           
            $things = NearbyArmenia::find($id);
            $things->name = $request->name;
            $things->description = $request->description;
            $things->time = $request->time;
            $things->address = $request->address;
            $things->duration = $request->duration;
            $things->period = $request->period;
            $things->distance = $request->distance;
            $things->price = $request->price;
            $things->map = $request->map;
            $things->category_id = $request->category_id;
            $things->save();
    
            $thingsRu = NearbyRuArmenia::find($id);
            $thingsRu->name = $request->name_ru;
            $thingsRu->description = $request->description_ru;
            $thingsRu->time = $request->time_ru;
            $thingsRu->address = $request->address_ru;
            $thingsRu->duration = $request->duration_ru;
            $thingsRu->period = $request->period_ru;
            $thingsRu->distance = $request->distance_ru;
            $thingsRu->price = $request->price_ru;
            $thingsRu->map = $request->map_ru;
    
            $thingsRu->category_id = $request->category_id_ru;
            $thingsRu->save();
    
            $thingsAm = NearbyAmArmenia::find($id);
            $thingsAm->name = $request->name_am;
            $thingsAm->description = $request->description_am;
            $thingsAm->time = $request->time_am;
            $thingsAm->address = $request->address_am;
            $thingsAm->duration = $request->duration_am;
            $thingsAm->period = $request->period_am;
            $thingsAm->distance = $request->distance_am;
            $thingsAm->price = $request->price_am;
            $thingsAm->map = $request->map_am;
            $thingsAm->category_id = $request->category_id_am;
            $thingsAm->save();
            
            return redirect()
                ->back()
                ->with("msg", "Updated successfully!")
                ->with("success", true);
        } catch (Exception $e) {
            DB::rollBack();
            // return $e;
            return self::failure('Error in adding tour data!', ["data" => $e->getMessage()]);
        }

    }

  
    public function destroy($id)
    {
        try {
           
            DB::beginTransaction();
            
            $things = NearbyArmenia::find($id);
            $thingsAm = NearbyAmArmenia::find($id);
            $thingsRu = NearbyRuArmenia::find($id);
            $things->delete();
            $thingsAm->delete();
            $thingsRu->delete();
            DB::commit();
            
            return redirect()
                ->back()
                ->with("msg", "Deleted successfully!")
                ->with("success", true);
        } catch (Exception $e) {
            DB::rollBack();
            // return $e;
            return self::failure('Error in adding tour data!', ["data" => $e->getMessage()]);
        }

    }

    public function getNearbyByCategory($id ,$locale = null)
    {

        if (isset($locale) && in_array($locale, config('app.available_locales'))) {
            app()->setLocale($locale);
        }
        if(app()->getLocale()=='hy'){
            $things = NearbyAmArmenia::with('images')->where('category_id', $id)->simplePaginate(9);;

        }
        elseif(app()->getLocale()=='ru'){
            $things = NearbyRuArmenia::with('images')->where('category_id', $id)->simplePaginate(9);


        }else{
            $things = NearbyArmenia::with('images')->where('category_id', $id)->simplePaginate(9);

        }
        $category = NearbyArmeniaCategory::where('id', $id)->first();

        return view('Frontend.Armenia.nearby', compact('things', 'category'));
    }

   

    public function getNearbyById($id ,$locale = null)
    {

        if (isset($locale) && in_array($locale, config('app.available_locales'))) {
            app()->setLocale($locale);
        }
        if(app()->getLocale()=='hy'){
            $things = NearbyAmArmenia::with('images')->where('id', $id)->first();

        }
        elseif(app()->getLocale()=='ru'){
            $things = NearbyRuArmenia::with('images')->where('id', $id)->first();


        }else{
            $things = NearbyArmenia::with('images')->where('id', $id)->first();

        }
        //related
        $related = NearbyArmenia::with('images')->where('category_id', $things->category_id)->inRandomOrder()->simplePaginate(3);
        return view('Frontend.Armenia.NearbyDetails', compact('things','related'));
    }

    //get all things to see
    public function getAllNearby($locale = null)
    {

        if (isset($locale) && in_array($locale, config('app.available_locales'))) {
            app()->setLocale($locale);
        }
        $things = NearbyArmenia::all();
        return view('Frontend.Armenia.nearby', compact('things'));
    }


}
