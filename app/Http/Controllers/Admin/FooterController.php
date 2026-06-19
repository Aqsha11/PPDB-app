<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

use App\Models\Footer;

use Illuminate\Http\Request;



class FooterController extends Controller
{


    public function index()
    {


        $this->authorize('cms.manage');


        $data = Footer::first();


        return view(
            'admin.footer.index',
            compact('data')
        );
    }





    public function update(Request $request)
    {


        $this->authorize('cms.manage');


        Footer::updateOrCreate(

            [

                'id' => 1

            ],

            $request->validate([


                'copyright' => 'required',

                'deskripsi' => 'nullable'


            ])

        );



        return back();
    }
}
