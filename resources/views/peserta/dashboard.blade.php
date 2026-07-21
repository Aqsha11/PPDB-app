@extends('layouts.peserta')

@section('header', 'Dashboard')

@section('content')
    @php
        $steps = [
            ['label' => 'Biodata & Foto', 'route' => 'peserta.biodata.edit', 'done' => $peserta && $peserta->nama_lengkap && $peserta->pas_foto],
            ['label' => 'Orang Tua', 'route' => 'peserta.orang-tua.edit', 'done' => $peserta && $peserta->orangTua?->nama_ayah],
            ['label' => 'Sekolah Asal', 'route' => 'peserta.sekolah-asal.edit', 'done' => $peserta && $peserta->sekolahAsal?->nama_sekolah],
            ['label' => 'Pilih Jalur', 'route' => 'peserta.jalur.index', 'done' => $pendaftaran && $pendaftaran->jalur_pendaftaran_id],
            ['label' => 'Upload Dokumen', 'route' => 'peserta.dokumen.index', 'done' => $dokumen && $dokumen->count() > 0],
            ['label' => 'Submit', 'route' => null, 'done' => $pendaftaran && $pendaftaran->status_pendaftaran !== 'draft'],
            ['label' => 'Verifikasi', 'route' => null, 'done' => $pendaftaran && in_array($pendaftaran->status_pendaftaran, ['verifikasi', 'diterima', 'ditolak'])],
            ['label' => 'Hasil Seleksi', 'route' => null, 'done' => $pendaftaran && in_array($pendaftaran->status_pendaftaran, ['diterima', 'ditolak'])],
            ['label' => 'Daftar Ulang', 'route' => $pendaftaran?->status_pendaftaran === 'diterima' ? 'peserta.daftar-ulang.index' : null, 'done' => $pendaftaran && $pendaftaran->daftarUlang?->status === 'sudah'],
        ];

        $stepRoutes = [
            1 => 'peserta.biodata.edit',
            2 => 'peserta.orang-tua.edit',
            3 => 'peserta.sekolah-asal.edit',
            4 => 'peserta.jalur.index',
            5 => 'peserta.dokumen.index',
            6 => 'peserta.dokumen.index',
            7 => 'peserta.daftar-ulang.index',
        ];

        $stepLabels = [
            1 => 'Biodata Diri',
            2 => 'Data Orang Tua',
            3 => 'Sekolah Asal',
            4 => 'Pilih Jalur',
            5 => 'Upload Dokumen',
            6 => 'Submit Pendaftaran',
            7 => 'Daftar Ulang',
        ];

        $requiredCount = $pendaftaran?->jalurPendaftaran?->persyaratanDokumens?->where('is_wajib', true)?->count() ?? 0;
        $optionalCount = $pendaftaran?->jalurPendaftaran?->persyaratanDokumens?->where('is_wajib', false)?->count() ?? 0;
        $totalPersyaratan = $requiredCount + $optionalCount;
        $uploadedCount = $dokumen ? $dokumen->count() : 0;
        $uploadedWajibCount = $dokumen ? $dokumen->filter(fn($d) => $d->persyaratanDokumen?->is_wajib)->count() : 0;
        $allWajibDone = $requiredCount > 0 && $uploadedWajibCount >= $requiredCount;
        $dokumenStatus = $totalPersyaratan > 0
            ? ($allWajibDone ? 'Lengkap' : $uploadedWajibCount . '/' . $requiredCount . ' wajib')
            : '-';
    @endphp

    @if(!$registrationComplete)
        <div class="rounded-2xl p-5 sm:p-8 text-white relative overflow-hidden animate-fade-in theme-bg">
            <div class="absolute top-0 right-0 w-40 h-40 bg-white/10 rounded-full -translate-y-20 translate-x-20 blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-32 h-32 bg-white/5 rounded-full translate-y-16 -translate-x-16 blur-2xl"></div>
            <div class="relative flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="min-w-0">
                    <h2 class="text-lg sm:text-2xl font-extrabold truncate">Halo, {{ $peserta?->nama_lengkap ?? auth()->user()->name }}!</h2>
                    <p class="mt-1.5 text-xs sm:text-sm text-white/75">Selamat datang di PPDB Online. Lengkapi tahapan pendaftaran Anda untuk melanjutkan.</p>
                </div>
                <div class="text-right shrink-0">
                    <p class="text-[10px] font-bold text-white/60 uppercase tracking-wider">Tahap saat ini</p>
                    <p class="text-2xl sm:text-3xl font-extrabold mt-0.5">{{ min($currentStep, 9) }}/9</p>
                </div>
            </div>

            @if($currentStep <= 9)
                <div class="relative mt-5 flex flex-col sm:flex-row items-start sm:items-center gap-3">
                    <a href="{{ route($stepRoutes[$currentStep] ?? 'peserta.dashboard') }}"
                       class="inline-flex items-center gap-2 px-5 py-2.5 bg-white text-sm font-bold rounded-xl hover:bg-white/90 transition-all duration-200 shadow-lg hover:shadow-xl hover:-translate-y-0.5" style="color: var(--color-primary)">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                        Lanjutkan: {{ $stepLabels[$currentStep] ?? 'Selesai' }}
                    </a>
                    <span class="text-xs font-medium text-white/60">Langkah {{ min($currentStep, 9) }} dari 9</span>
                </div>
            @endif
        </div>

        <div class="animate-fade-in" style="animation-delay: 0.1s">
            <x-card title="Progress Pendaftaran">
                <x-peserta.progress-stepper :steps="$steps" :current-step="$currentStep" />
            </x-card>
        </div>

        <div class="animate-fade-in" style="animation-delay: 0.2s">
            <x-card>
                <div class="text-center py-8">
                    <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto theme-bg-light">
                        <svg class="w-8 h-8 theme-text" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="mt-4 text-lg font-bold text-gray-900 dark:text-white">{{ $stepLabels[$currentStep] ?? 'Pendaftaran Selesai' }}</h3>
                    <p class="mt-1.5 text-sm text-gray-500 dark:text-slate-400 max-w-sm mx-auto">
                        @if($currentStep == 1)
                            Silakan isi biodata diri Anda untuk memulai pendaftaran.
                        @elseif($currentStep == 2)
                            Lengkapi data orang tua/wali Anda.
                        @elseif($currentStep == 3)
                            Masukkan data sekolah asal Anda.
                        @elseif($currentStep == 4)
                            Pilih jalur pendaftaran yang sesuai.
                        @elseif($currentStep == 5)
                            Upload dokumen yang diperlukan.
                        @elseif($currentStep == 6)
                            Periksa data Anda dan submit pendaftaran.
                        @elseif($currentStep == 7)
                            Unggah dokumen daftar ulang yang diperlukan.
                        @endif
                    </p>
                    @if($currentStep <= 9)
                        <a href="{{ route($stepRoutes[$currentStep] ?? 'peserta.dashboard') }}"
                           class="mt-6 inline-flex items-center gap-2 px-6 py-2.5 btn-theme text-sm font-bold rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                            Mulai Sekarang
                        </a>
                    @endif
                </div>
            </x-card>
        </div>
    @else
        <div class="rounded-2xl p-5 sm:p-8 text-white relative overflow-hidden animate-fade-in" style="background: linear-gradient(135deg, #059669, #047857)">
            <div class="absolute top-0 right-0 w-40 h-40 bg-white/10 rounded-full -translate-y-20 translate-x-20 blur-3xl"></div>
            <div class="relative flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="min-w-0">
                    <h2 class="text-lg sm:text-2xl font-extrabold truncate">Halo, {{ $peserta?->nama_lengkap ?? auth()->user()->name }}!</h2>
                    <p class="mt-1.5 text-xs sm:text-sm text-emerald-100">Pendaftaran Anda telah selesai. Pantau status pendaftaran Anda di sini.</p>
                </div>
                <div class="shrink-0">
                    <div class="w-12 h-12 sm:w-14 sm:h-14 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                        <svg class="w-6 h-6 sm:w-7 sm:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 animate-fade-in" style="animation-delay: 0.1s">
            <x-peserta.stat-card label="No. Pendaftaran" :value="$pendaftaran->nomor_pendaftaran ?? '-'" color="blue"
                icon='<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>' />

            <x-peserta.stat-card label="Jalur" :value="$pendaftaran->jalurPendaftaran?->nama ?? '-'" color="purple"
                icon='<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>' />

            <x-card class="p-0" style="animation-delay: 0.15s">
                <div class="p-5">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0 bg-amber-50 dark:bg-amber-500/10">
                            <svg class="w-5 h-5 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <p class="text-[10px] font-bold text-gray-400 dark:text-slate-500 uppercase tracking-widest">Status</p>
                            <div class="mt-1">
                                <x-peserta.status-badge :status="$pendaftaran->status_pendaftaran" />
                            </div>
                        </div>
                    </div>
                </div>
            </x-card>

            <x-peserta.stat-card label="Tanggal Daftar" :value="$pendaftaran->created_at ? $pendaftaran->created_at->format('d/m/Y') : '-'" color="indigo"
                icon='<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>' />
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 animate-fade-in" style="animation-delay: 0.2s">
            <x-peserta.stat-card label="Status" value="{{ ucfirst($pendaftaran->status_pendaftaran) }}" color="{{ $pendaftaran->status_pendaftaran === 'diterima' ? 'green' : 'blue' }}"
                icon='<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>' />

            <x-peserta.stat-card label="Dokumen" :value="$dokumenStatus" color="{{ $allWajibDone ? 'green' : 'yellow' }}"
                icon='<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>' />

            <x-peserta.stat-card label="Tahapan" value="{{ min($currentStep, 9) }}/9" color="indigo"
                icon='<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>' />
        </div>

        <div class="animate-fade-in" style="animation-delay: 0.3s">
            <x-card title="Progress Pendaftaran">
                <x-peserta.progress-stepper :steps="$steps" :current-step="$currentStep" />
            </x-card>
        </div>

        <div class="animate-fade-in" style="animation-delay: 0.35s">
            <x-peserta.quick-action-card title="Aksi Cepat">
                <a href="{{ route('peserta.pendaftaran.index') }}"
                   class="flex flex-col items-center justify-center gap-2 p-4 rounded-xl hover:opacity-80 transition-all duration-200 group theme-bg-light">
                    <svg class="w-6 h-6 theme-text group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                    </svg>
                    <span class="text-xs font-bold theme-text text-center">Cetak Bukti Pendaftaran</span>
                </a>

                <a href="{{ route('peserta.pengumuman.index') }}"
                   class="flex flex-col items-center justify-center gap-2 p-4 bg-emerald-50 dark:bg-emerald-500/10 rounded-xl hover:opacity-80 transition-all duration-200 group">
                    <svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span class="text-xs font-bold text-emerald-700 dark:text-emerald-400 text-center">Lihat Pengumuman</span>
                </a>

                @if($pendaftaran->status_pendaftaran === 'diterima')
                    <a href="{{ route('peserta.daftar-ulang.index') }}"
                       class="flex flex-col items-center justify-center gap-2 p-4 theme-second-bg-light rounded-xl hover:opacity-80 transition-all duration-200 group">
                        <svg class="w-6 h-6 theme-second-text group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                        <span class="text-xs font-bold theme-second-text text-center">Daftar Ulang</span>
                    </a>
                @endif

                <a href="{{ route('peserta.profil.index') }}"
                   class="flex flex-col items-center justify-center gap-2 p-4 bg-amber-50 dark:bg-amber-500/10 rounded-xl hover:opacity-80 transition-all duration-200 group">
                    <svg class="w-6 h-6 text-amber-600 dark:text-amber-400 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <span class="text-xs font-bold text-amber-700 dark:text-amber-400 text-center">Profil Saya</span>
                </a>
            </x-peserta.quick-action-card>
        </div>
    @endif
@endsection
