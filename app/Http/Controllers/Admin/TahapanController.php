<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

use App\Models\TahapanPpdb;

use Illuminate\Http\Request;



class TahapanController extends Controller
{


    public function index()
    {

        $data = TahapanPpdb::all();


        return view(
            'admin.tahapan.index',
            compact('data')
        );
    }



    public function store(Request $request)
    {


        TahapanPpdb::create(

            $request->validate([

                'judul' => 'required',

                'deskripsi' => 'nullable',

                'urutan' => 'required'

            ])

        );



        return back();
    }



    public function destroy(TahapanPpdb $tahapan)
    {

        $tahapan->delete();


        return back();
    }
}
