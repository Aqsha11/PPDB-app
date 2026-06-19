<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalPpdb;
use Illuminate\Http\Request;


class JadwalController extends Controller
{


    public function index()
    {

        $this->authorize('cms.manage');


        $data = JadwalPpdb::orderBy('urutan')
            ->get();


        return view(
            'admin.jadwal.index',
            compact('data')
        );
    }





    public function store(Request $request)
    {

        $this->authorize('cms.manage');


        JadwalPpdb::create(

            $request->validate([

                'kegiatan' => 'required',

                'tanggal_mulai' => 'required',

                'tanggal_selesai' => 'required',

                'deskripsi' => 'nullable',

                'urutan' => 'nullable'

            ])

        );


        return back();
    }




    public function update(Request $request, JadwalPpdb $jadwal)
    {


        $this->authorize('cms.manage');


        $jadwal->update(

            $request->validate([

                'kegiatan' => 'required',

                'tanggal_mulai' => 'required',

                'tanggal_selesai' => 'required',

                'deskripsi' => 'nullable'

            ])

        );



        return back();
    }





    public function destroy(JadwalPpdb $jadwal)
    {

        $this->authorize('cms.manage');


        $jadwal->delete();


        return back();
    }
}
