<?php

namespace App\Http\Controllers;

use App\Models\RentCarCms;
use Illuminate\Http\Request;

class CarCmsController extends Controller
{
    public function edit($id)
    {
        $car = RentCarCms::find(1);

        $carContent = RentCarCms::find(1);

        return view('Backend.Admin.CMS.Car.view', compact('car','carContent'));
        
    }

    public function update(Request $request, $id)
    {
        //update
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'title_am' => 'required',
            'description_am' => 'required',
            'title_ru' => 'required',
            'description_ru' => 'required',
        ]);
        $car = RentCarCms::find($id);
        $car->title = $request->title;
        $car->description = $request->description;
        $car->title_am = $request->title_am;
        $car->description_am = $request->description_am;
        $car->title_ru = $request->title_ru;
        $car->description_ru = $request->description_ru;
        $car->save();
        return redirect()->back()->with("msg", "Updated successfully!")
        ->with("success", true);

    }
}
