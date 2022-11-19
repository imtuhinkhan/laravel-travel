<?php

namespace App\Http\Controllers;

use App\Models\FoodArmenia;
use App\Models\FoodAmArmenia;
use App\Models\FoodRuArmenia;
use App\Models\FoodArmeniaCategory;
use App\Models\Image;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class FoodArmeniaController extends Controller
{
    public function index()
    {
        $categories = FoodArmeniaCategory::all();
        $foods = FoodArmenia::simplePaginate(9);
        return view('Backend.Admin.Armenia.FoodAndDrink.view', compact('categories','foods'));
    }


    public function create()
    {
        $categories = FoodArmeniaCategory::all();
        return view('Backend.Admin.Armenia.FoodAndDrink.create', compact('categories'));
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
         "price" => "required|numeric",
         "category_id" => "required|string",
         "images" => "required",
     ]);

     $things = FoodArmenia::create([
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
         $image->move("Food/" . $things->id . "/", $imageName);
         $image = new Image();
         $image["filename"] = $imageName;
         $image["path"] = "Food/" . $things->id . "/" . $imageName;
         $image->save();
         $things->images()->attach($image->id);

     }

     $things = FoodAmArmenia::create([
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
        $image->move("ThingsToDo/" . $things->id . "/", $imageName);
        $image = new Image();
        $image["filename"] = $imageName;
        $image["path"] = "ThingsToDo/" . $things->id . "/" . $imageName;
        $image->save();
        $things->images()->attach($image->id);
    }

    $things = FoodRuArmenia::create([
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
        $image->move("ThingsToDo/" . $things->id . "/", $imageName);
        $image = new Image();
        $image["filename"] = $imageName;
        $image["path"] = "ThingsToDo/" . $things->id . "/" . $imageName;
        $image->save();
        $things->images()->attach($image->id);
    }

     return redirect()->back()->with("msg", "Created successfully!")
     ->with("success", true);

    }




    public function edit($id)
    {
        $categories = FoodArmeniaCategory::all();
        $food = FoodArmenia::find($id);
        $foodAm = FoodAmArmenia::find($id);
        $foodRu = FoodRuArmenia::find($id);
        return view('Backend.Admin.Armenia.FoodAndDrink.update', compact('categories','food','foodAm','foodRu'));
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
            "price" => "required|numeric",
            "category_id" => "required",

        ]);
        if ($validate->fails()) {

            return redirect()
                ->back()
                ->with("msg", $validate->errors()->first())
                ->with("fail", true);
        }
        try {

            $things = FoodArmenia::find($id);
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
    
            $thingsRu = FoodRuArmenia::find($id);
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
    
            $thingsAm = FoodAmArmenia::find($id);
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

            $things = FoodArmenia::find($id);
            $things->delete();
            $thingsAm = FoodAmArmenia::find($id);
            $thingsAm->delete();
            $thingsRu = FoodRuArmenia::find($id);
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

    public function getfoodsByCategory($id, $locale= null)
    {
        if (isset($locale) && in_array($locale, config('app.available_locales'))) {
            app()->setLocale($locale);
        }
        if(app()->getLocale()=='hy'){
            $foods = FoodAmArmenia::with('images')->where('category_id', $id)->simplePaginate(9);
        }
        elseif(app()->getLocale()=='ru'){
            $foods = FoodRuArmenia::with('images')->where('category_id', $id)->simplePaginate(9);
        }else{
            $foods = FoodArmenia::with('images')->where('category_id', $id)->simplePaginate(9);
        }
        $category = FoodArmeniaCategory::where('id', $id)->first();
        return view('Frontend.Armenia.Foods', compact('foods', 'category'));
    }



    public function getfoodsById($id, $locale= null)
    {
        if (isset($locale) && in_array($locale, config('app.available_locales'))) {
            app()->setLocale($locale);
        }
        if(app()->getLocale()=='hy'){
            $foods = FoodAmArmenia::with('images')->where('id', $id)->first();
        }
        elseif(app()->getLocale()=='ru'){
            $foods = FoodRuArmenia::with('images')->where('id', $id)->first();
        }else{
            $foods = FoodArmenia::with('images')->where('id', $id)->first();
        }
        $related = FoodArmenia::with('images')->where('category_id', $id)->inRandomOrder()->simplePaginate(3);
        return view('Frontend.Armenia.food', compact('foods','related'));
    }

}
