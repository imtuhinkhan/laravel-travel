<?php

namespace App\Http\Controllers;

use App\Models\MiceCMS;
use Illuminate\Http\Request;

class MiceCmsController extends Controller
{
    public function edit($id)
    {
        $mice = MiceCMS::find(1);

        $miceContent = MiceCMS::find(1)->first();

        return view('Backend.Admin.CMS.Mice.view', compact('mice','miceContent'));
        
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
        $mice = MiceCMS::find($id);
        $mice->title = $request->title;
        $mice->description = $request->description;
        $mice->title_ru = $request->title_ru;
        $mice->description_ru = $request->description_ru;
        $mice->title_am = $request->title_am;
        $mice->description_am = $request->description_am;
        $mice->save();
        return redirect()->back()->with("msg", "Updated successfully!")
        ->with("success", true);

    }
}
