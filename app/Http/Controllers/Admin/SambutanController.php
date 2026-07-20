<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SambutanKepalaSekolah;
use Illuminate\Http\Request;

class SambutanController extends Controller
{
    public function index()
    {
        $this->authorize('cms.manage');

        $data = SambutanKepalaSekolah::first();

        return view('admin.sambutan.index', compact('data'));
    }

    public function update(Request $request)
    {
        $this->authorize('cms.manage');

        $validated = $request->validate([
            'nama_kepala_sekolah' => 'required',
            'jabatan' => 'nullable',
            'sambutan' => 'nullable',
            'foto' => 'nullable|image',
        ]);

        $data = [
            'nama' => $validated['nama_kepala_sekolah'],
            'jabatan' => $validated['jabatan'] ?? 'Kepala Sekolah',
            'isi' => $validated['sambutan'] ?? null,
        ];

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('sambutan', 'public');
        }

        SambutanKepalaSekolah::updateOrCreate(['id' => 1], $data);

        return back()->with('success', 'Sambutan berhasil diperbarui.');
    }
}