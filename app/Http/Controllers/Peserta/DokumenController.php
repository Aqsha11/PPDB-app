<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\DokumenPendaftaran;
use App\Models\PersyaratanDokumen;
use Illuminate\Http\Request;

class DokumenController extends Controller
{
    public function index()
    {
        $pendaftaran = auth()->user()->pendaftarans()->latest()->first();
        abort_if(!$pendaftaran, 403, 'Pilih jalur pendaftaran terlebih dahulu.');

        $persyaratan = PersyaratanDokumen::where('jalur_pendaftaran_id', $pendaftaran->jalur_pendaftaran_id)->get();
        $dokumen = $pendaftaran?->dokumenPendaftarans ?? collect();

        return view('peserta.dokumen.index', compact('pendaftaran', 'persyaratan', 'dokumen'));
    }

    public function store(Request $request)
    {
        $pendaftaran = auth()->user()->pendaftarans()->latest()->firstOrFail();

        $data = $request->validate([
            'persyaratan_dokumen_id' => 'required|exists:persyaratan_dokumens,id',
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $data['pendaftaran_id'] = $pendaftaran->id;
        $data['file'] = $request->file('file')->store('dokumen-peserta', 'public');

        DokumenPendaftaran::create($data);

        return back()->with('success', 'Dokumen berhasil diupload.');
    }

    public function destroy(DokumenPendaftaran $dokumen)
    {
        abort_if($dokumen->pendaftaran->user_id !== auth()->id(), 403);
        \Illuminate\Support\Facades\Storage::disk('public')->delete($dokumen->file);
        $dokumen->delete();
        return back()->with('success', 'Dokumen berhasil dihapus.');
    }
}
