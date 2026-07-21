<?php

namespace App\Http\Controllers\Admin;

use App\Exports\PendaftaranExport;
use App\Http\Controllers\Controller;
use App\Models\PeriodePpdb;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('laporan.view');

        $periodes = PeriodePpdb::with('tahunAjaran')->get();
        $periodeId = $request->input('periode', 0);
        $status = $request->input('status', 'all');

        $query = Pendaftaran::with(['peserta', 'jalurPendaftaran', 'periodePpdb.tahunAjaran']);

        if ($status !== 'all') {
            $query->where('status_pendaftaran', $status);
        }

        if ($periodeId > 0) {
            $query->where('periode_ppdb_id', $periodeId);
        }

        $stats = [
            'semua' => Pendaftaran::when($periodeId > 0, fn($q) => $q->where('periode_ppdb_id', $periodeId))->count(),
            'draft' => Pendaftaran::where('status_pendaftaran', 'draft')->when($periodeId > 0, fn($q) => $q->where('periode_ppdb_id', $periodeId))->count(),
            'submitted' => Pendaftaran::where('status_pendaftaran', 'submitted')->when($periodeId > 0, fn($q) => $q->where('periode_ppdb_id', $periodeId))->count(),
            'verifikasi' => Pendaftaran::where('status_pendaftaran', 'verifikasi')->when($periodeId > 0, fn($q) => $q->where('periode_ppdb_id', $periodeId))->count(),
            'diterima' => Pendaftaran::where('status_pendaftaran', 'diterima')->when($periodeId > 0, fn($q) => $q->where('periode_ppdb_id', $periodeId))->count(),
            'cadangan' => Pendaftaran::where('status_pendaftaran', 'cadangan')->when($periodeId > 0, fn($q) => $q->where('periode_ppdb_id', $periodeId))->count(),
            'ditolak' => Pendaftaran::where('status_pendaftaran', 'ditolak')->when($periodeId > 0, fn($q) => $q->where('periode_ppdb_id', $periodeId))->count(),
        ];

        $data = $query->latest()->paginate(20)->withQueryString();

        return view('admin.laporan.index', compact('data', 'periodes', 'periodeId', 'status', 'stats'));
    }

    public function export(Request $request)
    {
        $this->authorize('laporan.export');

        $status = $request->input('status', 'all');
        $periodeId = (int) $request->input('periode', 0);

        $filename = 'laporan-pendaftaran-' . $status . '-' . now()->format('Y-m-d') . '.xlsx';

        return Excel::download(new PendaftaranExport($status, $periodeId), $filename);
    }
}
