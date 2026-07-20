<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

use App\Models\DaftarUlang;
use App\Models\Notification;
use App\Models\Pendaftaran;

use Illuminate\Http\Request;



class DaftarUlangController extends Controller
{


    public function index()
    {

        $this->authorize('seleksi.view');

        $data = Pendaftaran::with(['peserta.user', 'jalurPendaftaran', 'daftarUlang'])

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

        $data = $request->validate([

            'status' => 'required|in:sudah,belum',

            'catatan' => 'nullable'

        ]);

        DaftarUlang::updateOrCreate(

            [

                'pendaftaran_id' =>
                $pendaftaran->id

            ],


            [

                'status' =>
                $data['status'],


                'tanggal_daftar_ulang' =>
                now(),


                'catatan' =>
                $data['catatan']

            ]

        );

        if ($pendaftaran->peserta) {
            $label = $data['status'] == 'sudah' ? 'Sudah daftar ulang' : 'Belum daftar ulang';
            Notification::notifyPeserta(
                $pendaftaran->peserta,
                'Daftar ulang: ' . $label,
                '#',
                $data['status'] == 'sudah' ? 'check-circle' : 'clock'
            );
        }

        return back()->with('success', 'Daftar ulang berhasil dikonfirmasi.');
    }
}
