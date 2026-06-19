<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Pendaftaran;
use App\Models\Siswa;
use App\Models\HasilSeleksi;

class DashboardController extends Controller
{

    public function index()
    {

        abort_unless(
            auth()->user()->can('dashboard.view'),
            403
        );


        return view('admin.dashboard', [


            'totalSiswa' => Siswa::count(),


            'totalPendaftar' => Pendaftaran::count(),


            'diterima' => HasilSeleksi::where(
                'status',
                'diterima'
            )->count(),



            'pending' => Pendaftaran::where(
                'status_pendaftaran',
                'submitted'
            )->count(),


        ]);
    }
}
