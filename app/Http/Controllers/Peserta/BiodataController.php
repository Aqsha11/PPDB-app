<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BiodataController extends Controller
{
    public function edit()
    {
        $peserta = auth()->user()->peserta ?? new Peserta();
        return view('peserta.biodata.edit', compact('peserta'));
    }

    public function update(Request $request)
    {
        $peserta = auth()->user()->peserta;

        $data = $request->validate([
            'nisn' => 'nullable|size:10|unique:pesertas,nisn,' . $peserta?->id,
            'nik' => 'nullable|size:16',
            'nama_lengkap' => 'required',
            'tempat_lahir' => 'nullable',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:L,P',
            'agama' => 'nullable',
            'no_hp' => 'nullable',
            'pas_foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'alamat' => 'nullable',
            'provinsi' => 'nullable',
            'kabupaten' => 'nullable',
            'kecamatan' => 'nullable',
            'kelurahan' => 'nullable',
            'kode_pos' => 'nullable',
        ]);

        if ($request->hasFile('pas_foto')) {
            if ($peserta && $peserta->pas_foto) {
                Storage::disk('public')->delete($peserta->pas_foto);
            }
            $data['pas_foto'] = $request->file('pas_foto')->store('pas-foto', 'public');
        }

        unset($data['pas_foto_temp']);

        if ($peserta) {
            $peserta->update($data);
        } else {
            $data['user_id'] = auth()->id();
            Peserta::create($data);
        }

        return back()->with('success', 'Biodata berhasil disimpan.');
    }
}
