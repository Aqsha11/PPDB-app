<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\JalurPendaftaran;
use App\Models\PeriodePpdb;
use Illuminate\Http\Request;

class JalurController extends Controller
{
    public function index()
    {
        $peserta = auth()->user()->peserta;
        abort_if(!$peserta || !$peserta->nama_lengkap, 403, 'Lengkapi biodata terlebih dahulu.');

        $jalur = JalurPendaftaran::where('status', true)->get();
        $pendaftaran = auth()->user()->pendaftarans()->latest()->first();
        return view('peserta.jalur.index', compact('jalur', 'pendaftaran'));
    }

    public function store(Request $request)
    {
        $peserta = auth()->user()->peserta;
        abort_if(!$peserta, 403, 'Lengkapi biodata terlebih dahulu.');

        $data = $request->validate([
            'jalur_pendaftaran_id' => 'required|exists:jalur_pendaftarans,id',
        ]);

        $periode = PeriodePpdb::with('tahunAjaran')->where('status_aktif', true)->first();
        abort_unless($periode, 403, 'Tidak ada periode PPDB aktif saat ini.');

        $data['periode_ppdb_id'] = $periode->id;
        $data['tahun_ajaran_id'] = $periode->tahun_ajaran_id;

        $data['user_id'] = auth()->id();
        $data['peserta_id'] = $peserta->id;
        $data['status_pendaftaran'] = 'draft';
        $data['nomor_pendaftaran'] = 'PPDB-' . date('Ymd') . '-' . str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);

        $pendaftaran = auth()->user()->pendaftarans()->create($data);

        return redirect()->route('peserta.dokumen.index')
            ->with('success', 'Pendaftaran berhasil dibuat. Silakan lengkapi dokumen.');
    }
}
