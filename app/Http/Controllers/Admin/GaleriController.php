<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

use App\Models\Galeri;

use Illuminate\Http\Request;



class GaleriController extends Controller
{


    public function index()
    {
        $this->authorize('cms.manage');

        $data = Galeri::latest()
            ->get();


        return view(
            'admin.galeri.index',
            compact('data')
        );
    }


    public function create()
    {
        $this->authorize('cms.manage');

        return view('admin.galeri.create');
    }


    public function show(Galeri $galeri)
    {
        $this->authorize('cms.manage');

        $data = $galeri;

        return view('admin.galeri.show', compact('data'));
    }


    public function store(Request $request)
    {
        $this->authorize('cms.manage');

        $data = $request->validate([

            'judul' => 'required',

            'gambar' => 'required|image',

            'kategori' => 'nullable'

        ]);



        $data['gambar']
            =
            $request->file('gambar')
            ->store(
                'galeri',
                'public'
            );



        Galeri::create($data);



        return back()->with('success', 'Galeri berhasil dibuat.');
    }


    public function edit(Galeri $galeri)
    {
        $this->authorize('cms.manage');

        $data = $galeri;

        return view('admin.galeri.edit', compact('data'));
    }


    public function update(Request $request, Galeri $galeri)
    {
        $this->authorize('cms.manage');

        $data = $request->validate([

            'judul' => 'required',

            'gambar' => 'nullable|image',

            'kategori' => 'nullable'

        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('galeri', 'public');
        }

        $galeri->update($data);

        return back()->with('success', 'Galeri berhasil diperbarui.');
    }


    public function destroy(Galeri $galeri)
    {
        $this->authorize('cms.manage');

        $galeri->delete();


        return back()->with('success', 'Galeri berhasil dihapus.');
    }
}
