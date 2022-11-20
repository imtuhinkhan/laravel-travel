<?php

namespace App\Http\Controllers;

use App\Models\HomeCMS;
use Illuminate\Http\Request;

class HomeCmsController extends Controller
{
   

    public function edit($id)
    {
        $home = HomeCMS::find(1);

        $homeContent = HomeCMS::find(1)->first();

        return view('Backend.Admin.CMS.Home.view', compact('home','homeContent'));
        
    }

    public function update(Request $request, $id)
    {
        //update
        $this->validate($request, [
            'title' => 'required',
            'subtitle' => 'required',

            'title_ru' => 'required',
            'subtitle_ru' => 'required',

            'title_ru' => 'required',
            'subtitle_am' => 'required',
        ]);
        $home = HomeCMS::find($id);
        $home->title = $request->title;
        $home->subtitle = $request->subtitle;
        $home->title_am = $request->title_am;
        $home->subtitle_am = $request->subtitle_am;
        $home->title_ru = $request->title_ru;
        $home->subtitle_ru = $request->subtitle_ru;
        $home->save();
        return redirect()->back()->with("msg", "Updated successfully!")
        ->with("success", true);

    }

   


}
