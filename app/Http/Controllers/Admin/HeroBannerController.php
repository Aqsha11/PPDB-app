<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroBanner;
use Illuminate\Http\Request;

class HeroBannerController extends Controller
{
    public function index()
    {
        $this->authorize('cms.manage');

        $data = HeroBanner::orderBy('urutan')->latest()->get();

        return view('admin.hero.index', compact('data'));
    }

    public function create()
    {
        $this->authorize('cms.manage');

        return view('admin.hero.create');
    }

    public function show(HeroBanner $hero)
    {
        $this->authorize('cms.manage');

        $data = $hero;

        return view('admin.hero.show', compact('data'));
    }

    public function edit(HeroBanner $hero)
    {
        $this->authorize('cms.manage');

        $data = $hero;

        return view('admin.hero.edit', compact('data'));
    }

    public function store(Request $request)
    {
        $this->authorize('cms.manage');

        $data = $request->validate([
            'judul' => 'required',
            'sub_judul' => 'nullable',
            'deskripsi' => 'nullable',
            'gambar' => 'nullable|image',
            'button_text' => 'nullable',
            'button_link' => 'nullable',
            'urutan' => 'nullable|integer',
            'status' => 'boolean',
        ]);

        $data['status'] = $request->boolean('status');

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('hero', 'public');
        }

        HeroBanner::create($data);

        return redirect()->route('admin.hero.index')->with('success', 'Hero banner berhasil dibuat.');
    }

    public function update(Request $request, HeroBanner $hero)
    {
        $this->authorize('cms.manage');

        $data = $request->validate([
            'judul' => 'required',
            'sub_judul' => 'nullable',
            'deskripsi' => 'nullable',
            'gambar' => 'nullable|image',
            'button_text' => 'nullable',
            'button_link' => 'nullable',
            'urutan' => 'nullable|integer',
            'status' => 'boolean',
        ]);

        $data['status'] = $request->boolean('status');

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('hero', 'public');
        }

        $hero->update($data);

        return redirect()->route('admin.hero.index')->with('success', 'Hero banner berhasil diperbarui.');
    }

    public function toggleStatus(HeroBanner $hero)
    {
        $this->authorize('cms.manage');

        $hero->update(['status' => !$hero->status]);

        return back()->with('success', 'Status hero banner berhasil diperbarui.');
    }

    public function destroy(HeroBanner $hero)
    {
        $this->authorize('cms.manage');

        $hero->delete();

        return back()->with('success', 'Hero banner berhasil dihapus.');
    }
}
