<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DokumenPendaftaran;
use Illuminate\Http\Request;

class DokumenController extends Controller
{
    public function index()
    {
        $this->authorize('dokumen.view');
        $data = DokumenPendaftaran::with(['pendaftaran.peserta', 'persyaratanDokumen'])->latest()->paginate(20);
        return view('admin.dokumen-peserta.index', compact('data'));
    }

    public function show(DokumenPendaftaran $dokumenPeserta)
    {
        $this->authorize('dokumen.view');
        $dokumenPeserta->load(['pendaftaran.peserta', 'persyaratanDokumen']);
        return view('admin.dokumen-peserta.show', compact('dokumenPeserta'));
    }

    public function destroy(DokumenPendaftaran $dokumenPeserta)
    {
        $this->authorize('dokumen.delete');
        \Illuminate\Support\Facades\Storage::disk('public')->delete($dokumenPeserta->file);
        $dokumenPeserta->delete();
        return back()->with('success', 'Dokumen berhasil dihapus.');
    }
}
