<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

use App\Models\VerifikasiPendaftaran;

use App\Models\Pendaftaran;

use Illuminate\Http\Request;


class VerifikasiController extends Controller
{


    public function index()
    {


        $this->authorize('pendaftaran.verify');


        $data = Pendaftaran::with([
            'siswa',
            'dokumenPendaftarans'
        ])
            ->where(
                'status_pendaftaran',
                'submitted'
            )
            ->get();



        return view(
            'admin.verifikasi.index',
            compact('data')
        );
    }






    public function update(Request $request, Pendaftaran $pendaftaran)
    {


        $this->authorize('pendaftaran.verify');



        $request->validate([


            'status' => 'required',

            'catatan' => 'nullable'


        ]);





        VerifikasiPendaftaran::updateOrCreate(

            [

                'pendaftaran_id' => $pendaftaran->id

            ],


            [

                'verifikator_id' => auth()->id(),

                'status' => $request->status,

                'catatan' => $request->catatan,

                'tanggal_verifikasi' => now()

            ]

        );





        $pendaftaran->update([


            'status_pendaftaran' =>

            $request->status == 'terverifikasi'

                ?

                'verifikasi'

                :

                'draft'


        ]);




        return back()
            ->with(
                'success',
                'Verifikasi berhasil'
            );
    }
}
