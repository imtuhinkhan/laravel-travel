<?php

namespace App\Http\Controllers;

use App\Models\DepartureTable;
use App\Models\DepartureRu;
use App\Models\DepartureAm;
use App\Models\Destination;
use App\Models\HomeTour;
use App\Models\Image;
use App\Models\Tour;
use App\Models\TourRu;
use App\Models\TourAm;
use App\Models\TourCategory;
use App\Models\TourFacility;
use App\Models\TourAmFacility;
use App\Models\TourRuFacility;
use App\Models\TourHighlight;
use App\Models\TourAmHighlight;
use App\Models\TourRuHighlight;

use App\Models\TourProgram;
use App\Models\TourAmProgram;
use App\Models\TourRuProgram;
use App\Models\TourUseful;
use App\Models\TourRuUseful;
use App\Models\TourAmUseful;
use App\Models\Type;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TourController extends Controller
{

    public function index($name)
    {
        //
        $cat = TourCategory::where('name', $name)->first();
        if ($cat) {

            $tours = Tour::with('images')
                ->with('highlights')
                ->with('facility')
                ->with('useful')
                ->with('departureTable')
                ->where("category_id", $cat->id)
                ->whereNull('deleted_at')
                ->get();
            // return response()->json(["tour"=>$tours]);
            return view("Backend.Admin.Tours.classicTours.ClassicTour", [
                "tour" => $tours,
            ]);
        }
    }


    public function create()
    {
        $homeTour = HomeTour::all();
        $type = Type::all();
        $destinations = Destination::all();
        $categories = TourCategory::all();
        return view('Backend.Admin.Tours.classicTours.CreateClassicTour', [
            "categories" => $categories,
            "destinations" => $destinations,
            "type" => $type,
            "homeTour" => $homeTour,
        ]);
    }

    public function createRelated($id)
    {
        $tour = Tour::with('images')
        ->with('highlights')
        ->with('facility')
        ->with('program')
        ->with('useful')
        ->with('types')
        ->whereNull('deleted_at')
        ->where('id', $id)->first();

        $tours = Tour::with('images')
        ->with('highlights')
        ->with('facility')
        ->with('program')
        ->with('useful')
        ->with('types')
        ->whereNull('deleted_at')
        ->where('related_id', $id)->get();



        $homeTour = HomeTour::all();
        $type = Type::all();
        $destinations = Destination::all();
        $categories = TourCategory::all();
        return view('Backend.Admin.Tours.related.related', [
            "categories" => $categories,
            "destinations" => $destinations,
            "type" => $type,
            "homeTour" => $homeTour,
            "tour"=>$tour,
            "tours"=>$tours
        ]);
    }

    function checkStore(Request $request)
    {
        dd($request->all());
    }


    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            "name" => "required|string",
            "type_id" => "",
            "Itenanary"=>"",
            "category_id" => "required|integer",
            "destination_id" => "required|integer",
            "home_tour_id" => "required",
            "duration" => "required",
            "price" => "required",
            "one_day_price" => "required",
            "one_week_price" => "required",
            "one_month_price" => "required",
            "one_year_price" => "required",
            "start_date" => "",
            "end_date" => "",
            "description" => "sometimes",
            // "is_Home" => "",
            "images" => "",

            "name_ru" => "required|string",
            "type_id_ru" => "",
            "Itenanary_ru"=>"",
            "category_id_ru" => "required|integer",
            "destination_id_ru" => "required|integer",
            "home_tour_id_ru" => "required",
            "duration_ru" => "required",
            "price_ru" => "required",
            "one_day_price_ru" => "required",
            "one_week_price_ru" => "required",
            "one_month_price_ru" => "required",
            "one_year_price_ru" => "required",
            "start_date_ru" => "",
            "end_date_ru" => "",
            "description_ru" => "sometimes",
            // "is_Home" => "",
            "images_ru" => "",

            "name_am" => "required|string",
            "type_id_am" => "",
            "Itenanary_am"=>"",
            "category_id_am" => "required|integer",
            "destination_id_am" => "required|integer",
            "home_tour_id_am" => "required",
            "duration_am" => "required",
            "price_am" => "required",
            "one_day_price_am" => "required",
            "one_week_price_am" => "required",
            "one_month_price_am" => "required",
            "one_year_price_am" => "required",
            "start_date_am" => "",
            "end_date_am" => "",
            "description_am" => "sometimes",
            // "is_Home" => "",
            "images_am" => "",
        ]);

        //if $reques->isHome 

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }
        try {
            DB::beginTransaction();

            $tour = Tour::create([
                "name" => $request->name,
                "type_id" => $request->type_id,
                "Itenanary"=>$request->Itenanary,
                "category_id" => $request->category_id,
                "home_tour_id" => $request->home_tour_id,
                "destination_id" => $request->destination_id,
                "duration" => $request->duration,
                "price" => $request->price,
                "one_day_price" => $request->one_day_price,
                "one_week_price" => $request->one_week_price,
                "one_month_price" => $request->one_month_price,
                "one_year_price" => $request->one_year_price,
                "start_date" => $request->start_date,
                "end_date" => $request->end_date,
                "description" => $request->description,
                // "is_Home" => $request->is_Home,
            ]);


            foreach ($request->file('images') as  $image) {

                $imageName = $image->getClientOriginalName();
                $image->move("Tour/" . $tour->id . "/", $imageName);
                $image = new Image();
                $image["filename"] = $imageName;
                $image["path"] = "Tour/" . $tour->id . "/" . $imageName;
                $image->save();
                $tour->images()->attach($image->id);
            }


            DB::commit();

            DB::beginTransaction();
            $tourRu = TourRu::create([
                "name" => $request->name_ru,
                "type_id" => $request->type_id_ru,
                "Itenanary"=>$request->Itenanary_ru,
                "category_id" => $request->category_id_ru,
                "home_tour_id" => $request->home_tour_id_ru,
                "destination_id" => $request->destination_id_ru,
                "duration" => $request->duration_ru,
                "price" => $request->price_ru,
                "one_day_price" => $request->one_day_price_ru,
                "one_week_price" => $request->one_week_price_ru,
                "one_month_price" => $request->one_month_price_ru,
                "one_year_price" => $request->one_year_price_ru,
                "start_date" => $request->start_date_ru,
                "end_date" => $request->end_date_ru,
                "description" => $request->description_ru,
                // "is_Home" => $request->is_Home,
            ]);
            

            foreach ($request->file('images_ru') as  $image) {

                $imageName = $image->getClientOriginalName();
                $image->move("Tour/" . $tourRu->id . "/", $imageName);
                $image = new Image();
                $image["filename"] = $imageName;
                $image["path"] = "Tour/" . $tourRu->id . "/" . $imageName;
                $image->save();
                $tourRu->images()->attach($image->id);
            }
            DB::beginTransaction();

            DB::commit();


            $tourAm = TourAm::create([
                "name" => $request->name_am,
                "type_id" => $request->type_id_am,
                "Itenanary"=>$request->Itenanary_am,
                "category_id" => $request->category_id_am,
                "home_tour_id" => $request->home_tour_id_am,
                "destination_id" => $request->destination_id_am,
                "duration" => $request->duration_am,
                "price" => $request->price_am,
                "one_day_price" => $request->one_day_price_am,
                "one_week_price" => $request->one_week_price_am,
                "one_month_price" => $request->one_month_price_am,
                "one_year_price" => $request->one_year_price_am,
                "start_date" => $request->start_date_am,
                "end_date" => $request->end_date_am,
                "description" => $request->description_am,
                // "is_Home" => $request->is_Home,
            ]);

            foreach ($request->file('images_am') as  $image) {

                $imageName = $image->getClientOriginalName();
                $image->move("Tour/" . $tourAm->id . "/", $imageName);
                $image = new Image();
                $image["filename"] = $imageName;
                $image["path"] = "Tour/" . $tourAm->id . "/" . $imageName;
                $image->save();
                $tourAm->images()->attach($image->id);
            }

            DB::commit();

            // return self::success("Tour added successfully!", ["data" => $image]);
            return redirect('/admin/CreateClassicTour')
                ->with("msg", "Tour added successfully!")
                ->with("success", true);
        }  catch (Exception $e) {
            return redirect()
                ->back()
                ->with("msg", $e->getMessage())
                ->with("fail", true);
            // return self::failure("Error in adding tour highlight", $e->getMessage());
        }
    }


    function type(Request $request, $id)
    {

        $validate = Validator::make($request->all(), [
            "type_name" => "",
        ]);
        if ($validate->fails()) {
            return redirect("/admin/tours/detail/" . $id)
                ->with("msg", $validate->errors()->first())
                ->with("fail", true);

            // return self::failure($validate->errors()->first());
        }
        try {
            $tt = Type::create([
                "type_name" => $request->type_name,
                "tour_id" => $id
            ]);
            // dd($tt);
            $tour = Tour::with('images')
                ->with('highlights')
                ->with('program')
                ->with('useful')
                ->with('departureTable')
                ->with('facility')
                ->where("id", $id)
                ->whereNull('deleted_at')
                ->first();
            return redirect("/admin/tours/detail/" . $id)
                ->with("msg", "Tour Type added successfully!")
                ->with("success", true)
                ->with('tour', $tour);
            // return self::success("Tour highlights added!", $tourHighlights);
        } catch (Exception $e) {
            return redirect("/admin/tours/detail/" . $id)
                ->with("msg", $e->getMessage())
                ->with("fail", true);
            // return self::failure("Error in adding tour highlight", $e->getMessage());
        }
    }


    


    function addTourHighlights(Request $request, $id)
    {


        $validate = Validator::make($request->all(), [
            // "tour_id" => "required|integer",
            "name" => "required"
        ]);
        if ($validate->fails()) {
            return redirect("/admin/tours/detail/" . $id)
                ->with("msg", $validate->errors()->first())
                ->with("fail", true);

            // return self::failure($validate->errors()->first());
        }
        try {
            $tt = TourHighlight::create([
                "name" => $request->name,
                "tour_id" => $id
            ]);

            $tam = TourAmHighlight::create([
                "name" => $request->name_am,
                "tour_am_id" => $id
            ]);

            $tru = TourRuHighlight::create([
                "name" => $request->name_ru,
                "tour_ru_id" => $id
            ]);
            // dd($tt);
            $tour = Tour::with('images')
                ->with('highlights')
                ->with('program')
                ->with('useful')
                ->with('departureTable')
                ->with('facility')
                ->where("id", $id)
                ->whereNull('deleted_at')
                ->first();
            return redirect("/admin/tours/detail/" . $id)
                ->with("msg", "Tour Highlight added successfully!")
                ->with("success", true)
                ->with('tour', $tour);
            // return self::success("Tour highlights added!", $tourHighlights);
        } catch (Exception $e) {
            return redirect("/admin/tours/detail/" . $id)
                ->with("msg", $e->getMessage())
                ->with("fail", true);
            // return self::failure("Error in adding tour highlight", $e->getMessage());
        }
    }


    function adduseful(Request $request, $id)
    {


        $validate = Validator::make($request->all(), [
            // "tour_id" => "required|integer",
            "name" => "required"
        ]);
        if ($validate->fails()) {
            return redirect("/admin/tours/detail/" . $id)
                ->with("msg", $validate->errors()->first())
                ->with("fail", true);

            
        }
        try {
            $tt = TourUseful::create([
                "name" => $request->name,
                "tour_id" => $id
            ]);
            $tam = TourAmUseful::create([
                "name" => $request->name_am,
                "tour_am_id" => $id
            ]);

            $tru = TourRuUseful::create([
                "name" => $request->name_ru,
                "tour_ru_id" => $id
            ]);
            // dd($tt);
            $tour = Tour::with('images')
                ->with('highlights')
                ->with('program')
                ->with('facility')
            
                ->with('useful')
                ->with('departureTable')
                ->where("id", $id)
                ->whereNull('deleted_at')
                ->first();
            return redirect("/admin/tours/detail/" . $id)
                ->with("msg", "Added successfully!")
                ->with("success", true)
                ->with('tour', $tour);
            // return self::success("Tour highlights added!", $tourHighlights);
        } catch (Exception $e) {
            return redirect("/admin/tours/detail/" . $id)
                ->with("msg", $e->getMessage())
                ->with("fail", true);
            // return self::failure("Error in adding tour highlight", $e->getMessage());
        }
    }



    function addDeparture(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            // "tour_id" => "required|integer",
            "start_date" => "required",
            "end_date" => "required",
            "price" => "required",
            "pax" => "required",
        ]);
        if ($validate->fails()) {
            return redirect("/admin/tours/detail/" . $id)
                ->with("msg", $validate->errors()->first())
                ->with("fail", true);

            // return self::failure($validate->errors()->first());
        }
        try {
            $tt = DepartureTable::create([
                "start_date" => $request->start_date,
                "end_date" => $request->end_date,
                "price" => $request->price,
                "pax" => $request->pax,
                "tour_id" => $id

            ]);

            $tru = DepartureRu::create([
                "start_date" => $request->start_date_ru,
                "end_date" => $request->end_date_ru,
                "price" => $request->price_ru,
                "pax" => $request->pax_ru,
                "tour_ru_id" => $id

            ]);
            $tru = DepartureAm::create([
                "start_date" => $request->start_date_am,
                "end_date" => $request->end_date_am,
                "price" => $request->price_am,
                "pax" => $request->pax_am,
                "tour_am_id" => $id

            ]);
            // dd($tt);
            $tour = Tour::with('images')
                ->with('highlights')
                ->with('program')
                ->with('facility')
            
                ->with('useful')
                ->with('departureTable')
                ->where("id", $id)
                ->whereNull('deleted_at')
                ->first();
            return redirect("/admin/tours/detail/" . $id)
                ->with("msg", "Added successfully!")
                ->with("success", true)
                ->with('tour', $tour);
            // return self::success("Tour highlights added!", $tourHighlights);
        } catch (Exception $e) {
            return redirect("/admin/tours/detail/" . $id)
                ->with("msg", $e->getMessage())
                ->with("fail", true);
            // return self::failure("Error in adding tour highlight", $e->getMessage());
        }
    }

    function addRelated(Request $request, $id)
    {

        $validate = Validator::make($request->all(), [
            "name" => "required|string",
            "type_id" => "",
            "Itenanary"=>"",
            "category_id" => "required|integer",
            "destination_id" => "required|integer",
            "home_tour_id" => "required",
            "duration" => "required",
            "price" => "required",
            "AMD" => "",
            "RUR" => "",
            "EURO" => "",
            "one_day_price" => "required",
            "one_week_price" => "required",
            "one_month_price" => "required",
            "one_year_price" => "required",
            "start_date" => "",
            "end_date" => "",
            "description" => "sometimes",
            // "is_Home" => "",
            "images" => "",
        ]);

        //if $reques->isHome 

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }
        try {
            DB::beginTransaction();

            $tour = Tour::create([
                "name" => $request->name,
                "type_id" => $request->type_id,
                "Itenanary"=>$request->Itenanary,
                "category_id" => $request->category_id,
                "home_tour_id" => $request->home_tour_id,
                "destination_id" => $request->destination_id,
                "duration" => $request->duration,
                "price" => $request->price,
                "AMD" => $request->AMD,
                "RUR" => $request->RUR,
                "EURO" => $request->EURO,
                "one_day_price" => $request->one_day_price,
                "one_week_price" => $request->one_week_price,
                "one_month_price" => $request->one_month_price,
                "one_year_price" => $request->one_year_price,
                "start_date" => $request->start_date,
                "end_date" => $request->end_date,
                "description" => $request->description,
                "related_id" => $id,
                // "is_Home" => $request->is_Home,
            ]);

            foreach ($request->file('images') as  $image) {

                $imageName = $image->getClientOriginalName();
                $image->move("Tour/" . $tour->id . "/", $imageName);
                $image = new Image();
                $image["filename"] = $imageName;
                $image["path"] = "Tour/" . $tour->id . "/" . $imageName;
                $image->save();
                $tour->images()->attach($image->id);
            

               
            }

            DB::commit();
            // return self::success("Tour added successfully!", ["data" => $image]);
            return redirect()
            ->back()
                ->with("msg", "Related Tour added successfully!")
                ->with("success", true);
        }  catch (Exception $e) {
            return redirect()
                ->back()
                ->with("msg", $e->getMessage())
                ->with("fail", true);
            // return self::failure("Error in adding tour highlight", $e->getMessage());
        }



        // $validate = Validator::make($request->all(), [
        //     // "tour_id" => "",
        //    "name" => '',
        // ]);
        // if ($validate->fails()) {
        //     return redirect("/admin/tours/detail/" . $id)
        //         ->with("msg", $validate->errors()->first())
        //         ->with("fail", true);

        //     // return self::failure($validate->errors()->first());
        // }
        // try {
        //     $tt = relatedTour::create([
        //         "tour_id" => $id,
        //         "name" => $request->name,
        //     ]);
        //     // dd($tt);
        //     $tour = Tour::with('images')
        //         ->with('highlights')
        //         ->with('program')
        //         ->with('facility')
        //         ->with('useful')
        //        
        //         ->with('departureTable')
        //         ->where("id", $id)
        //         ->whereNull('deleted_at')
        //         ->first();
        //     return redirect()
        //     ->back()
        //         ->with("msg", "Added successfully!")
        //         ->with("success", true)
        //         ->with('tour', $tour);
        //     // return self::success("Tour highlights added!", $tourHighlights);
        // } catch (Exception $e) {
        //     return redirect("/admin/tours/detail/" . $id)
        //         ->with("msg", $e->getMessage())
        //         ->with("fail", true);
        //     // return self::failure("Error in adding tour highlight", $e->getMessage());
        // }
    }



    function deleteHighlights($id)
    {
        $highlight = TourHighlight::whereNull('deleted_at')->where('id', $id)->first();
        if ($highlight) {
            $highlight->delete();
            $highlightAm = TourAmHighlight::whereNull('deleted_at')->where('id', $id)->delete();
            $highlightRu = TourRuHighlight::whereNull('deleted_at')->where('id', $id)->delete();

            $tour = Tour::with('images')
                ->with('highlights')
                ->with('facility')
            
                ->with('useful')
                ->with('departureTable')
                ->with('program')
                ->where("id", $highlight->tour_id)
                ->whereNull('deleted_at')
                ->first();

            return redirect("/admin/tours/detail/" . $highlight->tour_id)
                ->with("msg", "Tour Highlight Deleted!")
                ->with("success", true)
                ->with('tour', $tour);
        }
        return redirect("/admin/tours/detail/" . $highlight->tour_id)
            ->with("msg", "Not Found!")
            ->with("fail", true);
        // ->with('tour', $tour);
    }



    function addTourFacility(Request $request, $id)
    {
        

        $validate = Validator::make($request->all(), [
            // "tour_id" => "required|integer",
            "name" => "required",
            "unname" => ""
        ]);
        if ($validate->fails()) {
            return redirect("/admin/tours/detail/" . $id)
                ->with("msg", $validate->errors()->first())
                ->with("fail", true);

            // return self::failure($validate->errors()->first());
        }
        try {
            $tt = TourFacility::create([
                "name" => $request->name,
                "unname" => $request->unname,
                "tour_id" => $id
            ]);
            $tam = TourAmFacility::create([
                "name" => $request->name_am,
                "unname" => $request->unname_am,
                "tour_am_id" => $id
            ]);

            $tru = TourRuFacility::create([
                "name" => $request->name_ru,
                "unname" => $request->unname_ru,
                "tour_ru_id" => $id
            ]);
            // dd($tt);
            $tour = Tour::with('images')
                ->with('highlights')
                ->with('program')
                ->with('facility')
                ->with('useful')
                ->with('departureTable')
            
                ->where("id", $id)
                ->whereNull('deleted_at')
                ->first();
            return redirect("/admin/tours/detail/" . $id)
                ->with("msg", "Tour Facility added successfully!")
                ->with("success", true)
                ->with('tour', $tour);
        } catch (Exception $e) {
            return redirect("/admin/tours/detail/" . $id)
                ->with("msg", $e->getMessage())
                ->with("fail", true);
        }
    }


    function deleteTourFacility($id)
    {
        $tourFacility = TourFacility::whereNull("deleted_at")
            ->where('id', $id)
            ->first();
        if ($tourFacility) {
            $tourFacility->delete();

            $tourAmFacility = TourAmFacility::whereNull("deleted_at")
            ->where('id', $id)
            ->delete();

            $tourRuFacility = TourRuFacility::whereNull("deleted_at")
            ->where('id', $id)
            ->delete();

            $tour = Tour::with('images')
                ->with('highlights')
                ->with('facility')
                ->with('program')
            
                ->with('useful')
                ->with('departureTable')
                ->where("id", $tourFacility->tour_id)
                ->whereNull('deleted_at')
                ->first();

            return redirect("/admin/tours/detail/" . $tourFacility->tour_id)
                ->with("msg", "Tour Facility Deleted!")
                ->with("success", true)
                ->with('tour', $tour);
            // return self::success("Tour Facility deleted!");
        }
        return redirect("/admin/tours/detail/" . $tourFacility->tour_id)
            ->with("msg", "Not Found")
            ->with("fail", true);
        // ->with('tour', $tour);
        // return self::failure("Not Found!", [], 404);
    }


    function removeTourImage($id)
    {
        $image = Image::whereNull('deleted_at')
            ->where('id', $id)
            ->first();
        //complete it.      
    }



    function addTourProgram(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            // "tour_id" => "required|integer",
            "day" => "required",
            "fromTo" => "required",
            "description" => "",
            "distance" => "required",
            "duration" => "required",
            "food" => "",
            "location" => "required",

        ]);
        if ($validator->fails()) {
            return redirect("/admin/tours/detail/" . $id)
                ->with("msg", $validator->errors()->first())
                ->with("fail", true);
            // return self::failure($validator->errors()->first());
        }
        $tourProgram = new TourProgram();
        $tourProgram->day = $request->day;
        $tourProgram->fromTo = $request->fromTo;
        $tourProgram->description = $request->description;
        $tourProgram->distance = $request->distance;
        $tourProgram->duration = $request->duration;
        $tourProgram->food = $request->food;
        $tourProgram->location = $request->location;
        $tourProgram->tour_id = $id;
        $tourProgram->save();

        $tourProgramRu = new TourRuProgram();
        $tourProgramRu->day = $request->day_ru;
        $tourProgramRu->fromTo = $request->fromTo_ru;
        $tourProgramRu->description = $request->description_ru;
        $tourProgramRu->distance = $request->distance_ru;
        $tourProgramRu->duration = $request->duration_ru;
        $tourProgramRu->food = $request->food_ru;
        $tourProgramRu->location = $request->location_ru;
        $tourProgramRu->tour_ru_id = $id;
        $tourProgramRu->save();

        $tourProgramAm = new TourAmProgram();
        $tourProgramAm->day = $request->day_am;
        $tourProgramAm->fromTo = $request->fromTo_am;
        $tourProgramAm->description = $request->description_am;
        $tourProgramAm->distance = $request->distance_am;
        $tourProgramAm->duration = $request->duration_am;
        $tourProgramAm->food = $request->food_am;
        $tourProgramAm->location = $request->location_am;
        $tourProgramAm->tour_am_id = $id;
        $tourProgramAm->save();


        $tour = Tour::with('images')
            ->with('highlights')
            ->with('facility')
            ->with('useful')
            ->with('departureTable')
            ->with('program')
        
            ->where("id", $id)
            ->whereNull('deleted_at')
            ->first();
        return redirect("/admin/tours/detail/" . $id)
            ->with("msg", "Tour Program added successfully!")
            ->with("success", true)
            ->with('tour', $tour);
        // return self::success("Tour program added", ["data" => $tourProgram]);
    }



    function deleteTourProgram($id)
    {
        $tourProgram = TourProgram::whereNull('deleted_at')
            ->where('id', $id)
            ->first();
        if ($tourProgram) {
            $tourProgram->delete();
            $tourRuProgram = TourRuProgram::whereNull('deleted_at')
            ->where('id', $id)
            ->delete();
            $tourAmProgram = TourAmProgram::whereNull('deleted_at')
            ->where('id', $id)
            ->delete();
            $tour = Tour::with('images')
                ->with('highlights')
                ->with('facility')
                ->with('useful')
                ->with('departureTable')
            
                ->with('program')
                ->where("id", $tourProgram->tour_id)
                ->whereNull('deleted_at')
                ->first();

            return redirect("/admin/tours/detail/" . $tourProgram->tour_id)
                ->with("msg", "Tour Program Deleted!")
                ->with("success", true)
                ->with('tour', $tour);
            // return self::success("Tour program deleted");
        }
        return redirect("/admin/tours/detail/" . $tourProgram->tour_id)
            ->with("msg", "Not Found!")
            ->with("fail", true);
        // ->with('tour', $tour);
        // return self::failure("Not Found!", [], 404);
    }

    public function show($id)
    {
        //
        $tour = Tour::with('images')
            ->with('highlights')
            ->with('facility')
            ->with('program')
        
            ->with('useful')
            ->with('types')
            ->whereNull('deleted_at')
            ->where('id', $id)->first();

        //    dd($tour);

        $homeTour = HomeTour::all();
        $type = Type::all();
        $categories = TourCategory::all();
        $destinations = Destination::all();
        $type = Type::all();
        $allTours = Tour::all();

        // $related = relatedTour::where('tour_id', $id)->get();

       

        // $category = TourCategory::where('id', 1)-;

      
        if ($tour) {
            return view("Backend.Admin.Tours.classicTours.TourDescription", [
                "tour" => $tour,
                "destinations" => $destinations,
                "type" => $type,
                "allTours" => $allTours,
                // "related"=>$related,
                "categories" => $categories,
            "type" => $type,
            "homeTour" => $homeTour,
               
             
            ]);
            // return self::success("Tour retrieved!", ["data" => $tour]);
        }
        return self::failure("No such tour exist!");
    }


    public function edit($id)
    {
        //
        $destinations = Destination::all();
        $categories = TourCategory::all();
        $homeTour = HomeTour::all();
        $tour = Tour::with('images')
            ->with('highlights')
            ->with('facility')
            ->with('useful')
            ->with('program')
            ->where('id', $id)
            ->first();


        $tourRu = TourRu::with('images')
        ->with('highlights')
    
        ->with('useful')
        ->with('types')
        ->whereNull('deleted_at')
        ->where('id', $id)->first();

        $tourAm = TourAm::with('images')
            ->with('highlights')
        
            ->with('useful')
            ->with('types')
            ->whereNull('deleted_at')
            ->where('id', $id)->first();
        
        return view('Backend.Admin.Tours.classicTours.UpdateClassicTour', [
            "categories" => $categories,
            "destinations" => $destinations,
            "tour" => $tour,
            "tourAm" => $tourAm,
            "tourRu" => $tourRu,
            "homeTour" => $homeTour,
        ]);
    }


    public function update(Request $request, $id)
    {
        //
        $tour = Tour::find($id);
        $tourAm = TourAm::find($id);
        $tourRu = TourRu::find($id);
        
        $tour->fill([
            "name" => $request->name,
            "type_id" => $request->type_id,
            "Itenanary"=>$request->Itenanary,
            "category_id" => $request->category_id,
            "home_tour_id" => $request->home_tour_id,
            "destination_id" => $request->destination_id,
            "duration" => $request->duration,
            "price" => $request->price,
            "one_day_price" => $request->one_day_price,
            "one_week_price" => $request->one_week_price,
            "one_month_price" => $request->one_month_price,
            "one_year_price" => $request->one_year_price,
            "start_date" => $request->start_date,
            "end_date" => $request->end_date,
            "description" => $request->description,
            // "is_Home" => $request->is_Home,
        ]);

        $tourRu->fill([
            "name" => $request->name_ru,
            "type_id" => $request->type_id_ru,
            "Itenanary"=>$request->Itenanary_ru,
            "category_id" => $request->category_id_ru,
            "home_tour_id" => $request->home_tour_id_ru,
            "destination_id" => $request->destination_id_ru,
            "duration" => $request->duration_ru,
            "price" => $request->price_ru,
            "one_day_price" => $request->one_day_price_ru,
            "one_week_price" => $request->one_week_price_ru,
            "one_month_price" => $request->one_month_price_ru,
            "one_year_price" => $request->one_year_price_ru,
            "start_date" => $request->start_date_ru,
            "end_date" => $request->end_date_ru,
            "description" => $request->description_ru,
            // "is_Home" => $request->is_Home,
        ]);

        $tourAm->fill([
            "name" => $request->name_am,
            "type_id" => $request->type_id_am,
            "Itenanary"=>$request->Itenanary_am,
            "category_id" => $request->category_id_am,
            "home_tour_id" => $request->home_tour_id_am,
            "destination_id" => $request->destination_id_am,
            "duration" => $request->duration_am,
            "price" => $request->price_am,
            "one_day_price" => $request->one_day_price_am,
            "one_week_price" => $request->one_week_price_am,
            "one_month_price" => $request->one_month_price_am,
            "one_year_price" => $request->one_year_price_am,
            "start_date" => $request->start_date_am,
            "end_date" => $request->end_date_am,
            "description" => $request->description_am,
            // "is_Home" => $request->is_Home,
        ]);

        $tour->save();
        $tourRu->save();
        $tourAm->save();
       
        return redirect()
            ->back()
            ->with("msg", "Tour Updated!")
            ->with("success", true);
      


    }


    public function destroy($id)
    {
        //
        $tour = Tour::find($id);
        if ($tour) {
            $tour->delete();
            //delete images
            //delete highlights 

            //retrieving all the tours
            $tours = Tour::with('images')
                ->with('highlights')
                ->with('facility')
                ->with('useful')
                ->with('departureTable')
                ->with('departureTable')
                ->where("category_id", $tour->category_id)
                ->whereNull('deleted_at')
                ->get();

            //retrieving the category for category name
            $cat = TourCategory::find($tour->category_id);

            // return response()->json(["tour"=>$tours]);
            return redirect()
            ->back()
                // ->with("tour", $tours)
                ->with('success', true)
                ->with('msg', 'Tour Deleted!');

            // return self::success("Tour deleted!", ["data" => $tour]);
        }
    }

    public function getToursByCategory($id)
    {


        //get all tours where id is equal to the category id with pagination
        $tour = Tour::with('images')
            ->with('highlights')
            ->with('facility')
            ->with('program')
            ->with('useful')
            ->with('departureTable')
            ->orderby('created_at', 'desc')
            ->where("category_id", $id)
            ->whereNull('deleted_at')
            ->simplePaginate(6);

        // $tour = Tour::where('category_id', $id)->get();
        $cat = TourCategory::where('id', $id)->first();
        return view('Backend.Admin.Tours.classicTours.ClassicTour', compact('tour', 'cat'));


        // $tour = Tour::all();
        //     $cat = TourCategory::where('id', $id)->first();
        // return view('Backend.Admin.Tours.classicTours.ClassicTour', [
        //     "tour" => $tour,
        //     "category" => $cat
        // ]);
    }


    public function deleteTourDeparture($id)
    {
        $tourDeparture = DepartureTable::where('id', $id)
            ->first();
        if ($tourDeparture) {
            $tourDeparture->delete();

            $tourAmDeparture = DepartureAm::where('id', $id)
            ->delete();

            $tourRuDeparture = DepartureRu::where('id', $id)
            ->delete();
            return redirect()->back()
                ->with("msg", "Tour Departure Deleted!")
                ->with("success", true);
            // return self::success("Tour departure deleted");
        }
        return redirect()->back()
            ->with("msg", "Not Found!")
            ->with("fail", true);
      
    }





    public function createMoreImages($id)
    {
        $tour = Tour::find($id);
        if ($tour) {
            return view('Backend.Admin.Tours.classicTours.TourDescription', [
                "tour" => $tour
            ]);
        }
        return self::failure('Not Found', [], 404);
    }

    //store multiple images for id
    public function moreImagestore(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [

            "images" => "required",
        ]);

        //store all the images
        if ($validate->fails()) {
            return redirect('/admin/tours/detail/' . $id)
                ->with('msg', 'Not Found')
                ->with('fail', true);
        } else {
            $tour = Tour::find($id);
            if ($tour) {
                $images = $request->file('images');
                foreach ($images as $image) {
                    $imageName = $image->getClientOriginalName();
                    $image->move(public_path('images/tours/' . $tour->id), $imageName);
                    $tour->images()->create([
                        "image" => $imageName
                    ]);
                }
                return redirect('/admin/tours/detail/' . $id)
                    ->with('msg', 'Images Added!')
                    ->with('success', true);
            }
            return redirect('/admin/tours/detail/' . $id)
                ->with('msg', 'Not Found')
                ->with('fail', true);
        }
    }


   


}
