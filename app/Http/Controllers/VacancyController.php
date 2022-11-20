<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Vacancy;
use App\Models\VacancyAm;
use App\Models\VacancyRu;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    public function index()
    {
        $vacancies = Vacancy::all();
        return view('Backend.Admin.AboutUs.vacancy.view', compact('vacancies'));
    }
    
    public function create()
    {
        return view('Backend.Admin.AboutUs.vacancy.create');
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'images' => 'required',

            'title_ru' => 'required',
            'description_ru' => 'required',
            'images_ru' => 'required',

            'title_am' => 'required',
            'description_am' => 'required',
            'images_am' => 'required',
        ]);
        $vacancies = new Vacancy;
        $vacancies->title = $request->title;
        $vacancies->description = $request->description;
        $vacancies->save();

        foreach ($request->file('images') as  $image) {

            $imageName = $image->getClientOriginalName();
            $image->move("Vacancy/" . $vacancies->id . "/", $imageName);
            $image = new Image();
            $image["filename"] = $imageName;
            $image["path"] = "Vacancy/" . $vacancies->id . "/" . $imageName;
            $image->save();
            $vacancies->images()->attach($image->id);
        
        }

        $vacanciesAm = new VacancyAm;
        $vacanciesAm->title = $request->title_am;
        $vacanciesAm->description = $request->description_am;
        $vacanciesAm->save();

        foreach ($request->file('images_am') as  $image) {

            $imageName = $image->getClientOriginalName();
            $image->move("Vacancy/" . $vacancies->id . "/", $imageName);
            $image = new Image();
            $image["filename"] = $imageName;
            $image["path"] = "Vacancy/" . $vacancies->id . "/" . $imageName;
            $image->save();
            $vacanciesAm->images()->attach($image->id);
        
        }

        $vacanciesRu = new VacancyRU;
        $vacanciesRu->title = $request->title_ru;
        $vacanciesRu->description = $request->description_ru;
        $vacanciesRu->save();

        foreach ($request->file('images_ru') as  $image) {

            $imageName = $image->getClientOriginalName();
            $image->move("Vacancy/" . $vacancies->id . "/", $imageName);
            $image = new Image();
            $image["filename"] = $imageName;
            $image["path"] = "Vacancy/" . $vacancies->id . "/" . $imageName;
            $image->save();
            $vacanciesRu->images()->attach($image->id);
        
        }


        return redirect()->back()->with("msg", "Created successfully!")
        ->with("success", true);
    }
    
    public function destroy($id)
    {
    //delete
    $vacancies = Vacancy::find($id);
    $vacancies->delete();

    $vacancies = VacancyAm::find($id);
    $vacancies->delete();

    $vacancies = VacancyRu::find($id);
    $vacancies->delete();
    return redirect()->back()->with("msg", "Deleted successfully!")
        ->with("success", true);
    }
    
    public function GetAll($locale = null)
    {
        if (isset($locale) && in_array($locale, config('app.available_locales'))) {
            app()->setLocale($locale);
        }
        $vacancies = Vacancy::all();
        return view('Frontend.Vacancy.vacancy', compact('vacancies'));
     
    }
}
