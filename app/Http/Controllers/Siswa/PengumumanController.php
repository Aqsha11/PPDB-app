<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;

class PengumumanController extends Controller
{
    public function index()
    {
        $data = Pengumuman::latest()->get();
        return view('siswa.pengumuman.index', compact('data'));
    }
}
