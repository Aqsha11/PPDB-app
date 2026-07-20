<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

use App\Models\KeunggulanSekolah;

use Illuminate\Http\Request;



class KeunggulanController extends Controller
{


    public function index()
    {
        $this->authorize('cms.manage');


        $data = KeunggulanSekolah::all();


        return view(
            'admin.keunggulan.index',
            compact('data')
        );
    }


    public function create()
    {
        $this->authorize('cms.manage');

        return view('admin.keunggulan.create');
    }


    public function show(KeunggulanSekolah $keunggulan)
    {
        $this->authorize('cms.manage');

        $data = $keunggulan;

        return view('admin.keunggulan.show', compact('data'));
    }


    public function store(Request $request)
    {
        $this->authorize('cms.manage');

        $data = $request->validate([

            'judul' => 'required',

            'deskripsi' => 'nullable',

            'icon' => 'nullable',

            'gambar' => 'nullable|image'

        ]);



        if ($request->gambar) {

            $data['gambar']
                =
                $request->file('gambar')
                ->store('keunggulan', 'public');
        }



        KeunggulanSekolah::create($data);



        return back()->with('success', 'Keunggulan berhasil dibuat.');
    }


    public function edit(KeunggulanSekolah $keunggulan)
    {
        $this->authorize('cms.manage');

        $data = $keunggulan;

        return view('admin.keunggulan.edit', compact('data'));
    }


    public function update(Request $request, KeunggulanSekolah $keunggulan)
    {
        $this->authorize('cms.manage');

        $data = $request->validate([

            'judul' => 'required',

            'deskripsi' => 'nullable',

            'icon' => 'nullable',

            'gambar' => 'nullable|image'

        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('keunggulan', 'public');
        }

        $keunggulan->update($data);

        return back()->with('success', 'Keunggulan berhasil diperbarui.');
    }


    public function destroy(KeunggulanSekolah $keunggulan)
    {
        $this->authorize('cms.manage');

        $keunggulan->delete();


        return back()->with('success', 'Keunggulan berhasil dihapus.');
    }
}
