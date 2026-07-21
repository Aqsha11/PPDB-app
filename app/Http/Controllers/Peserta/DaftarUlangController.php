<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\DaftarUlang;
use App\Models\Notification;
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

        $validated = $request->validate([
            'bukti_kelulusan' => 'required|file|max:5120|mimes:pdf,jpg,jpeg,png',
            'fotokopi_kk' => 'required|file|max:5120|mimes:pdf,jpg,jpeg,png',
            'akta_kelahiran' => 'required|file|max:5120|mimes:pdf,jpg,jpeg,png',
            'ktp_orang_tua' => 'required|file|max:5120|mimes:pdf,jpg,jpeg,png',
            'skl_ijazah' => 'required|file|max:5120|mimes:pdf,jpg,jpeg,png',
        ]);

        $du = DaftarUlang::updateOrCreate(
            ['pendaftaran_id' => $pendaftaran->id],
            [
                'status' => 'sudah',
                'tanggal_daftar_ulang' => now(),
            ]
        );

        $fields = ['bukti_kelulusan', 'fotokopi_kk', 'akta_kelahiran', 'ktp_orang_tua', 'skl_ijazah'];
        foreach ($fields as $field) {
            if ($request->hasFile($field)) {
                $du->update([$field => $request->file($field)->store('daftar-ulang', 'public')]);
            }
        }

        Notification::notifyPeserta(
            $pendaftaran->peserta,
            'Daftar ulang berhasil dilakukan.',
            route('peserta.daftar-ulang.index'),
            'check-circle'
        );

        Notification::notifyAdmins(
            'Daftar ulang dari ' . $pendaftaran->peserta->nama_lengkap,
            route('admin.daftar-ulang.show', $pendaftaran->id),
            'check-circle'
        );

        return back()->with('success', 'Selamat! Anda telah melakukan daftar ulang.');
    }
}
