<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DokumenPendaftaran;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class DokumenController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('dokumen.view');

        $query = Pendaftaran::with(['peserta.user', 'dokumenPendaftarans.persyaratanDokumen'])
            ->whereHas('dokumenPendaftarans')
            ->withCount('dokumenPendaftarans');

        $search = $request->input('search');
        if ($search) {
            $query->whereHas('peserta', function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                    ->orWhere('nisn', 'like', "%{$search}%");
            });
        }

        $pendaftarans = $query->latest()->paginate(20)->withQueryString();

        return view('admin.dokumen-peserta.index', compact('pendaftarans'));
    }

    public function show(Pendaftaran $dokumenPeserta)
    {
        $this->authorize('dokumen.view');

        $dokumenPeserta->load([
            'peserta.user',
            'jalurPendaftaran',
            'dokumenPendaftarans.persyaratanDokumen',
        ]);

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
