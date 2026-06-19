<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\OrangTua;
use Illuminate\Http\Request;

class OrangTuaController extends Controller
{
    public function edit()
    {
        $siswa = auth()->user()->siswa;
        $ortu = $siswa?->orangTua ?? new OrangTua();
        return view('siswa.orang-tua.edit', compact('ortu'));
    }

    public function update(Request $request)
    {
        $siswa = auth()->user()->siswa;
        abort_if(!$siswa, 403, 'Lengkapi biodata terlebih dahulu.');

        $data = $request->validate([
            'nama_ayah' => 'required',
            'pekerjaan_ayah' => 'nullable',
            'pendidikan_ayah' => 'nullable',
            'no_hp_ayah' => 'nullable',
            'nama_ibu' => 'required',
            'pekerjaan_ibu' => 'nullable',
            'pendidikan_ibu' => 'nullable',
            'no_hp_ibu' => 'nullable',
            'nama_wali' => 'nullable',
            'pekerjaan_wali' => 'nullable',
            'alamat_orang_tua' => 'nullable',
        ]);

        OrangTua::updateOrCreate(
            ['siswa_id' => $siswa->id],
            $data
        );

        return back()->with('success', 'Data orang tua berhasil disimpan.');
    }
}
