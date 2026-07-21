<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilSekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilSekolahController extends Controller
{
    public function index()
    {
        $this->authorize('cms.manage');

        $data = ProfilSekolah::first();

        return view('admin.profil.index', compact('data'));
    }

    public function edit()
    {
        $this->authorize('cms.manage');

        $data = ProfilSekolah::first();

        return view('admin.profil.edit', compact('data'));
    }

    public function show()
    {
        $this->authorize('cms.manage');

        $data = ProfilSekolah::first();

        return view('admin.profil.show', compact('data'));
    }

    public function update(Request $request)
    {
        $this->authorize('cms.manage');

        $validated = $request->validate([
            'nama_sekolah' => 'required',
            'npsn' => 'nullable',
            'visi' => 'nullable',
            'misi' => 'nullable',
            'sejarah' => 'nullable',
            'deskripsi' => 'nullable|string|max:255',
            'alamat' => 'nullable',
            'kelurahan' => 'nullable',
            'kecamatan' => 'nullable',
            'kota' => 'nullable',
            'provinsi' => 'nullable',
            'kode_pos' => 'nullable',
            'telepon' => 'nullable',
            'whatsapp' => 'nullable|string|max:20',
            'google_maps' => 'nullable|string',
            'email' => 'nullable|email',
            'foto_sekolah' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'warna_primary' => 'nullable|regex:/^#[0-9A-Fa-f]{6}$/',
            'warna_second' => 'nullable|regex:/^#[0-9A-Fa-f]{6}$/',
        ]);

        if ($request->hasFile('foto_sekolah')) {
            $validated['foto_sekolah'] = $request->file('foto_sekolah')->store('profil-sekolah', 'public');
        }

        ProfilSekolah::updateOrCreate(['id' => 1], $validated);

        return redirect()->route('admin.profil.index')->with('success', 'Profil sekolah berhasil diperbarui.');
    }
}
