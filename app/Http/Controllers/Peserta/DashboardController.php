<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $peserta = auth()->user()->peserta;
        $pendaftaran = $peserta?->pendaftaran()->with(['jalurPendaftaran', 'periodePpdb.tahunAjaran', 'daftarUlang'])->first();
        $dokumen = $pendaftaran?->dokumenPendaftarans ?? collect();

        $currentStep = $this->resolveCurrentStep($peserta, $pendaftaran);
        $registrationComplete = $currentStep > 6;

        return view('peserta.dashboard', compact('peserta', 'pendaftaran', 'dokumen', 'currentStep', 'registrationComplete'));
    }

    protected function resolveCurrentStep($peserta, $pendaftaran): int
    {
        if (!$peserta || !$peserta->nama_lengkap || !$peserta->pas_foto) return 1;
        if (!$peserta->orangTua?->nama_ayah) return 2;
        if (!$peserta->sekolahAsal?->nama_sekolah) return 3;
        if (!$pendaftaran || !$pendaftaran->jalur_pendaftaran_id) return 4;
        if ($pendaftaran->dokumenPendaftarans()->count() === 0) return 5;
        if ($pendaftaran->status_pendaftaran === 'draft') return 6;
        if ($pendaftaran->status_pendaftaran === 'diterima' && (!$pendaftaran->daftarUlang || $pendaftaran->daftarUlang->status !== 'sudah')) return 7;

        return 8;
    }
}
