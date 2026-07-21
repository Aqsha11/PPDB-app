<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\ProfilSekolah;
use Illuminate\Http\Request;

class SubmitPendaftaranController extends Controller
{
    public function store(Request $request)
    {
        $pendaftaran = auth()->user()->pendaftarans()->latest()->firstOrFail();

        abort_if($pendaftaran->status_pendaftaran !== 'draft', 403, 'Pendaftaran sudah disubmit.');

        $pendaftaran->update([
            'status_pendaftaran' => 'submitted',
            'tanggal_submit' => now(),
        ]);

        Notification::notifyAdmins(
            'Pendaftaran baru dari ' . $pendaftaran->peserta->nama_lengkap,
            route('admin.verifikasi.index'),
            'plus-circle'
        );

        $pendaftaran->load(['jalurPendaftaran', 'peserta']);

        $profil = ProfilSekolah::first();

        return view('peserta.pendaftaran.success', compact('pendaftaran', 'profil'));
    }
}
