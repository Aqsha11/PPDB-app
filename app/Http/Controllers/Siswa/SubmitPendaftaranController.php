<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
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

        return redirect()->route('siswa.dashboard')
            ->with('success', 'Pendaftaran berhasil dikirim. Silakan tunggu verifikasi.');
    }
}
