<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

use App\Models\PersyaratanDokumen;

use Illuminate\Http\Request;

use Illuminate\Support\Str;



class PersyaratanDokumenController extends Controller
{


    public function index()
    {


        $this->authorize('dokumen.view');



        $data =
            PersyaratanDokumen::with(
                'jalurPendaftaran'
            )
            ->get();



        return view(
            'admin.dokumen.index',
            compact('data')
        );
    }





    public function store(Request $request)
    {


        $this->authorize('dokumen.create');



        $data = $request->validate([


            'jalur_pendaftaran_id' => 'required',

            'nama' => 'required',


        ]);



        $data['slug'] = Str::slug(
            $request->nama
        );



        PersyaratanDokumen::create($data);



        return back();
    }




    public function destroy(PersyaratanDokumen $persyaratanDokumen)
    {


        $this->authorize('dokumen.delete');


        $persyaratanDokumen->delete();



        return back();
    }
}
