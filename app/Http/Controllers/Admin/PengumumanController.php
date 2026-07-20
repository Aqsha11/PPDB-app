<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PengumumanController extends Controller
{
    public function index()
    {
        $this->authorize('cms.manage');

        $data = Pengumuman::latest()->get();

        return view('admin.pengumuman.index', compact('data'));
    }

    public function create()
    {
        $this->authorize('cms.manage');

        return view('admin.pengumuman.create');
    }

    public function show(Pengumuman $pengumuman)
    {
        $this->authorize('cms.manage');

        $data = $pengumuman;

        return view('admin.pengumuman.show', compact('data'));
    }

    public function store(Request $request)
    {
        $this->authorize('cms.manage');

        $data = $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'lampiran' => 'nullable',
        ]);

        $data['slug'] = Str::slug($request->judul);

        Pengumuman::create($data);

        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil dibuat.');
    }

    public function edit(Pengumuman $pengumuman)
    {
        $this->authorize('cms.manage');

        $data = $pengumuman;

        return view('admin.pengumuman.edit', compact('data'));
    }

    public function update(Request $request, Pengumuman $pengumuman)
    {
        $this->authorize('cms.manage');

        $data = $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'lampiran' => 'nullable',
        ]);

        $data['slug'] = Str::slug($request->judul);

        $pengumuman->update($data);

        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function toggleStatus(Pengumuman $pengumuman)
    {
        $this->authorize('cms.manage');

        $pengumuman->update(['status' => !$pengumuman->status]);

        return back()->with('success', 'Status pengumuman berhasil diperbarui.');
    }

    public function destroy(Pengumuman $pengumuman)
    {
        $this->authorize('cms.manage');

        $pengumuman->delete();

        return back()->with('success', 'Pengumuman berhasil dihapus.');
    }
}
