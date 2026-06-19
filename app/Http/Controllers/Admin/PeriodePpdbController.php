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







    public function edit(PeriodePpdb $periode_ppdb)
    {

        $this->authorize('periode.edit');


        return view(
            'admin.periode.edit',
            [
                'data' => $periode_ppdb
            ]
        );
    }






    public function update(Request $request, PeriodePpdb $periode_ppdb)
    {


        $this->authorize('periode.edit');



        $periode_ppdb->update(
            $request->validate([


                'nama' => 'required',

                'tanggal_mulai' => 'required',

                'tanggal_selesai' => 'required'


            ])
        );



        return redirect()
            ->route('admin.periode.index');
    }







    public function destroy(PeriodePpdb $periode_ppdb)
    {


        $this->authorize('periode.delete');


        $periode_ppdb->delete();



        return back();
    }
}
