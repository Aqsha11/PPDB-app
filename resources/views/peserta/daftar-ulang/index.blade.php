@extends('layouts.peserta')

@section('header', 'Daftar Ulang')

@section('content')
    @if(!$pendaftaran)
        <div class="animate-fade-in">
            <x-card>
                <div class="text-center py-12">
                    <div class="w-14 h-14 bg-gray-50 dark:bg-slate-800 rounded-2xl flex items-center justify-center mx-auto">
                        <svg class="w-7 h-7 text-gray-400 dark:text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <p class="mt-4 text-gray-600 dark:text-slate-300 font-semibold">Belum ada pendaftaran</p>
                    <p class="text-sm text-gray-500 dark:text-slate-400 mt-1">Silakan melakukan pendaftaran terlebih dahulu.</p>
                    <a href="{{ route('peserta.jalur.index') }}"
                       class="mt-5 inline-flex items-center gap-1.5 px-5 py-2.5 btn-theme text-sm font-bold rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                        Mulai Pendaftaran
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </x-card>
        </div>
    @elseif($daftarUlang)
        <div class="animate-fade-in">
            <x-card title="Status Daftar Ulang">
                <div class="theme-bg-light border theme-border rounded-2xl p-6 sm:p-8 text-center">
                    <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto theme-bg-light">
                        <svg class="w-8 h-8 theme-text" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="mt-4 text-xl font-extrabold theme-text dark:text-white">Daftar Ulang Berhasil</h3>
                    <p class="mt-2 text-sm text-emerald-700 dark:text-emerald-400">
                        Anda telah melakukan daftar ulang pada {{ $daftarUlang->tanggal_daftar_ulang ? \Carbon\Carbon::parse($daftarUlang->tanggal_daftar_ulang)->translatedFormat('d F Y H:i') : ($daftarUlang->created_at ? $daftarUlang->created_at->translatedFormat('d F Y H:i') : '-') }}.
                    </p>
                    <div class="mt-4 inline-flex items-center gap-2 btn-theme px-6 py-2 rounded-xl font-bold text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"/>
                        </svg>
                        Status: {{ ucfirst($daftarUlang->status ?? 'Terkonfirmasi') }}
                    </div>
                </div>
            </x-card>
        </div>
    @elseif($pendaftaran->status_pendaftaran === 'diterima')
        <div class="animate-fade-in">
            <x-card>
                <div class="rounded-2xl p-8 sm:p-10 text-center text-white relative overflow-hidden theme-bg">
                    <div class="absolute top-0 right-0 w-40 h-40 bg-white/10 rounded-full -translate-y-20 translate-x-20 blur-3xl"></div>
                    <div class="relative">
                        <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mx-auto backdrop-blur-sm">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="mt-4 text-2xl font-extrabold">Selamat Anda Diterima!</h3>
                        <p class="mt-2 text-white/75 max-w-md mx-auto">Anda telah diterima sebagai calon peserta baru. Silakan melakukan daftar ulang untuk mengkonfirmasi tempat Anda.</p>
                        <form method="POST" action="{{ route('peserta.daftar-ulang.store') }}" class="mt-6" onsubmit="return confirm('Yakin akan melakukan daftar ulang?')">
                            @csrf
                            <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 bg-white theme-text font-bold rounded-xl hover:bg-white/90 transition-all duration-200 shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                                </svg>
                                Daftar Ulang Sekarang
                            </button>
                        </form>
                    </div>
                </div>
            </x-card>
        </div>

        <div class="animate-fade-in" style="animation-delay: 0.1s">
            <x-card title="Informasi Daftar Ulang">
                <div class="space-y-3">
                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 rounded-full theme-bg-light flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-3.5 h-3.5 theme-text" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-slate-400">Daftar ulang dapat dilakukan hingga batas waktu yang ditentukan oleh panitia PPDB.</p>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 rounded-full theme-bg-light flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-3.5 h-3.5 theme-text" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-slate-400">Setelah daftar ulang, status Anda akan dikonfirmasi oleh pihak sekolah.</p>
                    </div>
                </div>
            </x-card>
        </div>
    @elseif($pendaftaran->status_pendaftaran === 'ditolak')
        <div class="animate-fade-in">
            <x-card>
                <div class="text-center py-12">
                    <div class="w-16 h-16 bg-red-50 dark:bg-red-500/10 rounded-2xl flex items-center justify-center mx-auto">
                        <svg class="w-8 h-8 text-red-400 dark:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="mt-4 text-xl font-extrabold text-red-800 dark:text-red-300">Mohon Maaf</h3>
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400 max-w-md mx-auto">Pendaftaran Anda belum dapat diterima. Silakan hubungi panitia PPDB untuk informasi lebih lanjut.</p>
                </div>
            </x-card>
        </div>
    @else
        <div class="animate-fade-in">
            <x-card>
                <div class="text-center py-12">
                    <div class="w-16 h-16 bg-amber-50 dark:bg-amber-500/10 rounded-2xl flex items-center justify-center mx-auto">
                        <svg class="w-8 h-8 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="mt-4 text-xl font-extrabold text-gray-800 dark:text-white">Menunggu Pengumuman</h3>
                    <p class="mt-2 text-sm text-gray-500 dark:text-slate-400">
                        Status pendaftaran Anda:
                        <span class="font-bold text-gray-700 dark:text-white">
                            @switch($pendaftaran->status_pendaftaran)
                                @case('draft') Draft @break
                                @case('submitted') Sedang Diproses @break
                                @case('verifikasi') Dalam Verifikasi @break
                                @default {{ ucfirst($pendaftaran->status_pendaftaran) }}
                            @endswitch
                        </span>
                    </p>
                    <p class="text-sm text-gray-400 dark:text-slate-500 mt-2">Halaman daftar ulang akan tersedia jika Anda dinyatakan diterima.</p>
                </div>
            </x-card>
        </div>
    @endif
@endsection
