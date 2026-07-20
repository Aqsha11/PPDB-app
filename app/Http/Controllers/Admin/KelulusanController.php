<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

use App\Models\HasilSeleksi;
use App\Models\Notification;
use App\Models\Pendaftaran;

use Illuminate\Http\Request;


class KelulusanController extends Controller
{


    public function index()
    {


        $this->authorize('seleksi.view');



        $data = Pendaftaran::with(
            ['peserta.user', 'jalurPendaftaran', 'hasilSeleksi']
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


            'pendaftaran_id' => 'required|exists:pendaftarans,id',

            'nilai' => 'nullable',

            'status' => 'required|in:diterima,ditolak,cadangan',

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

        $pendaftaran = Pendaftaran::with('peserta')->find($data['pendaftaran_id']);
        if ($pendaftaran && $pendaftaran->peserta) {
            $labels = ['diterima' => 'Diterima', 'ditolak' => 'Ditolak', 'cadangan' => 'Cadangan'];
            $icons = ['diterima' => 'check-circle', 'ditolak' => 'x-circle', 'cadangan' => 'clock'];
            Notification::notifyPeserta(
                $pendaftaran->peserta,
                'Hasil seleksi: ' . ($labels[$data['status']] ?? $data['status']),
                '#',
                $icons[$data['status']] ?? 'info'
            );
        }





        return back()
            ->with(
                'success',
                'Hasil seleksi disimpan'
            );
    }
}
