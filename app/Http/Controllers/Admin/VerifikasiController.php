<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

use App\Models\DokumenPendaftaran;
use App\Models\Notification;
use App\Models\VerifikasiPendaftaran;

use App\Models\Pendaftaran;

use Illuminate\Http\Request;


class VerifikasiController extends Controller
{


    public function index()
    {


        $this->authorize('pendaftaran.verify');


        $data = Pendaftaran::with([
            'peserta.user',
            'jalurPendaftaran',
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



    public function update(Request $request, Pendaftaran $verifikasi)
    {


        $this->authorize('pendaftaran.verify');



        $request->validate([


            'status' => 'required|in:terverifikasi,ditolak',

            'catatan' => 'nullable'


        ]);








        VerifikasiPendaftaran::updateOrCreate(

            [

                'pendaftaran_id' => $verifikasi->id

            ],


            [

                'verifikator_id' => auth()->id(),

                'status' => $request->status,

                'catatan' => $request->catatan,

                'tanggal_verifikasi' => now()

            ]

        );





        $verifikasi->update([


            'status_pendaftaran' =>

            $request->status == 'terverifikasi'

                ?

                'verifikasi'

                :

                'ditolak'


        ]);

        $docStatus = $request->status == 'terverifikasi' ? 'terverifikasi' : 'revisi';
        DokumenPendaftaran::where('pendaftaran_id', $verifikasi->id)->update([
            'status' => $docStatus,
            'verified_at' => $request->status == 'terverifikasi' ? now() : null,
        ]);

        if ($verifikasi->peserta) {
            $statusLabel = $request->status == 'terverifikasi' ? 'Terverifikasi' : 'Ditolak';
            Notification::notifyPeserta(
                $verifikasi->peserta,
                'Verifikasi pendaftaran: ' . $statusLabel,
                '#',
                $request->status == 'terverifikasi' ? 'check-circle' : 'x-circle'
            );
        }




        return back()
            ->with(
                'success',
                'Verifikasi berhasil'
            );
    }
}
