<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PersyaratanDokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PersyaratanDokumenController extends Controller
{
    public function index()
    {
        $this->authorize('dokumen.view');

        $data = PersyaratanDokumen::with('jalurPendaftaran')->get();

        return view('admin.dokumen.index', compact('data'));
    }

    public function create()
    {
        $this->authorize('dokumen.create');

        $jalur = \App\Models\JalurPendaftaran::all();

        return view('admin.dokumen.create', compact('jalur'));
    }

    public function show(PersyaratanDokumen $dokumen_persyaratan)
    {
        $this->authorize('dokumen.view');

        $data = $dokumen_persyaratan;

        return view('admin.dokumen.show', compact('data'));
    }

    public function store(Request $request)
    {
        $this->authorize('dokumen.create');

        $request->validate([
            'jalur_pendaftaran_id' => 'required',
            'nama_dokumen' => 'required',
        ]);

        $format = $request->has('format') ? implode(',', $request->format) : 'pdf,jpg,png';

        PersyaratanDokumen::create([
            'jalur_pendaftaran_id' => $request->jalur_pendaftaran_id,
            'nama' => $request->nama_dokumen,
            'slug' => Str::slug($request->nama_dokumen),
            'keterangan' => $request->keterangan,
            'format' => $format,
            'kategori' => $request->kategori,
            'urutan' => $request->integer('urutan', 0),
            'is_wajib' => $request->boolean('is_wajib'),
        ]);

        return redirect()->route('admin.dokumen-persyaratan.index')->with('success', 'Persyaratan dokumen berhasil dibuat.');
    }

    public function edit(PersyaratanDokumen $dokumen_persyaratan)
    {
        $this->authorize('dokumen.edit');

        return view('admin.dokumen.edit', ['data' => $dokumen_persyaratan]);
    }

    public function update(Request $request, PersyaratanDokumen $dokumen_persyaratan)
    {
        $this->authorize('dokumen.edit');

        $request->validate([
            'jalur_pendaftaran_id' => 'required',
            'nama_dokumen' => 'required',
        ]);

        $format = $request->has('format') ? implode(',', $request->format) : 'pdf,jpg,png';

        $dokumen_persyaratan->update([
            'jalur_pendaftaran_id' => $request->jalur_pendaftaran_id,
            'nama' => $request->nama_dokumen,
            'slug' => Str::slug($request->nama_dokumen),
            'keterangan' => $request->keterangan,
            'format' => $format,
            'kategori' => $request->kategori,
            'urutan' => $request->integer('urutan', 0),
            'is_wajib' => $request->boolean('is_wajib'),
        ]);

        return redirect()->route('admin.dokumen-persyaratan.index')->with('success', 'Persyaratan dokumen berhasil diperbarui.');
    }

    public function toggleStatus(PersyaratanDokumen $dokumen_persyaratan)
    {
        $this->authorize('dokumen.edit');

        $dokumen_persyaratan->update(['status' => !$dokumen_persyaratan->status]);

        return back()->with('success', 'Status dokumen berhasil diperbarui.');
    }

    public function destroy(PersyaratanDokumen $dokumen_persyaratan)
    {
        $this->authorize('dokumen.delete');

        $dokumen_persyaratan->delete();

        return back()->with('success', 'Persyaratan dokumen berhasil dihapus.');
    }
}
