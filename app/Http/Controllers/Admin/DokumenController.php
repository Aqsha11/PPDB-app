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
        $data = DokumenPendaftaran::with(['pendaftaran.siswa', 'persyaratanDokumen'])->latest()->paginate(20);
        return view('admin.dokumen-siswa.index', compact('data'));
    }

    public function show(DokumenPendaftaran $dokumenSiswa)
    {
        $this->authorize('dokumen.view');
        $dokumenSiswa->load(['pendaftaran.siswa', 'persyaratanDokumen']);
        return view('admin.dokumen-siswa.show', compact('dokumenSiswa'));
    }

    public function destroy(DokumenPendaftaran $dokumenSiswa)
    {
        $this->authorize('dokumen.delete');
        $dokumenSiswa->delete();
        return back()->with('success', 'Dokumen berhasil dihapus.');
    }
}
