<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\ThingsToDo;
use App\Models\ThingsToDoAm;
use App\Models\ThingsToDoRu;
use App\Models\ThingsToDoCategory;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ThingsToDoController extends Controller
{
    public function index()
    {


        $categories = ThingsToDoCategory::all();
        $things = ThingsToDo::simplePaginate(6);

        
        return view('Backend.Admin.Armenia.ThingsToDo.view', compact('categories', 'things'));
    }

    public function addRelated(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            "name" => "required",
            "description" => "required",
            "time" => "required",
            "address" => "required",
            "duration" => "required",
            "period" => "required",
            "distance" => "required",
            "price" => "",
            "category_id" => "required",
            "images" => "required",
        ]);

        if ($validate->fails()) {
            // return self::failure($validate->errors()->first());
            return redirect()
                ->bacK()
                ->with("msg", $validate->errors()->first())
                ->with("fail", true);
        }
        try {

            DB::beginTransaction();

            $things = ThingsToDo::create([
                "name" => $request->name,
                "description" => $request->description,
                "time" => $request->time,
                "address" => $request->address,
                "duration" => $request->duration,
                "period" => $request->period,
                "distance" => $request->distance,
                "price" => $request->price,
                "category_id" => $request->category_id,
                'related_id' => $id
            ]);

            foreach ($request->file('images') as  $image) {
                $imageName = $image->getClientOriginalName();
                $image->move("ThingsToDo/" . $things->id . "/", $imageName);
                $image = new Image();
                $image["filename"] = $imageName;
                $image["path"] = "ThingsToSee/" . $things->id . "/" . $imageName;
                $image->save();
                $things->images()->attach($image->id);
            }

            DB::commit();
            // return self::success("Tour added successfully!", ["data" => $image]);
            return redirect()->back()->with("msg", "Created successfully!")
                ->with("success", true);
        } catch (Exception $e) {
            DB::rollBack();
            // return $e;
            return self::failure('Error in adding tour data!', ["data" => $e->getMessage()]);
        }
    }

    public function createRelated($id)
    {
        $see = ThingsToDo::where('id', $id)->first();
        $categories = ThingsToDoCategory::all();

        $things = ThingsToDo::where('related_id', $id)->get();

        return view('Backend.Admin.Armenia.Related.ThingsToDoRelated', compact('see', 'categories', 'things'));
    }


    public function create()
    {
        $categories = ThingsToDoCategory::all();
        return view('Backend.Admin.Armenia.ThingsToDo.create', compact('categories'));
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
            "price" => "required",
            "category_id" => "required|string",
            "images" => "required",
        ]);

        $things = ThingsToDo::create([
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
            $image->move("ThingsToDo/" . $things->id . "/", $imageName);
            $image = new Image();
            $image["filename"] = $imageName;
            $image["path"] = "ThingsToDo/" . $things->id . "/" . $imageName;
            $image->save();
            $things->images()->attach($image->id);
        }

        $things = ThingsToDoAm::create([
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

        $things = ThingsToDoRu::create([
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


    public function show($id)
    {
        //
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
            "price" => "required",
            "map" => "required",
            "category_id" => "required|string",

        ]);
        if ($validate->fails()) {

            return redirect()
                ->back()
                ->with("msg", $validate->errors()->first())
                ->with("fail", true);
        }
        try {

            $things = ThingsToDo::find($id);
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
    
            $thingsRu = ThingsToDoRu::find($id);
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
    
            $thingsAm = ThingsToDoAm::find($id);
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

    public function edit($id)
    {
        $categories = ThingsToDoCategory::all();
        $things = ThingsToDo::find($id);
        $thingsAm = ThingsToDoAm::find($id);
        $thingsRu = ThingsToDoRu::find($id);
        return view('Backend.Admin.Armenia.ThingsToDo.update', compact('categories', 'things','thingsAm','thingsRu'));
    }


    public function destroy($id)
    {
        try {

            DB::beginTransaction();

            $things = ThingsToDo::find($id);
            $things->delete();
            $thingsAm = ThingsToDoAm::find($id);
            $thingsAm->delete();
            $thingsRu = ThingsToDoRu::find($id);
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

    public function getThingsToDoByCategory($id, $locale = null)
    {
        if (isset($locale) && in_array($locale, config('app.available_locales'))) {
            app()->setLocale($locale);
        }

        if(app()->getLocale()=='hy'){
            $things = ThingsToAm::with('images')->where('category_id', $id)->simplePaginate(9);

        }
        elseif(app()->getLocale()=='ru'){
            $things = ThingsToDoRu::with('images')->where('category_id', $id)->simplePaginate(9);


        }else{
            $things = ThingsToDo::with('images')->where('category_id', $id)->simplePaginate(9);

        }
        $category = ThingsToDoCategory::where('id', $id)->first();
        return view('Frontend.Armenia.ThingsToDo', compact('things', 'category'));
    }



    public function getThingsToDoById($id, $locale = null)
    {
        if (isset($locale) && in_array($locale, config('app.available_locales'))) {
            app()->setLocale($locale);
        }
        if(app()->getLocale()=='hy'){
            $things = ThingsToDoAm::with('images')->where('id', $id)->first();
        }
        elseif(app()->getLocale()=='ru'){
            $things = ThingsToDoRu::with('images')->where('id', $id)->first();

        }else{
            $things = ThingsToDo::with('images')->where('id', $id)->first();
        }
        $related = ThingsToDo::where('related_id', $id)->inRandomOrder()->simplePaginate(3);
        return view('Frontend.Armenia.ThingsToDoDetails', compact('things', 'related'));
    }

    //get all things to see
    public function getAllThingsToDo($locale = null)
    {
        if (isset($locale) && in_array($locale, config('app.available_locales'))) {
            app()->setLocale($locale);
        }
        if(app()->getLocale()=='hy'){
            $things = ThingsToDoAm::with('images')->simplePaginate(9);
        }
        elseif(app()->getLocale()=='ru'){
            $things = ThingsToDoRu::with('images')->simplePaginate(9);

        }else{
            $things = ThingsToDo::with('images')->simplePaginate(9);
        }
        return view('Frontend.Armenia.ThingsToDo', compact('things'));
    }
}
