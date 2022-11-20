<?php

namespace App\Http\Controllers;

use App\Models\TourCMS;
use Illuminate\Http\Request;

class TourCmsController extends Controller
{
    public function edit($id)
    {
        $tour = TourCMS::find(1);

        $tourContent = TourCMS::find(1)->first();

        return view('Backend.Admin.CMS.Tour.view', compact('tour','tourContent'));
        
    }

    public function update(Request $request, $id)
    {
        //update
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',

            'title_ru' => 'required',
            'description_ru' => 'required',

            'title_am' => 'required',
            'description_am' => 'required',
        ]);
        $tour = TourCMS::find($id);
        $tour->title = $request->title;
        $tour->description = $request->description;
        $tour->title_am = $request->title_am;
        $tour->description_am = $request->description_am;
        $tour->title_ru = $request->title_ru;
        $tour->description_ru = $request->description_ru;
        $tour->save();
        return redirect()->back()->with("msg", "Updated successfully!")
        ->with("success", true);

    }
}
