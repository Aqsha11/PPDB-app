<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Berita;

class BeritaController extends Controller
{
    public function index()
    {
        $data = Berita::latest()->paginate(9);
        return view('public.berita.index', compact('data'));
    }

    public function show($slug)
    {
        $data = Berita::where('slug', $slug)->firstOrFail();
        $beritaLainnya = Berita::where('slug', '!=', $slug)->latest()->take(4)->get();
        return view('public.berita.show', compact('data', 'beritaLainnya'));
    }
}
