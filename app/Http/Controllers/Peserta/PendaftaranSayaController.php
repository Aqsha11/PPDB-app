<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\ProfilSekolah;

class PendaftaranSayaController extends Controller
{
    public function index()
    {
        $peserta = auth()->user()->peserta;
        $pendaftaran = $peserta?->pendaftaran()
            ->with(['jalurPendaftaran', 'periodePpdb.tahunAjaran'])
            ->latest()
            ->first();

        return view('peserta.pendaftaran.index', compact('peserta', 'pendaftaran'));
    }

    public function cetak()
    {
        $peserta = auth()->user()->peserta;
        $pendaftaran = $peserta?->pendaftaran()
            ->with(['jalurPendaftaran', 'periodePpdb.tahunAjaran', 'dokumenPendaftarans.persyaratanDokumen'])
            ->latest()
            ->first();

        if (!$pendaftaran) {
            return redirect()->route('peserta.dashboard')->with('error', 'Belum ada pendaftaran.');
        }

        $profil = ProfilSekolah::first();

        return view('peserta.pendaftaran.cetak', compact('peserta', 'pendaftaran', 'profil'));
    }
}
