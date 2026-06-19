<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MediaSosial;
use Illuminate\Http\Request;


class MediaSosialController extends Controller
{


    public function index()
    {

        $this->authorize('cms.manage');


        $data = MediaSosial::orderBy('urutan')
            ->get();


        return view(
            'admin.media-sosial.index',
            compact('data')
        );
    }





    public function store(Request $request)
    {


        $this->authorize('cms.manage');


        MediaSosial::create(

            $request->validate([


                'platform' => 'required',

                'icon' => 'nullable',

                'url' => 'required',

                'urutan' => 'nullable',

            ])

        );



        return back();
    }





    public function update(Request $request, MediaSosial $mediaSosial)
    {


        $this->authorize('cms.manage');


        $mediaSosial->update(

            $request->validate([

                'platform' => 'required',

                'url' => 'required'

            ])

        );


        return back();
    }





    public function destroy(MediaSosial $mediaSosial)
    {


        $this->authorize('cms.manage');


        $mediaSosial->delete();


        return back();
    }
}
