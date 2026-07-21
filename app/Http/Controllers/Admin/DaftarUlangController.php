<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DaftarUlang;
use App\Models\Notification;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class DaftarUlangController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('seleksi.view');

        $query = Pendaftaran::with(['peserta.user', 'jalurPendaftaran', 'daftarUlang'])
            ->where('status_pendaftaran', 'diterima');

        $search = $request->input('search');
        if ($search) {
            $query->whereHas('peserta', function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                    ->orWhere('nisn', 'like', "%{$search}%");
            });
        }

        $statusFilter = $request->input('status');
        if ($statusFilter === 'sudah') {
            $query->whereHas('daftarUlang', fn($q) => $q->where('status', 'sudah'));
        } elseif ($statusFilter === 'belum') {
            $query->whereDoesntHave('daftarUlang')
                ->orWhereHas('daftarUlang', fn($q) => $q->where('status', '!=', 'sudah'));
        }

        $data = $query->latest()->paginate(20)->withQueryString();

        $counts = [
            'semua' => Pendaftaran::where('status_pendaftaran', 'diterima')->count(),
            'sudah' => DaftarUlang::where('status', 'sudah')
                ->whereHas('pendaftaran', fn($q) => $q->where('status_pendaftaran', 'diterima'))
                ->count(),
            'belum' => Pendaftaran::where('status_pendaftaran', 'diterima')
                ->whereDoesntHave('daftarUlang')
                ->count(),
        ];

        return view('admin.daftar-ulang.index', compact('data', 'counts'));
    }

    public function show(Pendaftaran $daftarUlang)
    {
        $this->authorize('seleksi.view');

        $daftarUlang->load([
            'peserta.user',
            'peserta.orangTua',
            'peserta.sekolahAsal',
            'jalurPendaftaran',
            'daftarUlang',
        ]);

        return view('admin.daftar-ulang.show', compact('daftarUlang'));
    }

    public function update(Request $request, Pendaftaran $pendaftaran)
    {
        $this->authorize('seleksi.edit');

        $data = $request->validate([
            'status' => 'required|in:sudah,belum',
            'catatan' => 'nullable|string|max:500',
        ]);

        DaftarUlang::updateOrCreate(
            ['pendaftaran_id' => $pendaftaran->id],
            [
                'status' => $data['status'],
                'tanggal_daftar_ulang' => now(),
                'catatan' => $data['catatan'] ?? null,
            ]
        );

        if ($pendaftaran->peserta) {
            $label = $data['status'] == 'sudah' ? 'Sudah daftar ulang' : 'Belum daftar ulang';
            Notification::notifyPeserta(
                $pendaftaran->peserta,
                'Daftar ulang: ' . $label,
                route('peserta.daftar-ulang.index'),
                $data['status'] == 'sudah' ? 'check-circle' : 'clock'
            );
        }

        return back()->with('success', 'Status daftar ulang berhasil diperbarui.');
    }

    public function destroy(Pendaftaran $pendaftaran)
    {
        $this->authorize('seleksi.delete');

        DaftarUlang::where('pendaftaran_id', $pendaftaran->id)->delete();

        return back()->with('success', 'Data daftar ulang berhasil dihapus.');
    }
}
