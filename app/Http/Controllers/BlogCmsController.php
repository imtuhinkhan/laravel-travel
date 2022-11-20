<?php

namespace App\Http\Controllers;

use App\Models\BlogCMS;
use Illuminate\Http\Request;

class BlogCmsController extends Controller
{
    public function edit($id)
    {
        $blog = BlogCMS::find(1);

        $blogContent = BlogCMS::find(1)->first();

        return view('Backend.Admin.CMS.Blog.view', compact('blog','blogContent'));
        
    }

    public function update(Request $request, $id)
    {
        //update
        $this->validate($request, [
            'title' => 'required',
            'subtitle' => 'required',

            'title_am' => 'required',
            'subtitle_am' => 'required',

            'title_ru' => 'required',
            'subtitle_ru' => 'required',
        ]);
        $blog = BlogCMS::find($id);
        $blog->title = $request->title;
        $blog->subtitle = $request->subtitle;
        $blog->title_am = $request->title_am;
        $blog->subtitle_am = $request->subtitle_am;
        $blog->title_ru = $request->title_ru;
        $blog->subtitle_ru= $request->subtitle_ru;
        $blog->save();
        return redirect()->back()->with("msg", "Updated successfully!")
        ->with("success", true);

    }
}
