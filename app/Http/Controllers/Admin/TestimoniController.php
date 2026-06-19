<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

use App\Models\Testimoni;

use Illuminate\Http\Request;



class TestimoniController extends Controller
{


    public function index()
    {

        $data = Testimoni::all();


        return view(
            'admin.testimoni.index',
            compact('data')
        );
    }





    public function store(Request $request)
    {


        $data = $request->validate([

            'nama' => 'required',

            'isi' => 'required',

            'foto' => 'nullable|image'

        ]);



        if ($request->hasFile('foto')) {

            $data['foto']
                =
                $request->file('foto')
                ->store(
                    'testimoni',
                    'public'
                );
        }



        Testimoni::create($data);



        return back();
    }



    public function destroy(Testimoni $testimoni)
    {

        $testimoni->delete();


        return back();
    }
}
