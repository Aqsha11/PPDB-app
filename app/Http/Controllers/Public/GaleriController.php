<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Galeri;

class GaleriController extends Controller
{
    public function index()
    {
        $data = Galeri::latest()->paginate(12);
        return view('public.galeri.index', compact('data'));
    }
}
