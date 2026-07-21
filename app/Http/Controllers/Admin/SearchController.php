<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Pendaftaran;
use App\Models\Pengumuman;
use App\Models\Peserta;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $query = $request->input('q', '');

        if (strlen($query) < 2) {
            return response()->json(['results' => []]);
        }

        $results = collect();

        Peserta::where('nama_lengkap', 'like', "%{$query}%")
            ->orWhere('nisn', 'like', "%{$query}%")
            ->limit(5)
            ->get()
            ->each(fn($p) => $results->push([
                'title' => $p->nama_lengkap,
                'subtitle' => 'NISN: ' . $p->nisn,
                'url' => route('admin.biodata.show', $p),
                'icon' => 'user',
            ]));

        Pendaftaran::where('nomor_pendaftaran', 'like', "%{$query}%")
            ->orWhere('status_pendaftaran', 'like', "%{$query}%")
            ->with('peserta')
            ->limit(5)
            ->get()
            ->each(fn($p) => $results->push([
                'title' => $p->nomor_pendaftaran ?? 'Tanpa Nomor',
                'subtitle' => ($p->peserta->nama_lengkap ?? '-') . ' — ' . ucfirst($p->status_pendaftaran),
                'url' => route('admin.pendaftaran.show', $p),
                'icon' => 'document',
            ]));

        User::where('name', 'like', "%{$query}%")
            ->orWhere('email', 'like', "%{$query}%")
            ->limit(5)
            ->get()
            ->each(fn($u) => $results->push([
                'title' => $u->name,
                'subtitle' => $u->email,
                'url' => route('admin.user.show', $u),
                'icon' => 'user',
            ]));

        Berita::where('judul', 'like', "%{$query}%")
            ->limit(3)
            ->get()
            ->each(fn($b) => $results->push([
                'title' => $b->judul,
                'subtitle' => 'Berita',
                'url' => route('admin.berita.show', $b),
                'icon' => 'document',
            ]));

        Pengumuman::where('judul', 'like', "%{$query}%")
            ->limit(3)
            ->get()
            ->each(fn($p) => $results->push([
                'title' => $p->judul,
                'subtitle' => 'Pengumuman',
                'url' => route('admin.pengumuman.show', $p),
                'icon' => 'megaphone',
            ]));

        Galeri::where('judul', 'like', "%{$query}%")
            ->limit(3)
            ->get()
            ->each(fn($g) => $results->push([
                'title' => $g->judul,
                'subtitle' => 'Galeri',
                'url' => route('admin.galeri.show', $g),
                'icon' => 'image',
            ]));

        return response()->json(['results' => $results->take(15)->values()]);
    }
}
