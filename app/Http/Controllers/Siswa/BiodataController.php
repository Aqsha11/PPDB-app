<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;

class BiodataController extends Controller
{
    public function edit()
    {
        $siswa = auth()->user()->siswa ?? new Siswa();
        return view('siswa.biodata.edit', compact('siswa'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'nisn' => 'nullable|size:10',
            'nik' => 'nullable|size:16',
            'nama_lengkap' => 'required',
            'tempat_lahir' => 'nullable',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:L,P',
            'agama' => 'nullable',
            'alamat' => 'nullable',
            'provinsi' => 'nullable',
            'kabupaten' => 'nullable',
            'kecamatan' => 'nullable',
            'kelurahan' => 'nullable',
            'kode_pos' => 'nullable',
        ]);

        $siswa = auth()->user()->siswa;

        if ($siswa) {
            $siswa->update($data);
        } else {
            $data['user_id'] = auth()->id();
            Siswa::create($data);
        }

        return back()->with('success', 'Biodata berhasil disimpan.');
    }
}
