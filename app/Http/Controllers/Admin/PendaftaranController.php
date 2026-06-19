<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Pendaftaran;

use Illuminate\Http\Request;


class PendaftaranController extends Controller
{


    public function index()
    {

        $this->authorize('pendaftaran.view');


        $data = Pendaftaran::with([

            'siswa',

            'jalurPendaftaran',

            'periodePpdb'

        ])
            ->latest()
            ->get();



        return view(
            'admin.pendaftaran.index',
            compact('data')
        );
    }





    public function show(Pendaftaran $pendaftaran)
    {


        $this->authorize('pendaftaran.view');



        $pendaftaran->load([

            'siswa',

            'dokumenPendaftarans',

            'hasilSeleksi'

        ]);



        return view(
            'admin.pendaftaran.show',
            compact('pendaftaran')
        );
    }





    public function destroy(Pendaftaran $pendaftaran)
    {

        $this->authorize('pendaftaran.delete');


        $pendaftaran->delete();


        return back()
            ->with(
                'success',
                'Pendaftaran dihapus'
            );
    }
}
