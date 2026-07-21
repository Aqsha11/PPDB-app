<?php

namespace App\Exports;

use App\Models\Pendaftaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PendaftaranExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected string $status;
    protected int $periodeId;
    protected int $rowIndex = 1;

    public function __construct(string $status = 'all', int $periodeId = 0)
    {
        $this->status = $status;
        $this->periodeId = $periodeId;
    }

    public function collection()
    {
        $query = Pendaftaran::with(['peserta', 'jalurPendaftaran', 'periodePpdb.tahunAjaran']);

        if ($this->status !== 'all') {
            $query->where('status_pendaftaran', $this->status);
        }

        if ($this->periodeId > 0) {
            $query->where('periode_ppdb_id', $this->periodeId);
        }

        return $query->latest()->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nomor Pendaftaran',
            'Nama Lengkap',
            'NISN',
            'NIK',
            'Jenis Kelamin',
            'Jalur Pendaftaran',
            'Tahun Ajaran',
            'Status',
            'Tanggal Daftar',
            'Tanggal Submit',
        ];
    }

    public function map($pendaftaran): array
    {
        return [
            $this->rowIndex++,
            $pendaftaran->nomor_pendaftaran,
            $pendaftaran->peserta->nama_lengkap ?? '-',
            $pendaftaran->peserta->nisn ?? '-',
            $pendaftaran->peserta->nik ?? '-',
            $pendaftaran->peserta->jenis_kelamin ?? '-',
            $pendaftaran->jalurPendaftaran?->nama ?? '-',
            $pendaftaran->periodePpdb?->tahunAjaran?->nama ?? '-',
            ucfirst($pendaftaran->status_pendaftaran),
            $pendaftaran->created_at?->format('d/m/Y H:i') ?? '-',
            $pendaftaran->tanggal_submit?->format('d/m/Y H:i') ?? '-',
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
