<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

use App\Models\Kontak;

use Illuminate\Http\Request;



class KontakController extends Controller
{


    public function index()
    {


        $this->authorize('cms.manage');


        $data = Kontak::first();


        return view(
            'admin.kontak.index',
            compact('data')
        );
    }





    public function update(Request $request)
    {


        $this->authorize('cms.manage');


        Kontak::updateOrCreate(

            [

                'id' => 1

            ],

            $request->validate([


                'alamat' => 'required',

                'email' => 'nullable|email',

                'telepon' => 'nullable',

                'whatsapp' => 'nullable',

                'google_maps' => 'nullable'

            ])


        );



        return back();
    }
}
