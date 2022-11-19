<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\ThingsToSee;
use App\Models\ThingsToSeeAm;
use App\Models\ThingsToSeeRu;
use App\Models\ThingsToSeeCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ThingsToSeeController extends Controller
{

    public function index($locale = null)
    {
        if (isset($locale) && in_array($locale, config('app.available_locales'))) {
            app()->setLocale($locale);
        }
        $categories = ThingsToSeeCategory::all();
        $things = ThingsToSee::simplePaginate(9);
        return view('Backend.Admin.Armenia.ThingsToSee.view', compact('categories', 'things'));
    }

    public function addRelated(Request $request, $id){
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

            $things = ThingsToSee::create([
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
                $image->move("ThingsToSee/" . $things->id . "/", $imageName);
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

    public function createRelated($id){
        $see = ThingsToSee::where('id', $id)->first();
         $categories = ThingsToSeeCategory::all();

         $things = ThingsToSee::where('related_id', $id)->get();

        return view('Backend.Admin.Armenia.Related.ThingsToSeeRelated', compact('see', 'categories', 'things'));
    }


    public function create()
    {
        $categories = ThingsToSeeCategory::all();
        return view('Backend.Admin.Armenia.ThingsToSee.create', compact('categories'));
    }

    public function edit($id)
    {
        $categories = ThingsToSeeCategory::all();
        $things = ThingsToSee::find($id);
        $thingsAm = ThingsToSeeAm::find($id);
        $thingsRu = ThingsToSeeRu::find($id);
        return view('Backend.Admin.Armenia.ThingsToSee.update', compact('things', 'categories','thingsAm','thingsRu'));
    }


    public function store(Request $request)
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
            "map" => "required",
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

            $things = ThingsToSee::create([
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
                $image->move("ThingsToSee/" . $things->id . "/", $imageName);
                $image = new Image();
                $image["filename"] = $imageName;
                $image["path"] = "ThingsToSee/" . $things->id . "/" . $imageName;
                $image->save();
                $things->images()->attach($image->id);
            }


            $things = ThingsToSeeAm::create([
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
                $image->move("ThingsToSee/" . $things->id . "/", $imageName);
                $image = new Image();
                $image["filename"] = $imageName;
                $image["path"] = "ThingsToSee/" . $things->id . "/" . $imageName;
                $image->save();
                $things->images()->attach($image->id);
            }

            $things = ThingsToSeeRu::create([
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
                $image->move("ThingsToSee/" . $things->id . "/", $imageName);
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


    public function show($id)
    {
        //
    }



    public function update(Request $request, $id)
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
            "category_id" => "required",
            // "images" => "required",
        ]);

        $things = ThingsToSee::find($id);
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

        $thingsRu = ThingsToSeeRu::find($id);
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

        $thingsAm = ThingsToSeeAm::find($id);
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



        return redirect()->back()->with("msg", "Updated successfully!")
            ->with("success", true);
    }


    public function destroy($id)
    {
        $things = ThingsToSee::find($id);
        $thingsAm = ThingsToSeeAm::find($id);
        $thingsRu = ThingsToSeeRu::find($id);
        $things->delete();
        $thingsRu->delete();
        $thingsAm->delete();
        return redirect()->back()->with("msg", "Deleted successfully!")
            ->with("success", true);
    }
    public function getThingsToSeeByCategory($id, $locale = null)
    {
        if (isset($locale) && in_array($locale, config('app.available_locales'))) {
            app()->setLocale($locale);
        }
        if(app()->getLocale()=='hy'){
            $things = ThingsToSeeAm::with('images')->where('category_id', $id)->simplePaginate(9);

        }
        elseif(app()->getLocale()=='ru'){
            $things = ThingsToSeeRu::with('images')->where('category_id', $id)->simplePaginate(9);


        }else{
            $things = ThingsToSee::with('images')->where('category_id', $id)->simplePaginate(9);

        }
        $category = ThingsToSeeCategory::where('id', $id)->first();
        return view('Frontend.Armenia.ThingsToSee', compact('things', 'category'));
    }
    public function getThingsToSeeById($id, $locale = null)
    {
        if (isset($locale) && in_array($locale, config('app.available_locales'))) {
            app()->setLocale($locale);
        }
        if(app()->getLocale()=='hy'){
            $things = ThingsToSeeAm::with('images')->where('id', $id)->first();
        }
        elseif(app()->getLocale()=='ru'){
            $things = ThingsToSeeRu::with('images')->where('id', $id)->first();

        }else{
            $things = ThingsToSee::with('images')->where('id', $id)->first();
        }
        // $related = ThingsToSee::where('category_id', $things->category_id)->get();
        $related = ThingsToSee::where('related_id', $id)->inRandomOrder()->simplePaginate(3);
        return view('Frontend.Armenia.ThingsToSeeDetails', compact('things', 'related'));
    }

    //get all things to see
    public function getAllThingsToSee()
    {
        
        if(app()->getLocale()=='hy'){
            $things = ThingsToSeeAm::with('images')->simplePaginate(9);
        }
        elseif(app()->getLocale()=='ru'){
            $things = ThingsToSeeRu::with('images')->simplePaginate(9);

        }else{
            $things = ThingsToSee::with('images')->simplePaginate(9);
        }

        return view('Frontend.Armenia.ThingsToSee', compact('things'));
    }
}
