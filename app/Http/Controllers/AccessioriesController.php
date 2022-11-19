<?php

namespace App\Http\Controllers;

use App\Models\Accessiories;
use App\Models\AccessioriesRu;
use App\Models\AccessioriesAm;
use App\Models\Image;
use App\Models\TourAccessoriesCMS;
use Illuminate\Http\Request;

class AccessioriesController extends Controller
{
  
    public function index()
    {
        $a = Accessiories::simplePaginate(9);
        return view('Backend.Admin.Services.Accessiories.view', compact('a'));
    }

   
    public function create()
    {
        return view('Backend.Admin.Services.Accessiories.create');
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'availability'=>'required',
            'type'=>'required',
            'total_pax'=>'required',
            'free_cancellation'=>'required',
            'one_day_price'=>'required',
            'one_week_price'=>'required',
            'one_month_price'=>'required',
            'images' => 'required',

            'name_am' => 'required',
            'description_am' => 'required',
            'availability_am'=>'required',
            'type_am'=>'required',
            'total_pax_am'=>'required',
            'free_cancellation_am'=>'required',
            'one_day_price_am'=>'required',
            'one_week_price_am'=>'required',
            'one_month_price_am'=>'required',
            'images_am' => 'required',

            'name_ru' => 'required',
            'description_ru' => 'required',
            'availability_ru'=>'required',
            'type_ru'=>'required',
            'total_pax_ru'=>'required',
            'free_cancellation_ru'=>'required',
            'one_day_price_ru'=>'required',
            'one_week_price_ru'=>'required',
            'one_month_price_ru'=>'required',
            'images_ru' => 'required',
            
        ]);
        $a = Accessiories::create([
            'name' => $request->name,
            'description' => $request->description,
            'availability' => $request->availability,
            'type' => $request->type,
            'total_pax' => $request->total_pax,
            'free_cancellation' => $request->free_cancellation,
            'one_day_price' => $request->one_day_price,
            'one_week_price' => $request->one_week_price,
            'one_month_price' => $request->one_month_price,
        ]);

       

        foreach ($request->file('images') as  $image) {

            $imageName = $image->getClientOriginalName();
            $image->move("Accessiories/" . $a->id . "/", $imageName);
            $image = new Image();
            $image["filename"] = $imageName;
            $image["path"] = "Accessiories/" . $a->id . "/" . $imageName;
            $image->save();
            $a->images()->attach($image->id);

        }

        $am = AccessioriesAm::create([
            'name' => $request->name_am,
            'description' => $request->description_am,
            'availability' => $request->availability_am,
            'type' => $request->type_am,
            'total_pax' => $request->total_pax_am,
            'free_cancellation' => $request->free_cancellation_am,
            'one_day_price' => $request->one_day_price_am,
            'one_week_price' => $request->one_week_price_am,
            'one_month_price' => $request->one_month_price_am,
        ]);

        foreach ($request->file('images_am') as  $image) {

            $imageName = $image->getClientOriginalName();
            $image->move("Accessiories/" . $a->id . "/", $imageName);
            $image = new Image();
            $image["filename"] = $imageName;
            $image["path"] = "Accessiories/" . $a->id . "/" . $imageName;
            $image->save();
            $a->images()->attach($image->id);

        }

        $ru = AccessioriesRu::create([
            'name' => $request->name_ru,
            'description' => $request->description_ru,
            'availability' => $request->availability_ru,
            'type' => $request->type_ru,
            'total_pax' => $request->total_pax_ru,
            'free_cancellation' => $request->free_cancellation_ru,
            'one_day_price' => $request->one_day_price_ru,
            'one_week_price' => $request->one_week_price_ru,
            'one_month_price' => $request->one_month_price_ru,
        ]);

        foreach ($request->file('images_ru') as  $image) {

            $imageName = $image->getClientOriginalName();
            $image->move("Accessiories/" . $a->id . "/", $imageName);
            $image = new Image();
            $image["filename"] = $imageName;
            $image["path"] = "Accessiories/" . $a->id . "/" . $imageName;
            $image->save();
            $a->images()->attach($image->id);

        }
        return redirect()->back()->with("msg", "Created successfully!")
            ->with("success", true);
    }

   
    public function show($id)
    {
       
        $a = Accessiories::find($id)
            ->with('images')
            ->where('id', $id)
            ->first();
        return view('Backend.Admin.Services.Accessiories.show', compact('a'));

    }

  
    public function edit($id)
    {
        $a = Accessiories::find($id)
            ->with('images')
            ->where('id', $id)
            ->first();
        $am = AccessioriesAm::find($id)
        ->with('images')
        ->where('id', $id)
        ->first();
        $ru = AccessioriesRu::find($id)
        ->with('images')
        ->where('id', $id)
        ->first();
        return view('Backend.Admin.Services.Accessiories.update', compact('a','am','ru'));
        
    }

 
    public function update(Request $request, $id)
    {
        
        $a = Accessiories::find($id);
        $a->name = $request->name;
        $a->description = $request->description;
        $a->availability = $request->availability;
        $a->type = $request->type;
        $a->total_pax = $request->total_pax;
        $a->free_cancellation = $request->free_cancellation;
        $a->one_day_price = $request->one_day_price;
        $a->one_week_price = $request->one_week_price;
        $a->one_month_price = $request->one_month_price;
        $a->save();

        $a = AccessioriesAm::find($id);
        $a->name = $request->name_am;
        $a->description = $request->description_am;
        $a->availability = $request->availability_am;
        $a->type = $request->type_am;
        $a->total_pax = $request->total_pax_am;
        $a->free_cancellation = $request->free_cancellation_am;
        $a->one_day_price = $request->one_day_price_am;
        $a->one_week_price = $request->one_week_price_am;
        $a->one_month_price = $request->one_month_price_am;
        $a->save();

        $a = AccessioriesRu::find($id);
        $a->name = $request->name_ru;
        $a->description = $request->description_ru;
        $a->availability = $request->availability_ru;
        $a->type = $request->type_ru;
        $a->total_pax = $request->total_pax_ru;
        $a->free_cancellation = $request->free_cancellation_ru;
        $a->one_day_price = $request->one_day_price_ru;
        $a->one_week_price = $request->one_week_price_ru;
        $a->one_month_price = $request->one_month_price_ru;
        $a->save();
        return redirect()->back()->with("msg", "Updated successfully!")
        ->with("success", true);
    }

 
    public function destroy($id)
    {
          //delete the record
        $a = Accessiories::find($id);
        $a->delete();

        $a = AccessioriesRu::find($id);
        $a->delete();

        $a = AccessioriesAm::find($id);
        $a->delete();
        return redirect()->back()->with("msg", "Deleted successfully!")
        ->with("success", true);

    }


    //get the datas on frontend for the accessiories pass compact
    public function getAccessiories($locale = null)
    {
        if (isset($locale) && in_array($locale, config('app.available_locales'))) {
            app()->setLocale($locale);
        }
        $a = Accessiories::with('images')
            ->simplePaginate(9);

            $cms = TourAccessoriesCMS::all();
        return view('Frontend.TourAccesories.Accesories', compact('a','cms'));
    }

    //get the details of the selected accessiories
    public function getAccessioriesDetails($id, $locale = null)
    {
        if (isset($locale) && in_array($locale, config('app.available_locales'))) {
            app()->setLocale($locale);
        }
        $a = Accessiories::find($id);

        $related = Accessiories::inRandomOrder()
            ->simplePaginate(6);
        return view('Frontend.TourAccesories.Accesiorieses', compact('a','related'));
    }

    
    
}
