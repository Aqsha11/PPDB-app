<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\ProfilSekolah;

use Illuminate\Http\Request;



class ProfilSekolahController extends Controller
{


    public function index()
    {

        $this->authorize('cms.manage');


        $data = ProfilSekolah::first();


        return view(
            'admin.profil.index',
            compact('data')
        );
    }





    public function update(Request $request)
    {


        $this->authorize('cms.manage');



        $data = $request->validate([


            'nama_sekolah' => 'required',

            'visi' => 'nullable',

            'misi' => 'nullable',

            'sejarah' => 'nullable',


        ]);



        ProfilSekolah::updateOrCreate(

            ['id' => 1],

            $data

        );



        return back();
    }
}
