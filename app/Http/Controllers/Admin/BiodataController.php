<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;

class BiodataController extends Controller
{
    public function index()
    {
        $this->authorize('siswa.view');
        $data = Siswa::with('user')->latest()->paginate(20);
        return view('admin.biodata.index', compact('data'));
    }

    public function show(Siswa $siswa)
    {
        $this->authorize('siswa.view');
        $siswa->load(['user', 'orangTua', 'sekolahAsal', 'pendaftaran.jalurPendaftaran']);
        return view('admin.biodata.show', compact('siswa'));
    }

    public function edit(Siswa $siswa)
    {
        $this->authorize('siswa.edit');
        return view('admin.biodata.edit', compact('siswa'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        $this->authorize('siswa.edit');
        $siswa->update($request->validate([
            'nisn' => 'nullable|size:10',
            'nik' => 'nullable|size:16',
            'nama_lengkap' => 'required',
            'tempat_lahir' => 'nullable',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:L,P',
            'agama' => 'nullable',
            'alamat' => 'nullable',
        ]));
        return back()->with('success', 'Biodata berhasil diupdate.');
    }

    public function destroy(Siswa $siswa)
    {
        $this->authorize('siswa.delete');
        $siswa->delete();
        return back()->with('success', 'Data siswa berhasil dihapus.');
    }
}
