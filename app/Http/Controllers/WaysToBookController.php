<?php

namespace App\Http\Controllers;

use App\Models\WaysToBook;
use App\Models\WayToBookAm;
use App\Models\WayToBookRu;
use Illuminate\Http\Request;

class WaysToBookController extends Controller
{
   
    public function index()
    {
        $ways = WaysToBook::all();
        return view('Backend.Admin.AboutUs.waysToBook.view', compact('ways'));
    }

    
    public function create()
    {
        return view('Backend.Admin.AboutUs.waysToBook.create');
    }

   
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',

            'title_am' => 'required',
            'description_am' => 'required',

            'title_ru' => 'required',
            'description_ru' => 'required',
        ]);
        $ways = new WaysToBook;
        $ways->title = $request->title;
        $ways->description = $request->description;
        $ways->save();

        $waysAm = new WayToBookAm;
        $waysAm->title = $request->title_am;
        $waysAm->description = $request->description_am;
        $waysAm->save();

        $waysRu = new WayToBookRu;
        $waysRu->title = $request->title_ru;
        $waysRu->description = $request->description_ru;
        $waysRu->save();
        return redirect()->back()->with("msg", "Created successfully!")
        ->with("success", true);
    }

   
    public function destroy($id)
    {
    //delete
    $ways = WaysToBook::find($id);
    $ways->delete();

    $waysAm = WayToBookAm::find($id);
    $waysAm->delete();

    $waysRu = WayToBookRu::find($id);
    $waysRu->delete();
    return redirect()->back()->with("msg", "Deleted successfully!")
        ->with("success", true);
    }


    public function GetAll($locale= null)
    {

        if (isset($locale) && in_array($locale, config('app.available_locales'))) {
            app()->setLocale($locale);
        }
        $ways = WaysToBook::all();
       return view('Frontend.About.waysToBook', compact('ways'));
    }

}
