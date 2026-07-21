<?php

namespace App\Http\Middleware;

use App\Models\PersyaratanDokumen;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureRegistrationProgress
{
    protected array $stepRoutes = [
        1 => ['peserta.biodata.edit', 'peserta.biodata.update'],
        2 => ['peserta.orang-tua.edit', 'peserta.orang-tua.update'],
        3 => ['peserta.sekolah-asal.edit', 'peserta.sekolah-asal.update'],
        4 => ['peserta.jalur.index', 'peserta.jalur.store'],
        5 => ['peserta.dokumen.index', 'peserta.dokumen.store', 'peserta.dokumen.destroy'],
        6 => ['peserta.pendaftaran.submit'],
    ];

    protected array $freeRoutes = [
        'peserta.dashboard',
        'peserta.pengumuman.index',
        'peserta.daftar-ulang.index',
        'peserta.daftar-ulang.store',
        'peserta.pendaftaran.index',
        'peserta.pendaftaran.cetak',
        'peserta.profil.index',
        'peserta.profil.update',
        'peserta.profil.password',
        'peserta.chat.index',
        'peserta.chat.send',
        'peserta.chat.mark-read',
        'peserta.chat.unread-count',
        'peserta.chat.escalate',
    ];

    public function handle(Request $request, Closure $next): Response
    {
        $routeName = $request->route()->getName();

        if (in_array($routeName, $this->freeRoutes)) {
            return $next($request);
        }

        $peserta = $request->user()->peserta;
        $pendaftaran = $peserta?->pendaftaran()->first();

        // Sudah diterima — redirect ke daftar ulang jika belum daftar ulang
        if ($pendaftaran && $pendaftaran->status_pendaftaran === 'diterima') {
            $isDaftarUlangDone = $pendaftaran->daftarUlang && $pendaftaran->daftarUlang->status === 'sudah';
            if (!$isDaftarUlangDone && !in_array($routeName, ['peserta.daftar-ulang.index', 'peserta.daftar-ulang.store'])) {
                return redirect()->route('peserta.daftar-ulang.index');
            }
            return $next($request);
        }

        // Sudah submit (verifikasi/ditolak/cadangan) — boleh akses semua halaman
        if ($pendaftaran && $pendaftaran->status_pendaftaran !== 'draft') {
            return $next($request);
        }

        // Status draft — boleh akses SEMUA step routes (edit bebas)
        $allStepRoutes = collect($this->stepRoutes)->flatten()->values()->all();
        if (in_array($routeName, $allStepRoutes)) {
            // Khusus submit — cek dokumen wajib
            if ($routeName === 'peserta.pendaftaran.submit') {
                if (!$this->areRequiredDocumentsUploaded($pendaftaran)) {
                    return redirect()->route('peserta.dokumen.index')
                        ->with('error', 'Unggah semua dokumen wajib terlebih dahulu sebelum mengirimkan pendaftaran.');
                }
            }

            return $next($request);
        }

        $currentStep = $this->resolveCurrentStep($peserta, $pendaftaran);
        return redirect()->route($this->getStepRoute($currentStep));
    }

    public function resolveCurrentStep($peserta, $pendaftaran): int
    {
        if (!$peserta || !$peserta->nama_lengkap || !$peserta->pas_foto) return 1;
        if (!$peserta->orangTua?->nama_ayah) return 2;
        if (!$peserta->sekolahAsal?->nama_sekolah) return 3;
        if (!$pendaftaran || !$pendaftaran->jalur_pendaftaran_id) return 4;
        if (!$this->areRequiredDocumentsUploaded($pendaftaran)) return 5;
        if ($pendaftaran->status_pendaftaran === 'draft') return 6;

        return 7;
    }

    protected function areRequiredDocumentsUploaded($pendaftaran): bool
    {
        if (!$pendaftaran || !$pendaftaran->jalur_pendaftaran_id) {
            return false;
        }

        $requiredCount = PersyaratanDokumen::where('jalur_pendaftaran_id', $pendaftaran->jalur_pendaftaran_id)
            ->where('is_wajib', true)
            ->count();

        if ($requiredCount === 0) {
            return true;
        }

        $uploadedCount = $pendaftaran->dokumenPendaftarans()
            ->whereIn('persyaratan_dokumen_id', function ($query) use ($pendaftaran) {
                $query->select('id')
                    ->from('persyaratan_dokumens')
                    ->where('jalur_pendaftaran_id', $pendaftaran->jalur_pendaftaran_id)
                    ->where('is_wajib', true);
            })
            ->count();

        return $uploadedCount >= $requiredCount;
    }

    protected function getStepRoute(int $step): string
    {
        return match ($step) {
            1 => 'peserta.biodata.edit',
            2 => 'peserta.orang-tua.edit',
            3 => 'peserta.sekolah-asal.edit',
            4 => 'peserta.jalur.index',
            5 => 'peserta.dokumen.index',
            6 => 'peserta.dokumen.index',
            default => 'peserta.dashboard',
        };
    }
}
