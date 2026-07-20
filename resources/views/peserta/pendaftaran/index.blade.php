@extends('layouts.peserta')

@section('header', 'Pendaftaran Saya')

@section('content')
    @if(!$pendaftaran)
        <div class="animate-fade-in">
            <x-card>
                <div class="text-center py-12 px-6">
                    <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto theme-bg-light">
                        <svg class="w-8 h-8 theme-text" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="mt-5 text-xl font-extrabold text-gray-900 dark:text-white">Belum Ada Pendaftaran</h3>
                    <p class="mt-2 text-sm text-gray-500 dark:text-slate-400 max-w-sm mx-auto">Anda belum melakukan pendaftaran. Silakan lengkapi biodata dan pilih jalur pendaftaran.</p>
                    <a href="{{ route('peserta.biodata.edit') }}"
                       class="mt-6 inline-flex items-center gap-2 px-6 py-2.5 btn-theme text-sm font-bold rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Mulai Pendaftaran
                    </a>
                </div>
            </x-card>
        </div>
    @else
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="animate-fade-in">
                <x-card>
                    <div class="flex items-center gap-3 mb-5 pb-4 border-b border-gray-100 dark:border-slate-800">
                        <div class="w-11 h-11 rounded-xl theme-bg flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-gray-900 dark:text-white">Informasi Pendaftaran</h3>
                            <p class="text-xs text-gray-500 dark:text-slate-400">Detail pendaftaran Anda</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-center justify-between py-2 gap-3">
                            <span class="text-sm text-gray-500 dark:text-slate-400 shrink-0">No. Pendaftaran</span>
                            <span class="text-sm font-bold text-gray-900 dark:text-white text-right min-w-0 truncate">{{ $pendaftaran->nomor_pendaftaran ?? '-' }}</span>
                        </div>
                        <div class="border-t border-gray-100 dark:border-slate-800"></div>
                        <div class="flex items-center justify-between py-2 gap-3">
                            <span class="text-sm text-gray-500 dark:text-slate-400 shrink-0">Status</span>
                            <x-peserta.status-badge :status="$pendaftaran->status_pendaftaran" />
                        </div>
                        <div class="border-t border-gray-100 dark:border-slate-800"></div>
                        <div class="flex items-center justify-between py-2 gap-3">
                            <span class="text-sm text-gray-500 dark:text-slate-400 shrink-0">Jalur</span>
                            <span class="text-sm font-bold text-gray-900 dark:text-white text-right min-w-0 truncate">{{ $pendaftaran->jalurPendaftaran?->nama ?? '-' }}</span>
                        </div>
                        <div class="border-t border-gray-100 dark:border-slate-800"></div>
                        <div class="flex items-center justify-between py-2 gap-3">
                            <span class="text-sm text-gray-500 dark:text-slate-400 shrink-0">Periode</span>
                            <span class="text-sm font-bold text-gray-900 dark:text-white text-right min-w-0 truncate">{{ $pendaftaran->periodePpdb?->nama ?? '-' }}</span>
                        </div>
                        <div class="border-t border-gray-100 dark:border-slate-800"></div>
                        <div class="flex items-center justify-between py-2 gap-3">
                            <span class="text-sm text-gray-500 dark:text-slate-400 shrink-0">Tahun Ajaran</span>
                            <span class="text-sm font-bold text-gray-900 dark:text-white text-right min-w-0 truncate">{{ $pendaftaran->periodePpdb?->tahunAjaran?->nama ?? '-' }}</span>
                        </div>
                    </div>
                </x-card>
            </div>

            <div class="space-y-6 animate-fade-in" style="animation-delay: 0.1s">
                <x-card>
                    <div class="flex items-center gap-3 mb-5 pb-4 border-b border-gray-100 dark:border-slate-800">
                        <div class="w-11 h-11 rounded-xl bg-emerald-50 dark:bg-emerald-500/10 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-gray-900 dark:text-white">Status Pendaftaran</h3>
                            <p class="text-xs text-gray-500 dark:text-slate-400">Progress pendaftaran Anda</p>
                        </div>
                    </div>

                    <div class="text-center py-6">
                        <x-peserta.status-badge :status="$pendaftaran->status_pendaftaran" />
                        <p class="mt-3 text-sm text-gray-500 dark:text-slate-400">
                            @switch($pendaftaran->status_pendaftaran)
                                @case('draft') Pendaftaran belum dikirim. @break
                                @case('submitted') Pendaftaran telah dikirim, menunggu verifikasi. @break
                                @case('verifikasi') Pendaftaran sedang dalam proses verifikasi. @break
                                @case('diterima') Selamat! Anda diterima. @break
                                @case('cadangan') Anda masuk dalam daftar cadangan. @break
                                @case('ditolak') Pendaftaran belum dapat diterima. @break
                                @default {{ ucfirst($pendaftaran->status_pendaftaran) }}
                            @endswitch
                        </p>
                    </div>
                </x-card>

                <x-card>
                    <div class="flex items-center gap-3 mb-5 pb-4 border-b border-gray-100 dark:border-slate-800">
                        <div class="w-11 h-11 rounded-xl bg-indigo-50 dark:bg-indigo-500/10 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-gray-900 dark:text-white">Tanggal</h3>
                            <p class="text-xs text-gray-500 dark:text-slate-400">Riwayat waktu pendaftaran</p>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <div class="flex items-center gap-3">
                            <div class="w-2 h-2 rounded-full theme-bg shrink-0"></div>
                            <div class="flex-1 flex items-center justify-between gap-3 min-w-0">
                                <span class="text-sm text-gray-600 dark:text-slate-400 shrink-0">Tanggal Daftar</span>
                                <span class="text-sm font-medium text-gray-900 dark:text-white text-right min-w-0 truncate">{{ $pendaftaran->created_at ? $pendaftaran->created_at->format('d/m/Y H:i') : '-' }}</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-2 h-2 rounded-full bg-gray-300 dark:bg-slate-600 shrink-0"></div>
                            <div class="flex-1 flex items-center justify-between gap-3 min-w-0">
                                <span class="text-sm text-gray-600 dark:text-slate-400 shrink-0">Terakhir Diperbarui</span>
                                <span class="text-sm font-medium text-gray-900 dark:text-white text-right min-w-0 truncate">{{ $pendaftaran->updated_at ? $pendaftaran->updated_at->format('d/m/Y H:i') : '-' }}</span>
                            </div>
                        </div>
                    </div>
                </x-card>
            </div>
        </div>

        @if($pendaftaran->status_pendaftaran === 'draft')
            <div class="animate-fade-in" style="animation-delay: 0.15s">
                <x-card>
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div class="flex items-start gap-4">
                            <div class="w-11 h-11 rounded-xl theme-bg-light flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 theme-text" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-bold text-gray-900 dark:text-white">Pendaftaran Masih Draft</p>
                                <p class="text-sm text-gray-500 dark:text-slate-400 mt-0.5">Lengkapi data dan kirimkan pendaftaran Anda.</p>
                            </div>
                        </div>
                        <a href="{{ route('peserta.dokumen.index') }}"
                           class="inline-flex items-center gap-2 px-5 py-2.5 btn-theme text-sm font-bold rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Lengkapi & Kirim
                        </a>
                    </div>
                </x-card>
            </div>
        @endif

        @if($pendaftaran->status_pendaftaran === 'diterima')
            <div class="animate-fade-in">
                <x-alert type="success" message="Selamat! Anda diterima. Silakan melakukan daftar ulang untuk mengkonfirmasi tempat Anda." />
            </div>
        @elseif($pendaftaran->status_pendaftaran === 'cadangan')
            <div class="animate-fade-in">
                <x-alert type="warning" message="Anda masuk dalam daftar cadangan. Kami akan menginformasikan jika ada perubahan status." />
            </div>
        @endif

        @if($pendaftaran->status_pendaftaran !== 'draft')
            <div class="animate-fade-in" style="animation-delay: 0.2s">
                <x-card>
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div class="flex items-start gap-4">
                            <div class="w-11 h-11 rounded-xl theme-bg-light flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 theme-text" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-bold text-gray-900 dark:text-white">Cetak Bukti Pendaftaran</p>
                                <p class="text-sm text-gray-500 dark:text-slate-400 mt-0.5">Unduh atau cetak bukti pendaftaran Anda.</p>
                            </div>
                        </div>
                        <a href="{{ route('peserta.pendaftaran.cetak') }}" target="_blank"
                           class="inline-flex items-center gap-2 px-5 py-2.5 btn-theme text-sm font-bold rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                            </svg>
                            Cetak Bukti
                        </a>
                    </div>
                </x-card>
            </div>
        @endif
    @endif
@endsection
