<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index()
    {
        $this->authorize('cms.manage');

        $data = Berita::latest()->get();

        return view('admin.berita.index', compact('data'));
    }

    public function create()
    {
        $this->authorize('cms.manage');

        return view('admin.berita.create');
    }

    public function show(Berita $berita)
    {
        $this->authorize('cms.manage');

        $data = $berita;

        return view('admin.berita.show', compact('data'));
    }

    public function edit(Berita $berita)
    {
        $this->authorize('cms.manage');

        $data = $berita;

        return view('admin.berita.edit', compact('data'));
    }

    public function store(Request $request)
    {
        $this->authorize('cms.manage');

        $data = $request->validate([
            'judul' => 'required',
            'konten' => 'required',
            'thumbnail' => 'nullable|image',
        ]);

        $data['slug'] = Str::slug($request->judul);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('berita', 'public');
        }

        Berita::create($data);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dibuat.');
    }

    public function update(Request $request, Berita $berita)
    {
        $this->authorize('cms.manage');

        $data = $request->validate([
            'judul' => 'required',
            'konten' => 'required',
            'thumbnail' => 'nullable|image',
        ]);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('berita', 'public');
        }

        $berita->update($data);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function toggleStatus(Berita $berita)
    {
        $this->authorize('cms.manage');

        $berita->update(['status' => !$berita->status]);

        return back()->with('success', 'Status berita berhasil diperbarui.');
    }

    public function destroy(Berita $berita)
    {
        $this->authorize('cms.manage');

        $berita->delete();

        return back()->with('success', 'Berita berhasil dihapus.');
    }
}
