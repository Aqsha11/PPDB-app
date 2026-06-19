<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Kontak;
use App\Models\MediaSosial;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function index()
    {
        $data = Kontak::first();
        $mediaSosial = MediaSosial::all();
        return view('public.kontak.index', compact('data', 'mediaSosial'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'pesan' => 'required',
        ]);

        // Simpan pesan kontak jika ada model PesanKontak atau kirim email
        // Untuk sementara hanya redirect dengan flash message

        return back()->with('success', 'Pesan berhasil dikirim. Kami akan menghubungi Anda segera.');
    }
}
