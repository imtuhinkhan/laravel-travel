<?php

namespace App\Http\Controllers;

use App\Models\BlogCMS;
use App\Models\Image;
use App\Models\TravelBlog;
use App\Models\TravelAmBlog;
use App\Models\TravelRuBlog;
use Illuminate\Http\Request;

class TravelBlogController extends Controller
{
  
    public function index()
    {

        $travelBlogs = TravelBlog::simplePaginate(9);
        return view('Backend.Admin.Armenia.TravelBlog.view', compact('travelBlogs'));
    }

   
    public function create()
    {
        return view('Backend.Admin.Armenia.TravelBlog.create');
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'type' => 'required',
            'description' => 'required',
            'more_description' => 'required',
            'images' => 'required',

            'title_am' => 'required',
            'type_am' => 'required',
            'description_am' => 'required',
            'more_description_am' => 'required',
            'images_am' => 'required',

            'title_ru' => 'required',
            'type_ru' => 'required',
            'description_ru' => 'required',
            'more_description_ru' => 'required',
            'images_ru' => 'required',
        ]);
        $travelBlog = TravelBlog::create([
            'title' => $request->title,
            'type' => $request->type,
            'more_description' => $request->more_description,
            'description' => $request->description,
        ]);
        foreach ($request->file('images') as  $image) {
            $imageName = $image->getClientOriginalName();
            $image->move("TravelBlog/" . $travelBlog->id . "/", $imageName);
            $image = new Image();
            $image["filename"] = $imageName;
            $image["path"] = "TravelBlog/" . $travelBlog->id . "/" . $imageName;
            $image->save();
            $travelBlog->images()->attach($image->id);
        }

        $travelBlog = TravelAmBlog::create([
            'title' => $request->title_am,
            'type' => $request->type_am,
            'more_description' => $request->more_description_am,
            'description' => $request->description_am,
        ]);
        foreach ($request->file('images_am') as  $image) {
            $imageName = $image->getClientOriginalName();
            $image->move("TravelBlog/" . $travelBlog->id . "/", $imageName);
            $image = new Image();
            $image["filename"] = $imageName;
            $image["path"] = "TravelBlog/" . $travelBlog->id . "/" . $imageName;
            $image->save();
            $travelBlog->images()->attach($image->id);
        }

        $travelBlog = TravelRuBlog::create([
            'title' => $request->title_ru,
            'type' => $request->type_ru,
            'more_description' => $request->more_description_ru,
            'description' => $request->description_ru,
        ]);
        foreach ($request->file('images_ru') as  $image) {
            $imageName = $image->getClientOriginalName();
            $image->move("TravelBlog/" . $travelBlog->id . "/", $imageName);
            $image = new Image();
            $image["filename"] = $imageName;
            $image["path"] = "TravelBlog/" . $travelBlog->id . "/" . $imageName;
            $image->save();
            $travelBlog->images()->attach($image->id);
        }
        return redirect()->back()->with("msg", "Created successfully!")
        ->with("success", true);
    }

   
    public function show($id)
    {
        
        $travelBlog = TravelBlog::find($id)->with('images')->where('id', $id)->first();
        return view('Backend.Admin.Armenia.TravelBlog.show', compact('travelBlog'));

    }

   
    public function edit($id)
    {
        $travelBlog = TravelBlog::find($id);
        $travelBlogAm = TravelAmBlog::find($id);
        $travelBlogRu = TravelRuBlog::find($id);
        return view('Backend.Admin.Armenia.TravelBlog.update', compact('travelBlog','travelBlogAm','travelBlogRu'));
    }

   
    public function update(Request $request, $id)
    {
       // update
       $travelBlog = TravelBlog::find($id);
       $travelBlog->title = $request->title;
       $travelBlog->type = $request->type;
       $travelBlog->more_description = $request->more_description;
       $travelBlog->description = $request->description;
       $travelBlog->save();

       $travelBlog = TravelAmBlog::find($id);
       $travelBlog->title = $request->title_am;
       $travelBlog->type = $request->type_am;
       $travelBlog->more_description = $request->more_description_am;
       $travelBlog->description = $request->description_am;
       $travelBlog->save();

       $travelBlog = TravelRuBlog::find($id);
       $travelBlog->title = $request->title_ru;
       $travelBlog->type = $request->type_ru;
       $travelBlog->more_description = $request->more_description_ru;
       $travelBlog->description = $request->description_ru;
       $travelBlog->save();
      
       return redirect()->back()->with("msg", "Upadated successfully!")
       ->with("success", true);
    }

   
    public function destroy($id)
    {
        $travelBlog = TravelBlog::find($id);
        $travelBlog->delete();

        $travelBlog = TravelAmBlog::find($id);
        $travelBlog->delete();

        $travelBlog = TravelRuBlog::find($id);
        $travelBlog->delete();
        return redirect()->back()->with("msg", "Deleted successfully!")
        ->with("success", true);
    }

    //get it on frontend
    public function getTravelBlog($locale = null)
    {
        if (isset($locale) && in_array($locale, config('app.available_locales'))) {
            app()->setLocale($locale);
        }
        if(app()->getLocale()=='hy'){
            $travelBlogs = TravelAmBlog::with('images')->simplePaginate(9);
        }
        elseif(app()->getLocale()=='ru'){
            $travelBlogs = TravelRuBlog::with('images')->simplePaginate(9);
        }
        else{
            $travelBlogs = TravelBlog::with('images')->simplePaginate(9);
        }
        $cms = BlogCMS::all();
        return view('Frontend.Blogs.Articles', compact('travelBlogs', 'cms'));
    }

    //get it on frontend

    public function getTravelBlogById($id, $locale = null)
    {

        if (isset($locale) && in_array($locale, config('app.available_locales'))) {
            app()->setLocale($locale);
        }
        if(app()->getLocale()=='hy'){
            $travelBlog = TravelAmBlog::find($id)
            ->with('images')
            ->where('id', $id)
            ->first();
        }
        elseif(app()->getLocale()=='ru'){
            $travelBlog = TravelRuBlog::find($id)
            ->with('images')
            ->where('id', $id)
            ->first();
        }
        else{
            $travelBlog = TravelBlog::find($id)
            ->with('images')
            ->where('id', $id)
            ->first();
        }
        
        return view('Frontend.Blogs.Article', compact('travelBlog'));
    }



}
