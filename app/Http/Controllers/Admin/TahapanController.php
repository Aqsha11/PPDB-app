<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TahapanPpdb;
use Illuminate\Http\Request;

class TahapanController extends Controller
{
    public function index()
    {
        $this->authorize('cms.manage');

        $data = TahapanPpdb::all();

        return view('admin.tahapan.index', compact('data'));
    }

    public function create()
    {
        $this->authorize('cms.manage');

        return view('admin.tahapan.create');
    }

    public function show(TahapanPpdb $tahapan)
    {
        $this->authorize('cms.manage');

        $data = $tahapan;

        return view('admin.tahapan.show', compact('data'));
    }

    public function store(Request $request)
    {
        $this->authorize('cms.manage');

        TahapanPpdb::create(
            $request->validate([
                'judul' => 'required',
                'deskripsi' => 'nullable',
                'urutan' => 'required|integer',
            ])
        );

        return redirect()->route('admin.tahapan.index')->with('success', 'Tahapan PPDB berhasil dibuat.');
    }

    public function edit(TahapanPpdb $tahapan)
    {
        $this->authorize('cms.manage');

        $data = $tahapan;

        return view('admin.tahapan.edit', compact('data'));
    }

    public function update(Request $request, TahapanPpdb $tahapan)
    {
        $this->authorize('cms.manage');

        $tahapan->update(
            $request->validate([
                'judul' => 'required',
                'deskripsi' => 'nullable',
                'urutan' => 'required|integer',
            ])
        );

        return redirect()->route('admin.tahapan.index')->with('success', 'Tahapan PPDB berhasil diperbarui.');
    }

    public function destroy(TahapanPpdb $tahapan)
    {
        $this->authorize('cms.manage');

        $tahapan->delete();

        return back()->with('success', 'Tahapan PPDB berhasil dihapus.');
    }
}
