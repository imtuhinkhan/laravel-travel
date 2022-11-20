<?php

namespace App\Http\Controllers;

use App\Models\HotelCMS;
use Illuminate\Http\Request;

class HotelCmsController extends Controller
{
    public function edit($id)
    {
        $hotel = HotelCMS::find(1);

        $hotelContent = HotelCMS::find(1)->first();

        return view('Backend.Admin.CMS.Hotel.view', compact('hotel','hotelContent'));
        
    }

    public function update(Request $request, $id)
    {
        //update
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]);
        $hotel = HotelCMS::find($id);
        $hotel->title = $request->title;
        $hotel->description = $request->description;
        $hotel->title_am = $request->title_am;
        $hotel->description_am = $request->description_am;
        $hotel->title_ru = $request->title_ru;
        $hotel->description_ru = $request->description_ru;
        $hotel->save();
        return redirect()->back()->with("msg", "Updated successfully!")
        ->with("success", true);

    }
}
