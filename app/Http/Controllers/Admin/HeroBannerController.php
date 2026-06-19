<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroBanner;
use Illuminate\Http\Request;


class HeroBannerController extends Controller
{


    public function index()
    {

        $this->authorize('cms.manage');


        $data = HeroBanner::latest()->get();


        return view(
            'admin.hero.index',
            compact('data')
        );
    }



    public function store(Request $request)
    {


        $this->authorize('cms.manage');


        $data = $request->validate([

            'judul' => 'required',

            'sub_judul' => 'nullable',

            'deskripsi' => 'nullable',

            'gambar' => 'nullable|image',

        ]);



        if ($request->hasFile('gambar')) {

            $data['gambar']
                =
                $request->file('gambar')
                ->store('hero', 'public');
        }



        HeroBanner::create($data);



        return back();
    }






    public function update(Request $request, HeroBanner $heroBanner)
    {


        $this->authorize('cms.manage');


        $heroBanner->update(
            $request->validate([

                'judul' => 'required',

                'sub_judul' => 'nullable',

                'deskripsi' => 'nullable'

            ])
        );



        return back();
    }






    public function destroy(HeroBanner $heroBanner)
    {


        $this->authorize('cms.manage');


        $heroBanner->delete();


        return back();
    }
}
