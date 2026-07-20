<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

use App\Models\Seo;

use Illuminate\Http\Request;



class SeoController extends Controller
{


    public function index()
    {


        $this->authorize('cms.manage');


        $data = Seo::first();


        return view(
            'admin.seo.index',
            compact('data')
        );
    }





    public function update(Request $request)
    {


        $this->authorize('cms.manage');



        $data = $request->validate([


            'meta_title' => 'nullable',

            'meta_description' => 'nullable',

            'meta_keywords' => 'nullable',

            'og_image' => 'nullable|image',

            'favicon' => 'nullable|image'


        ]);





        if ($request->hasFile('og_image')) {

            $data['og_image']
                =
                $request->file('og_image')
                ->store(
                    'seo',
                    'public'
                );
        }





        if ($request->hasFile('favicon')) {

            $data['favicon']
                =
                $request->file('favicon')
                ->store(
                    'seo',
                    'public'
                );
        }




        Seo::updateOrCreate(

            [

                'id' => 1

            ],

            $data

        );



        return back()->with('success', 'SEO berhasil diperbarui.');
    }
}
