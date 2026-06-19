<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\JalurPendaftaran;
use Illuminate\Http\Request;

class JalurController extends Controller
{
    public function index()
    {
        $jalur = JalurPendaftaran::where('status', true)->get();
        $pendaftaran = auth()->user()->pendaftarans()->latest()->first();
        return view('siswa.jalur.index', compact('jalur', 'pendaftaran'));
    }

    public function store(Request $request)
    {
        $siswa = auth()->user()->siswa;
        abort_if(!$siswa, 403, 'Lengkapi biodata terlebih dahulu.');

        $data = $request->validate([
            'jalur_pendaftaran_id' => 'required|exists:jalur_pendaftarans,id',
            'periode_ppdb_id' => 'required|exists:periode_ppdbs,id',
        ]);

        $data['user_id'] = auth()->id();
        $data['siswa_id'] = $siswa->id;
        $data['status_pendaftaran'] = 'draft';
        $data['nomor_pendaftaran'] = 'PPDB-' . date('Ymd') . '-' . str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);

        $pendaftaran = auth()->user()->pendaftarans()->create($data);

        return redirect()->route('siswa.dokumen.index')
            ->with('success', 'Pendaftaran berhasil dibuat. Silakan lengkapi dokumen.');
    }
}
