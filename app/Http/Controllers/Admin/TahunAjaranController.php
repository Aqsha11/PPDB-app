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

            'nama' => 'required|unique:tahun_ajarans',

        ]);



        TahunAjaran::create([

            'nama' => $request->nama,

            'status_aktif' => $request->status_aktif ?? false

        ]);



        return redirect()
            ->route('admin.tahun-ajaran.index')
            ->with(
                'success',
                'Data berhasil dibuat'
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

            'nama' => 'required|unique:tahun_ajarans,nama,' . $tahun_ajaran->id

        ]);



        $tahun_ajaran->update([

            'nama' => $request->nama,

            'status_aktif' => $request->status_aktif

        ]);



        return redirect()
            ->route('admin.tahun-ajaran.index')
            ->with(
                'success',
                'Data berhasil diperbarui'
            );
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
