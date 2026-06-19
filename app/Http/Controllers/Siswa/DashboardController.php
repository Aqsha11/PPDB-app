<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $siswa = auth()->user()->siswa;
        $pendaftaran = $siswa?->pendaftaran()->with(['jalurPendaftaran', 'periodePpdb.tahunAjaran'])->first();
        $dokumen = $pendaftaran?->dokumenPendaftarans ?? collect();

        return view('siswa.dashboard', compact('siswa', 'pendaftaran', 'dokumen'));
    }
}
