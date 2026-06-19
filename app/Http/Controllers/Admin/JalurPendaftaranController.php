<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

use App\Models\JalurPendaftaran;

use Illuminate\Http\Request;

use Illuminate\Support\Str;



class JalurPendaftaranController extends Controller
{


    public function index()
    {

        $this->authorize('jalur.view');


        $data = JalurPendaftaran::latest()->get();


        return view(
            'admin.jalur.index',
            compact('data')
        );
    }





    public function create()
    {

        $this->authorize('jalur.create');


        return view(
            'admin.jalur.create'
        );
    }





    public function store(Request $request)
    {


        $this->authorize('jalur.create');



        $data = $request->validate([


            'nama' => 'required',

            'kuota' => 'required|integer',

            'deskripsi' => 'nullable'

        ]);



        $data['slug'] = Str::slug($request->nama);


        $data['status'] = true;



        JalurPendaftaran::create($data);



        return redirect()
            ->route('admin.jalur.index');
    }







    public function destroy(JalurPendaftaran $jalur)
    {


        $this->authorize('jalur.delete');


        $jalur->delete();



        return back();
    }
}
