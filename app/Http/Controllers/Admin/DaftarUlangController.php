<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

use App\Models\DaftarUlang;

use App\Models\Pendaftaran;

use Illuminate\Http\Request;



class DaftarUlangController extends Controller
{


    public function index()
    {


        $data = Pendaftaran::with('siswa')

            ->where(
                'status_pendaftaran',
                'diterima'
            )

            ->get();



        return view(
            'admin.daftar-ulang.index',
            compact('data')
        );
    }






    public function update(Request $request, Pendaftaran $pendaftaran)
    {


        $this->authorize('seleksi.edit');



        DaftarUlang::updateOrCreate(

            [

                'pendaftaran_id' =>
                $pendaftaran->id

            ],


            [

                'status' =>
                $request->status,


                'tanggal_daftar_ulang' =>
                now(),


                'catatan' =>
                $request->catatan

            ]

        );



        return back();
    }
}
