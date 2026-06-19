<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

use App\Models\Pengumuman;

use Illuminate\Http\Request;

use Illuminate\Support\Str;



class PengumumanController extends Controller
{


    public function index()
    {

        $data = Pengumuman::latest()
            ->get();


        return view(
            'admin.pengumuman.index',
            compact('data')
        );
    }




    public function store(Request $request)
    {


        $data = $request->validate([

            'judul' => 'required',

            'isi' => 'required',

            'lampiran' => 'nullable'

        ]);



        $data['slug'] = Str::slug(
            $request->judul
        );



        Pengumuman::create($data);


        return back();
    }





    public function destroy(Pengumuman $pengumuman)
    {


        $pengumuman->delete();


        return back();
    }
}
