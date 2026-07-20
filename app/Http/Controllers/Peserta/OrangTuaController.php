<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\OrangTua;
use Illuminate\Http\Request;

class OrangTuaController extends Controller
{
    public function edit()
    {
        $peserta = auth()->user()->peserta;
        $ortu = $peserta?->orangTua ?? new OrangTua();
        return view('peserta.orang-tua.edit', compact('ortu'));
    }

    public function update(Request $request)
    {
        $peserta = auth()->user()->peserta;
        abort_if(!$peserta, 403, 'Lengkapi biodata terlebih dahulu.');

        $data = $request->validate([
            'nama_ayah' => 'required',
            'nik_ayah' => 'nullable|max:20',
            'pekerjaan_ayah' => 'nullable',
            'nama_ibu' => 'required',
            'nik_ibu' => 'nullable|max:20',
            'pekerjaan_ibu' => 'nullable',
            'penghasilan' => 'nullable|numeric',
            'no_hp' => 'required|max:20',
        ]);

        OrangTua::updateOrCreate(
            ['peserta_id' => $peserta->id],
            $data
        );

        return back()->with('success', 'Data orang tua berhasil disimpan.');
    }
}
