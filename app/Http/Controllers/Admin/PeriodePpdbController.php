<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

use App\Models\PeriodePpdb;

use Illuminate\Http\Request;



class PeriodePpdbController extends Controller
{


    public function index()
    {


        $this->authorize('periode.view');


        $data = PeriodePpdb::with(
            'tahunAjaran'
        )
            ->latest()
            ->get();



        return view(
            'admin.periode.index',
            compact('data')
        );
    }





    public function create()
    {


        $this->authorize('periode.create');


        return view(
            'admin.periode.create'
        );
    }





    public function store(Request $request)
    {


        $this->authorize('periode.create');



        $data = $request->validate([


            'tahun_ajaran_id' => 'required',

            'nama' => 'required',

            'tanggal_mulai' => 'required|date',

            'tanggal_selesai' => 'required|date',


        ]);



        $data['status_aktif'] = $request->status_aktif ?? false;



        PeriodePpdb::create($data);



        return redirect()
            ->route('admin.periode.index')
            ->with(
                'success',
                'Periode berhasil dibuat'
            );
    }





    public function show(PeriodePpdb $periode)
    {


        $this->authorize('periode.view');


        $data = $periode;


        return view(
            'admin.periode.show',
            compact('data')
        );
    }




    public function edit(PeriodePpdb $periode)
    {

        $this->authorize('periode.edit');


        return view(
            'admin.periode.edit',
            [
                'data' => $periode
            ]
        );
    }





    public function update(Request $request, PeriodePpdb $periode)
    {


        $this->authorize('periode.edit');



        $data = $request->validate([
            'tahun_ajaran_id' => 'required',
            'nama' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
        ]);

        $data['tahun_ajaran_id'] = $request->tahun_ajaran_id;
        $data['status_aktif'] = $request->status_aktif ?? false;

        $periode->update($data);

        return redirect()
            ->route('admin.periode.index')
            ->with('success', 'Periode berhasil diperbarui.');
    }





    public function toggleStatus(PeriodePpdb $periode)
    {
        $this->authorize('periode.edit');

        $periode->update(['status_aktif' => !$periode->status_aktif]);

        return back()->with('success', 'Status periode berhasil diperbarui.');
    }

    public function destroy(PeriodePpdb $periode)
    {


        $this->authorize('periode.delete');


        $periode->delete();



        return back()->with('success', 'Periode berhasil dihapus.');
    }
}
