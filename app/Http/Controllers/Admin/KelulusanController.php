<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

use App\Models\HasilSeleksi;

use App\Models\Pendaftaran;

use Illuminate\Http\Request;


class KelulusanController extends Controller
{


    public function index()
    {


        $this->authorize('seleksi.view');



        $data = Pendaftaran::with(
            'siswa'
        )
            ->where(
                'status_pendaftaran',
                'verifikasi'
            )
            ->get();



        return view(
            'admin.kelulusan.index',
            compact('data')
        );
    }








    public function store(Request $request)
    {


        $this->authorize('seleksi.create');



        $data = $request->validate([


            'pendaftaran_id' => 'required',

            'nilai' => 'nullable',

            'status' => 'required',

            'keterangan' => 'nullable'


        ]);




        HasilSeleksi::updateOrCreate(

            [

                'pendaftaran_id' =>
                $data['pendaftaran_id']

            ],


            $data

        );





        Pendaftaran::find(

            $data['pendaftaran_id']

        )
            ->update([


                'status_pendaftaran' =>
                $data['status']


            ]);





        return back()
            ->with(
                'success',
                'Hasil seleksi disimpan'
            );
    }
}
