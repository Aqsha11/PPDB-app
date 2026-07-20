<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\Peserta;
use App\Models\HasilSeleksi;
use App\Models\DaftarUlang;
use App\Models\LogAktivitas;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Pengumuman;
use App\Models\StatistikSekolah;

class DashboardController extends Controller
{
    public function index()
    {
        abort_unless(auth()->user()->can('dashboard.view'), 403);

        $totalPeserta = Peserta::count();
        $totalPendaftar = Pendaftaran::count();

        $statusCounts = Pendaftaran::selectRaw('status_pendaftaran, COUNT(*) as total')
            ->groupBy('status_pendaftaran')
            ->pluck('total', 'status_pendaftaran')
            ->toArray();

        $draft = $statusCounts['draft'] ?? 0;
        $submitted = $statusCounts['submitted'] ?? 0;
        $verifikasi = $statusCounts['verifikasi'] ?? 0;
        $diterima = $statusCounts['diterima'] ?? 0;
        $cadangan = $statusCounts['cadangan'] ?? 0;
        $ditolak = $statusCounts['ditolak'] ?? 0;

        $diterimaCount = HasilSeleksi::where('status', 'diterima')->count();
        $daftarUlangCount = DaftarUlang::where('status', 'sudah')->count();

        $totalBerita = Berita::count();
        $totalGaleri = Galeri::count();
        $totalPengumuman = Pengumuman::count();

        $statistik = StatistikSekolah::orderBy('urutan')->get();

        $activities = LogAktivitas::latest()->take(10)->get();

        return view('admin.dashboard', compact(
            'totalPeserta',
            'totalPendaftar',
            'draft',
            'submitted',
            'verifikasi',
            'diterima',
            'diterimaCount',
            'cadangan',
            'ditolak',
            'daftarUlangCount',
            'totalBerita',
            'totalGaleri',
            'totalPengumuman',
            'statistik',
            'activities',
        ));
    }
}
