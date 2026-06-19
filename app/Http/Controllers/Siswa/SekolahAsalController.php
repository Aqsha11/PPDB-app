<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\SekolahAsal;
use Illuminate\Http\Request;

class SekolahAsalController extends Controller
{
    public function edit()
    {
        $siswa = auth()->user()->siswa;
        $sekolah = $siswa?->sekolahAsal ?? new SekolahAsal();
        return view('siswa.sekolah-asal.edit', compact('sekolah'));
    }

    public function update(Request $request)
    {
        $siswa = auth()->user()->siswa;
        abort_if(!$siswa, 403, 'Lengkapi biodata terlebih dahulu.');

        $data = $request->validate([
            'nama_sekolah' => 'required',
            'npsn' => 'nullable',
            'jurusan' => 'nullable',
            'tahun_lulus' => 'nullable|integer',
            'alamat_sekolah' => 'nullable',
        ]);

        SekolahAsal::updateOrCreate(
            ['siswa_id' => $siswa->id],
            $data
        );

        return back()->with('success', 'Data sekolah asal berhasil disimpan.');
    }
}
