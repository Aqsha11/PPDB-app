<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;

class PengumumanController extends Controller
{
    public function index()
    {
        $data = Pengumuman::latest()->get();
        $pendaftaran = auth()->user()->pendaftarans()
            ->with('jalurPendaftaran')
            ->whereIn('status_pendaftaran', ['diterima', 'ditolak', 'cadangan'])
            ->latest()
            ->first();
        return view('peserta.pengumuman.index', compact('data', 'pendaftaran'));
    }
}
