<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\FoodArmenia;
use App\Models\Hotel;
use App\Models\HotelRu;
use App\Models\HotelAm;
use App\Models\HotelCMS;
use App\Models\HotelFacility;
use App\Models\HotelAmFacility;
use App\Models\HotelRuFacility;
use App\Models\HotelHighlights;
use App\Models\HotelAmHighlights;
use App\Models\HotelRuHighlights;
use App\Models\HotelImage;
use App\Models\HotelInfo;
use App\Models\HotelAmInfo;
use App\Models\HotelRuInfo;
use App\Models\HotelKey;
use App\Models\HotelAmKey;
use App\Models\HotelRuKey;
use App\Models\HotelRoom;
use App\Models\HotelAmRoom;
use App\Models\HotelRuRoom;
use App\Models\HotelType;
use App\Models\Image;
use App\Models\Region;
use App\Models\ThingsToDo;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class HotelController extends Controller
{

    public function index()
    {
        //get all data with paginate
        $hotels = Hotel::orderby('created_at', 'desc')->simplePaginate(5);
        return view('Backend.Admin.Services.Hotels.view', compact('hotels'));
    }


    public function create()
    {
        $hotelType = HotelType::all();
        $region = Region::all();
        $destination = Destination::all();

        return view('Backend.Admin.Services.Hotels.create', compact('hotelType', 'region', 'destination'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'address' => 'required',
            'stars' => 'required',
            'price' => 'required',
            'overview' => '',
            'free_cancelation' => 'required',
            'images' => 'required',
            'destination_id' => 'required',
            'region_id' => 'required',
            'hotel_type_id' => 'required',
        ]);
        $hotel = Hotel::create([
            'name' => $request->name,
            'overview' => $request->overview,
            'description' => $request->description,
            'address' => $request->address,
            'stars' => $request->stars,
            'price' => $request->price,
            'free_cancelation' => $request->free_cancelation,
            'destination_id' => $request->destination_id,
            'region_id' => $request->region_id,
            'hotel_type_id' => $request->hotel_type_id,

        ]);

        foreach ($request->file('images') as  $image) {

            $imageName = $image->getClientOriginalName();
            $image->move("Hotel/" . $hotel->id . "/", $imageName);
            $image = new Image();
            $image["filename"] = $imageName;
            $image["path"] = "Hotel/" . $hotel->id . "/" . $imageName;
            $image->save();
            $hotel->images()->attach($image->id);
        }

        $hotelAm = HotelAm::create([
            'name' => $request->name_am,
            'overview' => $request->overview_am,
            'description' => $request->description_am,
            'address' => $request->address_am,
            'stars' => $request->stars_am,
            'price' => $request->price_am,
            'free_cancelation' => $request->free_cancelation_am,
            'destination_id' => $request->destination_id_am,
            'region_id' => $request->region_id_am,
            'hotel_type_id' => $request->hotel_type_id_am,

        ]);

        foreach ($request->file('images_am') as  $image) {

            $imageName = $image->getClientOriginalName();
            $image->move("Hotel/" . $hotel->id . "/", $imageName);
            $image = new Image();
            $image["filename"] = $imageName;
            $image["path"] = "Hotel/" . $hotel->id . "/" . $imageName;
            $image->save();
            $hotelAm->images()->attach($image->id);
        }

        $hotelRU = HotelRu::create([
            'name' => $request->name_ru,
            'overview' => $request->overview_ru,
            'description' => $request->description_ru,
            'address' => $request->address_ru,
            'stars' => $request->stars_ru,
            'price' => $request->price_ru,
            'free_cancelation' => $request->free_cancelation_ru,
            'destination_id' => $request->destination_id_ru,
            'region_id' => $request->region_id_ru,
            'hotel_type_id' => $request->hotel_type_id_ru,

        ]);

        foreach ($request->file('images_ru') as  $image) {

            $imageName = $image->getClientOriginalName();
            $image->move("Hotel/" . $hotel->id . "/", $imageName);
            $image = new Image();
            $image["filename"] = $imageName;
            $image["path"] = "Hotel/" . $hotel->id . "/" . $imageName;
            $image->save();
            $hotelRU->images()->attach($image->id);
        }
        return redirect()->back()->with("msg", "Created successfully!")
            ->with("success", true);
    }

    function addHotelKey(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            // "tour_id" => "required|integer",
            'key' => 'required',
            'key_ru' => 'required',
            'key_am' => 'required',

        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->with("msg", $validator->errors()->first())
                ->with("fail", true);
        }
        $hotel_key = new HotelKey();
        $hotel_key->key = $request->key;
        $hotel_key->hotel_id = $id;
        $hotel_key->save();

        $hotel_ru_key = new HotelRuKey();
        $hotel_ru_key->key = $request->key_ru;
        $hotel_ru_key->hotel_ru_id = $id;
        $hotel_ru_key->save();

        $hotel_am_key = new HotelAmKey();
        $hotel_am_key->key=$request->key_am;
        $hotel_am_key->hotel_am_id = $id;
        $hotel_am_key->save();


        $hotel = Hotel::with('images')
            ->with('images')
            ->with('highlights')
            ->with('hotelInfo')
            ->with('hotelFacilities')
            ->with('rooms')
            ->with('destination')
            ->with('region')
            ->with('hotelType')
            ->with('hotelKeys')
            ->where("id", $id)
            ->whereNull('deleted_at')
            ->first();
        return redirect()
            ->back()
            ->with("msg", "Added successfully!")
            ->with("success", true);

        // return self::success("Tour program added", ["data" => $hotel_key]);
    }



    public function show($id)
    {
        //show the details of hotel

        $hotel = Hotel::find($id)
            ->with('images')
            ->with('highlights')
            ->with('hotelInfo')
            ->with('hotelFacilities')
            ->with('rooms')
            ->with('destination')
            ->with('region')
            ->with('hotelType')
            ->where('id', $id)
            ->first();




        return view('Backend.Admin.Services.Hotels.show', compact('hotel'));
    }

    public function edit($id)
    {
        $hotel = Hotel::find($id);
        $hotelAm = HotelAm::find($id);
        $hotelRu = HotelRu::find($id);
        $hotelType = HotelType::all();
        $region = Region::all();
        $destination = Destination::all();
        return view('Backend.Admin.Services.Hotels.update', compact('hotel', 'hotelType', 'region', 'destination','hotelAm','hotelRu'));
    }



    public function addHotelHighlights(Request $request, $id)
    {


        $validate = Validator::make($request->all(), [
            // "tour_id" => "required|integer",
            "name" => "required",
            "name_am" => "required",
            "name_ru" => "required",
        ]);
        if ($validate->fails()) {
            return redirect()
                ->back()
                ->with("msg", $validate->errors()->first())
                ->with("fail", true);

            // return self::failure($validate->errors()->first());
        }
        try {
            $hotel = HotelHighlights::create([
                "name" => $request->name,
                "hotel_id" => $id
            ]);

            $hotelAm = HotelAmHighlights::create([
                "name" => $request->name_am,
                "hotel_am_id" => $id
            ]);

            $hotelRu = HotelRuHighlights::create([
                "name" => $request->name_ru,
                "hotel_ru_id" => $id
            ]);
            // dd($tt);
            $hotel = Hotel::with('images')
                ->with('highlights')
                ->where("id", $id)
                ->whereNull('deleted_at')
                ->first();
            // dd($hotel);
            return redirect()
                ->back()
                ->with("msg", "Created successfully!")
                ->with("success", true);
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with("msg", $e->getMessage())
                ->with("fail", true);
        }
    }




    public function addFacility(Request $request, $id)
    {

        $validate = Validator::make($request->all(), [
            // "tour_id" => "required|integer",
            "name" => "required",
            "name_ru" => "required",
            "name_am" => "required"
        ]);
        if ($validate->fails()) {
            return redirect()
                ->back()
                ->with("msg", $validate->errors()->first())
                ->with("fail", true);

            // return self::failure($validate->errors()->first());
        }
        try {
            $hotel = HotelFacility::create([
                "name" => $request->name,
                "hotel_id" => $id
            ]);

            $hotelAm = HotelAmFacility::create([
                "name" => $request->name_am,
                "hotel_am_id" => $id
            ]);

            $hotelRu = HotelRuFacility::create([
                "name" => $request->name_ru,
                "hotel_ru_id" => $id
            ]);
            // dd($tt);
            $hotel = Hotel::with('images')
                ->with('highlights')
                ->where("id", $id)
                ->with('hotelFacilities')
                ->whereNull('deleted_at')
                ->first();
            // dd($hotel);
            return redirect()
                ->back()
                ->with("msg", "Created successfully!")
                ->with("success", true);
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with("msg", $e->getMessage())
                ->with("fail", true);
        }
    }

    public function FacilityDelete($id)
    {
        $facility = HotelFacility::find($id);
        $facility->delete();

        $facilityAm = HotelAmFacility::find($id);
        $facilityAm->delete();

        $facilityRu = HotelRuFacility::find($id);
        $facilityRu->delete();
        return redirect()->back()->with("msg", "Deleted successfully!")
            ->with("success", true);
    }

    function addHotelRoom(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            // "tour_id" => "required|integer",
            "name" => "required",
            "price" => "required",
            "price2" => "required",

            "name_ru" => "required",
            "price_ru" => "required",
            "price2_ru" => "required",

            "name_am" => "required",
            "price_am" => "required",
            "price2_am" => "required",

        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->with("msg", $validator->errors()->first())
                ->with("fail", true);
            // return self::failure($validator->errors()->first());
        }
        $hotel = new HotelRoom();
        $hotel->name = $request->name;
        $hotel->price = $request->price;
        $hotel->price2 = $request->price2;
        $hotel->hotel_id = $id;
        $hotel->save();

        $hotelAm = new HotelAmRoom();
        $hotelAm->name = $request->name_am;
        $hotelAm->price = $request->price_am;
        $hotelAm->price2 = $request->price2_am;
        $hotelAm->hotel_am_id = $id;
        $hotelAm->save();

        $hotelRu = new HotelRuRoom();
        $hotelRu->name = $request->name_ru;
        $hotelRu->price = $request->price_ru;
        $hotelRu->price2 = $request->price2_ru;
        $hotelRu->hotel_ru_id = $id;
        $hotelRu->save();

        $tour = Hotel::with('images')
            ->with('highlights')
            ->where("id", $id)
            ->whereNull('deleted_at')
            ->first();
        return redirect()
            ->back()
            ->with("msg", "Added successfully!")
            ->with("success", true)
            ->with('tour', $tour);
    }

    public function deleteHotelRoom($id)
    {
        $hotel = HotelRoom::find($id);
        $hotel->delete();

        $hotel = HotelAmRoom::find($id);
        $hotel->delete();

        $hotel = HotelRuRoom::find($id);
        $hotel->delete();
        return redirect()->back()->with("msg", "Deleted successfully!")
            ->with("success", true);
    }


    public function deleteHotelHighlight($id)
    {
        $hotel = HotelHighlights::find($id);
        $hotel->delete();
        $hotelAm = HotelAmHighlights::find($id);
        $hotelAm->delete();
        $hotelRu = HotelRuHighlights::find($id);
        $hotelRu->delete();
        return redirect()
            ->back()
            ->with("msg", "Deleted successfully!")
            ->with("success", true);
    }


    public function addHotelInfo(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            // "tour_id" => "required|integer",
            "name" => "required",
            "name_am" => "required",
            "name_ru" => "required",

        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->with("msg", $validator->errors()->first())
                ->with("fail", true);
            // return self::failure($validator->errors()->first());
        }
        $hotel = new HotelInfo();
        $hotel->name = $request->name;
        $hotel->hotel_id = $id;
        $hotel->save();

        $hotelAm = new HotelAmInfo();
        $hotelAm->name = $request->name_am;
        $hotelAm->hotel_am_id = $id;
        $hotelAm->save();

        $hotelRu = new HotelRuInfo();
        $hotelRu->name = $request->name_ru;
        $hotelRu->hotel_ru_id = $id;
        $hotelRu->save();
        $tour = Hotel::with('images')
            ->with('highlights')
            ->with('hotelFacilities')
            ->where("id", $id)
            ->whereNull('deleted_at')
            ->first();
        return redirect()
            ->back()
            ->with("msg", "Added successfully!")
            ->with("success", true)
            ->with('tour', $tour);
    }

    public function deleteHotelInfo($id)
    {
        $hotel = HotelInfo::find($id);
        $hotel->delete();

        $hotelAm = HotelAmInfo::find($id);
        $hotelAm->delete();

        $hotelRu = HotelRuInfo::find($id);
        $hotelRu->delete();
        return redirect()
            ->back()
            ->with("msg", "Deleted successfully!")
            ->with("success", true);
    }




    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'stars' => 'required',
            'price' => 'required',
            'free_cancelation' => 'required',
        ]);

        $hotel = Hotel::find($id);
        $hotel->name = $request->name;
        $hotel->address = $request->address;
        $hotel->stars = $request->stars;
        $hotel->price = $request->price;
        $hotel->map = $request->map;
        $hotel->free_cancelation = $request->free_cancelation;
        $hotel->save();

        $hotelRu = HotelRu::find($id);
        $hotelRu->name = $request->name_ru;
        $hotelRu->address = $request->address_ru;
        $hotelRu->stars = $request->stars_ru;
        $hotelRu->price = $request->price_ru;
        $hotelRu->map = $request->map_ru;
        $hotelRu->free_cancelation = $request->free_cancelation_ru;
        $hotelRu->save();

        $hotelAm = HotelAm::find($id);
        $hotelAm->name = $request->name_am;
        $hotelAm->address = $request->address_am;
        $hotelAm->stars = $request->stars_am;
        $hotelAm->price = $request->price_am;
        $hotelAm->map = $request->map_am;
        $hotelAm->free_cancelation = $request->free_cancelation_am;
        $hotelAm->save();

        return redirect()->back()->with("msg", "Upadated successfully!")
            ->with("success", true);
    }

    public function destroy($id)
    {
        //delete the hotel
        $hotel = Hotel::find($id);
        $hotel->delete();

        $hotelAm = HotelAm::find($id);
        $hotelAm->delete();

        $hotelRu = HotelRu::find($id);
        $hotelRu->delete();
        return redirect()->back()->with("msg", "Deleted successfully!")
            ->with("success", true);
    }


    // get the hotels in the frontend
    public function getHotels($locale = null)
    {
        if (isset($locale) && in_array($locale, config('app.available_locales'))) {
            app()->setLocale($locale);
        }
        if(app()->getLocale()=='hy'){
            $hotels = HotelAm::with('images')
            ->with('highlights')
            ->with('rooms')
            ->orderby('created_at', 'desc')
            ->whereNull('deleted_at')
            ->simplePaginate(5);
        }
        elseif(app()->getLocale()=='ru'){
            $hotels = HotelRu::with('images')
            ->with('highlights')
            ->with('rooms')
            ->orderby('created_at', 'desc')
            ->whereNull('deleted_at')
            ->simplePaginate(5);
        }else{
            $hotels = Hotel::with('images')
            ->with('highlights')
            ->with('rooms')
            ->orderby('created_at', 'desc')
            ->whereNull('deleted_at')
            ->simplePaginate(5);
        }
        $hotelType = HotelType::all();
        $region = Region::all();
        $destination = Destination::all();

        $cms = HotelCMS::all();

        return view('Frontend.Hotels.Hotels', compact('hotels', 'hotelType', 'region', 'destination','cms'));
    }

    // get the hotel details in the frontend
    public function getHotelDetails($id, $locale=null)
    {

        if (isset($locale) && in_array($locale, config('app.available_locales'))) {
            app()->setLocale($locale);
        }
        if(app()->getLocale()=='hy'){
            $hotels = HotelAm::with('images')
            ->with('highlights')
            ->with('hotelInfo')
            ->with('hotelFacilities')
            ->with('rooms')
            ->with('hotelType')
            ->with('hotelKeys')
            ->where('id', $id)
            ->first();
        }elseif(app()->getLocale()=='hy'){
            $hotels = HotelRu::with('images')
            ->with('highlights')
            ->with('hotelInfo')
            ->with('hotelFacilities')
            ->with('rooms')
            ->with('hotelType')
            ->with('hotelKeys')
            ->where('id', $id)
            ->first();
        }else{
            $hotels = Hotel::with('images')
            ->with('highlights')
            ->with('hotelInfo')
            ->with('hotelFacilities')
            ->with('rooms')
            ->with('hotelType')
            ->with('hotelKeys')
            ->where('id', $id)
            ->first();
        }
        

            $foods = FoodArmenia::with('images')
            // ->random()
            // ->take(3)
            ->where('category_id', 1)
            ->inRandomOrder()
            ->simplePaginate(3);

            $room = HotelRoom::find($id);

            $things = ThingsToDo::with('images')
            // ->random()
            // ->take(3)
            // ->where('category_id', 1)
            ->inRandomOrder()
            ->simplePaginate(3);




        return view('Frontend.Hotels.Hotel', compact('hotels', 'foods','things','room'));
    }
}
