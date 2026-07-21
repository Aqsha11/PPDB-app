<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Pendaftaran;

use Illuminate\Http\Request;


class PendaftaranController extends Controller
{


    public function index(Request $request)
    {
        $this->authorize('pendaftaran.view');

        $query = Pendaftaran::with([
            'peserta.user',
            'jalurPendaftaran',
            'periodePpdb',
        ]);

        $search = $request->input('search');
        if ($search) {
            $query->whereHas('peserta', function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                    ->orWhere('nisn', 'like', "%{$search}%");
            });
        }

        $status = $request->input('status');
        if ($status && $status !== 'semua') {
            $map = [
                'menunggu' => ['submitted', 'verifikasi'],
                'diterima' => ['diterima'],
                'cadangan' => ['cadangan'],
                'ditolak' => ['ditolak'],
            ];
            $statuses = $map[$status] ?? [$status];
            $query->whereIn('status_pendaftaran', $statuses);
        }

        $data = $query->latest()->paginate(20)->withQueryString();

        $counts = [
            'semua' => Pendaftaran::count(),
            'menunggu' => Pendaftaran::whereIn('status_pendaftaran', ['submitted', 'verifikasi'])->count(),
            'diterima' => Pendaftaran::where('status_pendaftaran', 'diterima')->count(),
            'cadangan' => Pendaftaran::where('status_pendaftaran', 'cadangan')->count(),
            'ditolak' => Pendaftaran::where('status_pendaftaran', 'ditolak')->count(),
        ];

        return view('admin.pendaftaran.index', compact('data', 'counts'));
    }





    public function show(Pendaftaran $pendaftaran)
    {


        $this->authorize('pendaftaran.view');



        $pendaftaran->load([
            'peserta.user',
            'peserta.orangTua',
            'peserta.sekolahAsal',
            'jalurPendaftaran',
            'periodePpdb',
            'dokumenPendaftarans.persyaratanDokumen',
            'hasilSeleksi',
        ]);



        return view(
            'admin.pendaftaran.show',
            compact('pendaftaran')
        );
    }





    public function destroy(Pendaftaran $pendaftaran)
    {

        $this->authorize('pendaftaran.delete');


        $pendaftaran->delete();


        return back()
            ->with(
                'success',
                'Pendaftaran dihapus'
            );
    }
}
