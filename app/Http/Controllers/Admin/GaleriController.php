<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

use App\Models\Galeri;

use Illuminate\Http\Request;



class GaleriController extends Controller
{


    public function index()
    {

        $data = Galeri::latest()
            ->get();


        return view(
            'admin.galeri.index',
            compact('data')
        );
    }




    public function store(Request $request)
    {


        $data = $request->validate([

            'judul' => 'required',

            'gambar' => 'required|image',

            'kategori' => 'nullable'

        ]);



        $data['gambar']
            =
            $request->file('gambar')
            ->store(
                'galeri',
                'public'
            );



        Galeri::create($data);



        return back();
    }





    public function destroy(Galeri $galeri)
    {


        $galeri->delete();


        return back();
    }
}
