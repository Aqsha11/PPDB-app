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
            'nama_jalur' => 'required',
            'kuota' => 'required|integer',
            'deskripsi' => 'nullable',
        ]);

        $data['nama'] = $request->nama_jalur;
        $data['slug'] = Str::slug($request->nama_jalur);
        $data['status'] = $request->boolean('is_aktif');

        JalurPendaftaran::create($data);

        return redirect()
            ->route('admin.jalur.index')
            ->with('success', 'Jalur pendaftaran berhasil dibuat.');
    }







    public function show(JalurPendaftaran $jalur)
    {

        $this->authorize('jalur.view');


        return view(
            'admin.jalur.show',
            ['data' => $jalur]
        );
    }




    public function edit(JalurPendaftaran $jalur)
    {
        $this->authorize('jalur.edit');

        return view('admin.jalur.edit', ['data' => $jalur]);
    }

    public function update(Request $request, JalurPendaftaran $jalur)
    {
        $this->authorize('jalur.edit');

        $data = $request->validate([
            'nama_jalur' => 'required',
            'kuota' => 'required|integer',
            'deskripsi' => 'nullable',
        ]);

        $data['nama'] = $request->nama_jalur;
        $data['slug'] = Str::slug($request->nama_jalur);
        $data['status'] = $request->boolean('is_aktif');

        $jalur->update($data);

        return redirect()
            ->route('admin.jalur.index')
            ->with('success', 'Jalur pendaftaran berhasil diperbarui.');
    }

    public function toggleStatus(JalurPendaftaran $jalur)
    {
        $this->authorize('jalur.edit');

        $jalur->update(['status' => !$jalur->status]);

        return back()->with('success', 'Status jalur pendaftaran berhasil diperbarui.');
    }

    public function destroy(JalurPendaftaran $jalur)
    {
        $this->authorize('jalur.delete');

        $jalur->delete();

        return back()->with('success', 'Jalur pendaftaran berhasil dihapus.');
    }
}
