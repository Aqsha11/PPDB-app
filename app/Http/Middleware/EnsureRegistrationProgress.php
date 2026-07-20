<?php

namespace App\Http\Middleware;

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
    ];

    public function handle(Request $request, Closure $next): Response
    {
        $routeName = $request->route()->getName();

        if (in_array($routeName, $this->freeRoutes)) {
            return $next($request);
        }

        $peserta = $request->user()->peserta;
        $pendaftaran = $peserta?->pendaftaran()->first();

        if ($pendaftaran && $pendaftaran->status_pendaftaran !== 'draft') {
            return $next($request);
        }

        $currentStep = $this->resolveCurrentStep($peserta, $pendaftaran);

        $allowedRoutes = $this->stepRoutes[$currentStep] ?? [];
        $allowedRoutes[] = 'peserta.dashboard';

        if (in_array($routeName, $allowedRoutes)) {
            return $next($request);
        }

        return redirect()->route($this->getStepRoute($currentStep));
    }

    protected function resolveCurrentStep($peserta, $pendaftaran): int
    {
        if (!$peserta || !$peserta->nama_lengkap || !$peserta->pas_foto) return 1;
        if (!$peserta->orangTua?->nama_ayah) return 2;
        if (!$peserta->sekolahAsal?->nama_sekolah) return 3;
        if (!$pendaftaran || !$pendaftaran->jalur_pendaftaran_id) return 4;
        if ($pendaftaran->dokumenPendaftarans()->count() === 0) return 5;
        if ($pendaftaran->status_pendaftaran === 'draft') return 6;

        return 7;
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
