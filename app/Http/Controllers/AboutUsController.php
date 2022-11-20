<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\AboutUsAm;
use App\Models\AboutUsRu;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index($locale =  null)
    {

        if (isset($locale) && in_array($locale, config('app.available_locales'))) {
            app()->setLocale($locale);
        }
        $aboutUs = AboutUs::all();
        return view('Frontend.About.aboutUs', compact('aboutUs'));
    }

    public function create()
    {
        return view('Backend.Admin.AboutUs.WhoWeAre.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',

            'title_am' => 'required',
            'description_am' => 'required',

            'title_ru' => 'required',
            'description_ru' => 'required',
        ]);

        $aboutUs = new AboutUs();
        $aboutUs->title = $request->title;
        $aboutUs->description = $request->description;
        $aboutUs->save();

        $aboutUsAm = new AboutUsAm();
        $aboutUsAm->title = $request->title_am;
        $aboutUsAm->description = $request->description_am;
        $aboutUsAm->save();

        $aboutUsRu = new AboutUsRu();
        $aboutUsRu->title = $request->title_ru;
        $aboutUsRu->description = $request->description_ru;
        $aboutUsRu->save();
        return redirect()->back()
            ->with("msg", "Added successfully!")
            ->with("success", true);
    }

    public function edit($id)
    {
        $aboutUs = AboutUs::find($id);
        return view('Frontend.About.EditAboutUs', compact('aboutUs'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $aboutUs = AboutUs::find($id);
        $aboutUs->title = $request->title;
        $aboutUs->description = $request->description;
        $aboutUs->save();
        return redirect()->back()
            ->with("msg", "Updated successfully!")
            ->with("success", true);
    }

    public function destroy($id)
    {
        $aboutUs = AboutUs::find($id);
        $aboutUs->delete();
        return redirect()->back()
            ->with("msg", "Deleted successfully!")
            ->with("success", true);
    }

  

    public function index2()
    {
        $aboutUs = AboutUs::all();
        return view('Backend.Admin.AboutUs.WhoWeAre.view', compact('aboutUs'));
    }
}
