<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\ProfilSekolah;
use App\Models\MediaSosial;
use App\Models\PesanKontak;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function index()
    {
        $profil = ProfilSekolah::first();
        $mediaSosial = MediaSosial::where('status', true)->orderBy('urutan')->get();
        return view('public.kontak.index', compact('profil', 'mediaSosial'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'telepon' => 'nullable',
            'pesan' => 'required',
        ]);

        PesanKontak::create($validated);

        return back()->with('success', 'Pesan berhasil dikirim. Kami akan menghubungi Anda segera.');
    }
}
