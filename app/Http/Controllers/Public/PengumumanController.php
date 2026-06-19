<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;

class PengumumanController extends Controller
{
    public function index()
    {
        $data = Pengumuman::latest()->paginate(10);
        return view('public.pengumuman.index', compact('data'));
    }

    public function show($slug)
    {
        $data = Pengumuman::where('slug', $slug)->firstOrFail();
        return view('public.pengumuman.show', compact('data'));
    }
}
