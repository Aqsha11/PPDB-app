<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peserta;
use Illuminate\Http\Request;

class BiodataController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('peserta.view');
        $query = Peserta::with('user');

        $search = $request->input('search');
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                    ->orWhere('nisn', 'like', "%{$search}%")
                    ->orWhere('no_hp', 'like', "%{$search}%")
                    ->orWhereHas('user', fn($u) => $u->where('email', 'like', "%{$search}%"));
            });
        }

        $data = $query->latest()->paginate(20)->withQueryString();
        return view('admin.biodata.index', compact('data'));
    }

    public function show(Peserta $peserta)
    {
        $this->authorize('peserta.view');
        $peserta->load(['user', 'orangTua', 'sekolahAsal', 'pendaftaran.jalurPendaftaran']);
        return view('admin.biodata.show', compact('peserta'));
    }

    public function edit(Peserta $peserta)
    {
        $this->authorize('peserta.edit');
        return view('admin.biodata.edit', compact('peserta'));
    }

    public function update(Request $request, Peserta $peserta)
    {
        $this->authorize('peserta.edit');
        $peserta->update($request->validate([
            'nisn' => 'nullable|size:10',
            'nik' => 'nullable|size:16',
            'nama_lengkap' => 'required',
            'tempat_lahir' => 'nullable',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:L,P',
            'agama' => 'nullable',
            'no_hp' => 'nullable',
            'alamat' => 'nullable',
        ]));
        return back()->with('success', 'Biodata berhasil diupdate.');
    }

    public function destroy(Peserta $peserta)
    {
        $this->authorize('peserta.delete');
        $peserta->delete();
        return back()->with('success', 'Data peserta berhasil dihapus.');
    }
}
