<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

use App\Models\Video;

use Illuminate\Http\Request;



class VideoController extends Controller
{


    public function index()
    {

        $data = Video::all();


        return view(
            'admin.video.index',
            compact('data')
        );
    }





    public function store(Request $request)
    {


        Video::create(

            $request->validate([

                'judul' => 'required',

                'youtube_url' => 'required'

            ])

        );


        return back();
    }





    public function destroy(Video $video)
    {

        $video->delete();


        return back();
    }
}
