<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

use App\Models\TahunAjaran;

use Illuminate\Http\Request;



class TahunAjaranController extends Controller
{


    public function index()
    {

        $this->authorize('tahun-ajaran.view');


        $data = TahunAjaran::latest()->get();


        return view(
            'admin.tahun-ajaran.index',
            compact('data')
        );
    }




    public function create()
    {

        $this->authorize('tahun-ajaran.create');


        return view(
            'admin.tahun-ajaran.create'
        );
    }





    public function store(Request $request)
    {


        $this->authorize('tahun-ajaran.create');



        $request->validate([
            'tahun_awal' => 'required|digits:4',
            'tahun_akhir' => 'required|digits:4',
        ], [
            'tahun_awal.required' => 'Tahun awal wajib diisi.',
            'tahun_awal.digits' => 'Tahun awal harus 4 digit.',
            'tahun_akhir.required' => 'Tahun akhir wajib diisi.',
            'tahun_akhir.digits' => 'Tahun akhir harus 4 digit.',
        ]);

        $nama = $request->tahun_awal . '/' . $request->tahun_akhir;

        if (TahunAjaran::where('nama', $nama)->exists()) {
            return back()->withInput()->withErrors(['tahun_awal' => 'Tahun ajaran "' . $nama . '" sudah ada.']);
        }

        TahunAjaran::create([
            'nama' => $nama,
            'status_aktif' => $request->boolean('is_aktif')
        ]);



        return redirect()
            ->route('admin.tahun-ajaran.index')
            ->with(
                'success',
                'Data berhasil dibuat'
            );
    }






    public function show(TahunAjaran $tahun_ajaran)
    {


        $this->authorize('tahun-ajaran.view');


        $data = $tahun_ajaran;


        return view(
            'admin.tahun-ajaran.show',
            compact('data')
        );
    }




    public function edit(TahunAjaran $tahun_ajaran)
    {


        $this->authorize('tahun-ajaran.edit');


        return view(
            'admin.tahun-ajaran.edit',
            [
                'data' => $tahun_ajaran
            ]
        );
    }







    public function update(Request $request, TahunAjaran $tahun_ajaran)
    {


        $this->authorize('tahun-ajaran.edit');



        $request->validate([
            'tahun_awal' => 'required|digits:4',
            'tahun_akhir' => 'required|digits:4',
        ], [
            'tahun_awal.required' => 'Tahun awal wajib diisi.',
            'tahun_awal.digits' => 'Tahun awal harus 4 digit.',
            'tahun_akhir.required' => 'Tahun akhir wajib diisi.',
            'tahun_akhir.digits' => 'Tahun akhir harus 4 digit.',
        ]);

        $nama = $request->tahun_awal . '/' . $request->tahun_akhir;

        if (TahunAjaran::where('nama', $nama)->where('id', '!=', $tahun_ajaran->id)->exists()) {
            return back()->withInput()->withErrors(['tahun_awal' => 'Tahun ajaran "' . $nama . '" sudah ada.']);
        }

        $tahun_ajaran->update([
            'nama' => $nama,
            'status_aktif' => $request->boolean('is_aktif')
        ]);



        return redirect()
            ->route('admin.tahun-ajaran.index')
            ->with(
                'success',
                'Data berhasil diperbarui'
            );
    }







    public function toggleStatus(TahunAjaran $tahun_ajaran)
    {
        $this->authorize('tahun-ajaran.edit');

        $tahun_ajaran->update(['status_aktif' => !$tahun_ajaran->status_aktif]);

        return back()->with('success', 'Status tahun ajaran berhasil diperbarui.');
    }

    public function destroy(TahunAjaran $tahun_ajaran)
    {


        $this->authorize('tahun-ajaran.delete');



        $tahun_ajaran->delete();



        return back()
            ->with(
                'success',
                'Data berhasil dihapus'
            );
    }
}
