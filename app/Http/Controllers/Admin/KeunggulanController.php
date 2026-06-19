<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

use App\Models\KeunggulanSekolah;

use Illuminate\Http\Request;


class KeunggulanController extends Controller
{


    public function index()
    {


        $data = KeunggulanSekolah::all();


        return view(
            'admin.keunggulan.index',
            compact('data')
        );
    }




    public function store(Request $request)
    {


        $data = $request->validate([

            'judul' => 'required',

            'deskripsi' => 'nullable',

            'icon' => 'nullable',

            'gambar' => 'nullable|image'

        ]);



        if ($request->gambar) {

            $data['gambar']
                =
                $request->file('gambar')
                ->store('keunggulan', 'public');
        }



        KeunggulanSekolah::create($data);



        return back();
    }




    public function destroy(KeunggulanSekolah $keunggulan)
    {


        $keunggulan->delete();


        return back();
    }
}
