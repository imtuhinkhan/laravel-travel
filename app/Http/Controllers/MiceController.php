<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Mice;
use App\Models\MiceAm;
use App\Models\MiceRu;
use App\Models\MiceCMS;
use Illuminate\Http\Request;

class MiceController extends Controller
{
  
    public function index()
    {
        $mices = Mice::simplePaginate(9);
        return view('Backend.Admin.Services.MICE.view', compact('mices'));
    }

 
    public function create()
    {
        return view('Backend.Admin.Services.MICE.create');
    }

    public function edit($id)
    {
        $mice = Mice::find($id);
        $miceAm = MiceAm::find($id);
        $miceRu = MiceRu::find($id);
        return view('Backend.Admin.Services.MICE.update', compact('mice','miceAm', 'miceRu'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'available' => 'required',
            'description' => 'required',
            'total_pax' => 'required',
            'personal' => 'required',
            'Products' => 'required',
            'Extra' => 'required',
            'images' => 'required',

            'name_am' => 'required',
            'available_am' => 'required',
            'description_am' => 'required',
            'total_pax_am' => 'required',
            'personal_am' => 'required',
            'Products_am' => 'required',
            'Extra_am' => 'required',
            'images_am' => 'required',

            'name_ru' => 'required',
            'available_ru' => 'required',
            'description_ru' => 'required',
            'total_pax_ru' => 'required',
            'personal_ru' => 'required',
            'Products_ru' => 'required',
            'Extra_ru' => 'required',
            'images_ru' => 'required',

        ]);
        $mice = Mice::create([
            'name' => $request->name,
            'available' => $request->available,
            'description' => $request->description,
            'total_pax' => $request->total_pax,
            'personal' => $request->personal,
            'Products' => $request->Products,
            'Extra' => $request->Extra,
        ]);
      
        foreach ($request->file('images') as  $image) {

            $imageName = $image->getClientOriginalName();
            $image->move("Mice/" . $mice->id . "/", $imageName);
            $image = new Image();
            $image["filename"] = $imageName;
            $image["path"] = "Mice/" . $mice->id . "/" . $imageName;
            $image->save();
            $mice->images()->attach($image->id);
        }

        $mice = MiceRu::create([
            'name' => $request->name_ru,
            'available' => $request->available_ru,
            'description' => $request->description_ru,
            'total_pax' => $request->total_pax_ru,
            'personal' => $request->personal_ru,
            'Products' => $request->Products_ru,
            'Extra' => $request->Extra_ru,
        ]);
      
        foreach ($request->file('images_ru') as  $image) {

            $imageName = $image->getClientOriginalName();
            $image->move("Mice/" . $mice->id . "/", $imageName);
            $image = new Image();
            $image["filename"] = $imageName;
            $image["path"] = "Mice/" . $mice->id . "/" . $imageName;
            $image->save();
            $mice->images()->attach($image->id);
        }

        $mice = MiceAm::create([
            'name' => $request->name,
            'available' => $request->available_am,
            'description' => $request->description_am,
            'total_pax' => $request->total_pax_am,
            'personal' => $request->personal_am,
            'Products' => $request->Products_am,
            'Extra' => $request->Extra_am,
        ]);
      
        foreach ($request->file('images_am') as  $image) {

            $imageName = $image->getClientOriginalName();
            $image->move("Mice/" . $mice->id . "/", $imageName);
            $image = new Image();
            $image["filename"] = $imageName;
            $image["path"] = "Mice/" . $mice->id . "/" . $imageName;
            $image->save();
            $mice->images()->attach($image->id);
        

           
        }

        return redirect()->back()->with("msg", "Created successfully!")
        ->with("success", true);
    }

  
    public function show($id)
    {
        //show the details of hotel
 
        $mice = Mice::find($id)->with('images')->where('id', $id)->first();
        return view('Backend.Admin.Services.MICE.show', compact('mice'));
 
    }


   
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'available' => 'required',
            'total_pax' => 'required',
            'personal' => 'required',
            'Products' => 'required',
            'Extra' => 'required',

            'name_am' => 'required',
            'available_am' => 'required',
            'description_am' => 'required',
            'total_pax_am' => 'required',
            'personal_am' => 'required',
            'Products_am' => 'required',
            'Extra_am' => 'required',

            'name_ru' => 'required',
            'available_ru' => 'required',
            'description_ru' => 'required',
            'total_pax_ru' => 'required',
            'personal_ru' => 'required',
            'Products_ru' => 'required',
            'Extra_ru' => 'required',
        ]);
        $mice = Mice::find($id);
        $mice->name = $request->name;
        $mice->available = $request->available;
        $mice->total_pax = $request->total_pax;
        $mice->personal = $request->personal;
        $mice->Products = $request->Products;
        $mice->Extra = $request->Extra;
        $mice->save();
        return redirect()->back()->with("msg", "Updated successfully!")
        ->with("success", true);
    }

 
    public function destroy($id)
    {
        $mice = Mice::find($id);
        $mice->delete();

        $mice = MiceAm::find($id);
        $mice->delete();

        $mice = MiceRu::find($id);
        $mice->delete();
        return redirect()->back()->with("msg", "Deleted successfully!")
        ->with("success", true);
    }

   //Show the data in the frontend
    public function showMice($locale = null)
    {
        if (isset($locale) && in_array($locale, config('app.available_locales'))) {
            app()->setLocale($locale);
        }
        if(app()->getLocale()=='hy'){
         $mices = MiceAm::with('images')->simplePaginate(9);
        }
        elseif(app()->getLocale()=='ru'){
         $mices = MiceRu::with('images')->simplePaginate(9);
        }
        else{
         $mices = Mice::with('images')->simplePaginate(9);
        }
        $cms = MiceCMS::all();
        return view('Frontend.Mice.Mices', compact('mices','cms'));
    }

    public function showMiceDetails($id, $locale = null)
    {
        if (isset($locale) && in_array($locale, config('app.available_locales'))) {
            app()->setLocale($locale);
        }
        $mice = Mice::with('images')
        ->where('id', $id)
        ->first();
        return view('Frontend.Mice.Micee', compact('mice'));
    }
}
