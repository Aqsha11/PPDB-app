<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\SekolahAsal;
use Illuminate\Http\Request;

class SekolahAsalController extends Controller
{
    public function edit()
    {
        $peserta = auth()->user()->peserta;
        $sekolah = $peserta?->sekolahAsal ?? new SekolahAsal();
        return view('peserta.sekolah-asal.edit', compact('sekolah'));
    }

    public function update(Request $request)
    {
        $peserta = auth()->user()->peserta;
        abort_if(!$peserta, 403, 'Lengkapi biodata terlebih dahulu.');

        $data = $request->validate([
            'nama_sekolah' => 'required',
            'npsn' => 'nullable',
            'alamat' => 'nullable',
            'tahun_lulus' => 'nullable|digits:4|integer',
        ]);

        SekolahAsal::updateOrCreate(
            ['peserta_id' => $peserta->id],
            $data
        );

        return back()->with('success', 'Data sekolah asal berhasil disimpan.');
    }
}
