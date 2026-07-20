<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class TestimoniController extends Controller
{
    public function index()
    {
        $this->authorize('cms.manage');

        $data = Testimoni::all();

        return view('admin.testimoni.index', compact('data'));
    }

    public function create()
    {
        $this->authorize('cms.manage');

        return view('admin.testimoni.create');
    }

    public function show(Testimoni $testimoni)
    {
        $this->authorize('cms.manage');

        $data = $testimoni;

        return view('admin.testimoni.show', compact('data'));
    }

    public function store(Request $request)
    {
        $this->authorize('cms.manage');

        $data = $request->validate([
            'nama' => 'required',
            'isi' => 'required',
            'foto' => 'nullable|image',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('testimoni', 'public');
        }

        Testimoni::create($data);

        return redirect()->route('admin.testimoni.index')->with('success', 'Testimoni berhasil dibuat.');
    }

    public function edit(Testimoni $testimoni)
    {
        $this->authorize('cms.manage');

        $data = $testimoni;

        return view('admin.testimoni.edit', compact('data'));
    }

    public function update(Request $request, Testimoni $testimoni)
    {
        $this->authorize('cms.manage');

        $data = $request->validate([
            'nama' => 'required',
            'isi' => 'required',
            'foto' => 'nullable|image',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('testimoni', 'public');
        }

        $testimoni->update($data);

        return redirect()->route('admin.testimoni.index')->with('success', 'Testimoni berhasil diperbarui.');
    }

    public function toggleStatus(Testimoni $testimoni)
    {
        $this->authorize('cms.manage');

        $testimoni->update(['status' => !$testimoni->status]);

        return back()->with('success', 'Status testimoni berhasil diperbarui.');
    }

    public function destroy(Testimoni $testimoni)
    {
        $this->authorize('cms.manage');

        $testimoni->delete();

        return back()->with('success', 'Testimoni berhasil dihapus.');
    }
}
