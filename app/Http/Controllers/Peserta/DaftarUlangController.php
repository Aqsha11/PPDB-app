<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\DaftarUlang;
use Illuminate\Http\Request;

class DaftarUlangController extends Controller
{
    public function index()
    {
        $pendaftaran = auth()->user()->pendaftarans()
            ->where('status_pendaftaran', 'diterima')
            ->latest()
            ->first();

        $daftarUlang = $pendaftaran?->daftarUlang;

        return view('peserta.daftar-ulang.index', compact('pendaftaran', 'daftarUlang'));
    }

    public function store(Request $request)
    {
        $pendaftaran = auth()->user()->pendaftarans()
            ->where('status_pendaftaran', 'diterima')
            ->latest()
            ->firstOrFail();

        DaftarUlang::updateOrCreate(
            ['pendaftaran_id' => $pendaftaran->id],
            [
                'status' => 'sudah',
                'tanggal_daftar_ulang' => now(),
            ]
        );

        return back()->with('success', 'Selamat! Anda telah melakukan daftar ulang.');
    }
}
