<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

use App\Models\Berita;

use Illuminate\Http\Request;

use Illuminate\Support\Str;



class BeritaController extends Controller
{


    public function index()
    {


        $data = Berita::latest()
            ->get();


        return view(
            'admin.berita.index',
            compact('data')
        );
    }





    public function store(Request $request)
    {


        $data = $request->validate([

            'judul' => 'required',

            'konten' => 'required',

            'thumbnail' => 'nullable|image'

        ]);



        $data['slug'] = Str::slug(
            $request->judul
        );



        if ($request->hasFile('thumbnail')) {

            $data['thumbnail']
                =
                $request->file('thumbnail')
                ->store(
                    'berita',
                    'public'
                );
        }



        Berita::create($data);



        return back();
    }






    public function update(Request $request, Berita $berita)
    {


        $berita->update(

            $request->validate([

                'judul' => 'required',

                'konten' => 'required'

            ])

        );



        return back();
    }





    public function destroy(Berita $berita)
    {

        $berita->delete();


        return back();
    }
}
