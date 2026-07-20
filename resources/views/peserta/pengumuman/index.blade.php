@extends('layouts.peserta')

@section('header', 'Pengumuman')

@section('content')
    @if($pendaftaran)
        <div class="bg-white dark:bg-slate-900 rounded-2xl border border-gray-200/60 dark:border-slate-800 overflow-hidden shadow-sm animate-fade-in">
            @if($pendaftaran->status_pendaftaran === 'diterima')
                <div class="px-6 py-3" style="background: linear-gradient(135deg, #059669, #047857)">
                    <p class="text-xs font-bold text-emerald-100 uppercase tracking-widest">Hasil Seleksi</p>
                </div>
                <div class="p-5 sm:p-6 flex items-start gap-4">
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 dark:bg-emerald-500/10 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="text-base font-extrabold text-emerald-800 dark:text-emerald-300">Selamat! Anda Diterima</h3>
                        <p class="text-sm text-gray-600 dark:text-slate-300 mt-1">Anda dinyatakan <strong class="text-emerald-700 dark:text-emerald-400">lolos</strong> seleksi PPDB melalui jalur {{ $pendaftaran->jalurPendaftaran?->nama ?? '-' }}.</p>
                        <div class="mt-4 flex flex-wrap gap-2">
                            <a href="{{ route('peserta.daftar-ulang.index') }}"
                               class="inline-flex items-center gap-1.5 px-4 py-2 bg-emerald-600 text-white text-xs font-bold rounded-xl hover:bg-emerald-700 transition-all duration-200 shadow-lg hover:shadow-xl">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                                </svg>
                                Daftar Ulang Sekarang
                            </a>
                            <a href="{{ route('peserta.dashboard') }}"
                               class="inline-flex items-center gap-1.5 px-4 py-2 bg-gray-100 dark:bg-slate-800 text-gray-700 dark:text-slate-300 text-xs font-bold rounded-xl hover:bg-gray-200 dark:hover:bg-slate-700 transition-all duration-200">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                                Ke Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            @elseif($pendaftaran->status_pendaftaran === 'ditolak')
                <div class="bg-red-500 px-6 py-3">
                    <p class="text-xs font-bold text-red-100 uppercase tracking-widest">Hasil Seleksi</p>
                </div>
                <div class="p-5 sm:p-6 flex items-start gap-4">
                    <div class="w-12 h-12 rounded-xl bg-red-50 dark:bg-red-500/10 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="text-base font-extrabold text-red-800 dark:text-red-300">Mohon Maaf</h3>
                        <p class="text-sm text-gray-600 dark:text-slate-300 mt-1">Pendaftaran Anda melalui jalur {{ $pendaftaran->jalurPendaftaran?->nama ?? '-' }} belum dapat diterima.</p>
                        <p class="text-xs text-gray-500 dark:text-slate-400 mt-2">Silakan hubungi panitia PPDB untuk informasi lebih lanjut.</p>
                    </div>
                </div>
            @elseif($pendaftaran->status_pendaftaran === 'cadangan')
                <div class="bg-amber-500 px-6 py-3">
                    <p class="text-xs font-bold text-amber-100 uppercase tracking-widest">Hasil Seleksi</p>
                </div>
                <div class="p-5 sm:p-6 flex items-start gap-4">
                    <div class="w-12 h-12 rounded-xl bg-amber-50 dark:bg-amber-500/10 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="text-base font-extrabold text-amber-800 dark:text-amber-300">Cadangan</h3>
                        <p class="text-sm text-gray-600 dark:text-slate-300 mt-1">Pendaftaran Anda masuk dalam daftar <strong class="text-amber-700 dark:text-amber-400">cadangan</strong> untuk jalur {{ $pendaftaran->jalurPendaftaran?->nama ?? '-' }}.</p>
                        <p class="text-xs text-gray-500 dark:text-slate-400 mt-2">Kami akan menginformasikan jika ada perubahan status.</p>
                    </div>
                </div>
            @endif
        </div>
    @endif

    <div class="space-y-3">
        @forelse($data as $pengumuman)
            <div class="bg-white dark:bg-slate-900 rounded-2xl border border-gray-200/60 dark:border-slate-800 overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300 animate-fade-in" x-data="{ open: false }">
                <div class="cursor-pointer" @click="open = !open">
                    <div class="p-5 sm:p-6">
                        <div class="flex items-center justify-between gap-3">
                            <h3 class="text-sm font-bold text-gray-900 dark:text-white truncate">{{ $pengumuman->judul }}</h3>
                            <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-slate-400 shrink-0">
                                <svg class="h-3.5 w-3.5 hidden sm:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span class="hidden sm:inline">{{ $pengumuman->created_at ? $pengumuman->created_at->translatedFormat('d F Y') : '-' }}</span>
                                <span class="sm:hidden">{{ $pengumuman->created_at ? $pengumuman->created_at->format('d/m') : '-' }}</span>
                                <svg class="h-3.5 w-3.5 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>
                        <div class="mt-2 text-sm text-gray-600 dark:text-slate-400" x-show="!open">
                            {{ \Illuminate\Support\Str::limit(strip_tags($pengumuman->isi), 200) }}
                        </div>
                        <div class="mt-3 text-sm text-gray-700 dark:text-slate-300 leading-relaxed" x-show="open" x-cloak>
                            {!! nl2br(e($pengumuman->isi)) !!}
                        </div>
                    </div>
                </div>
            </div>
        @empty
            @if(!$pendaftaran)
                <div class="animate-fade-in">
                    <x-card>
                        <div class="text-center py-12">
                            <div class="w-14 h-14 rounded-2xl flex items-center justify-center mx-auto theme-bg-light">
                                <svg class="w-7 h-7 theme-text" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                                </svg>
                            </div>
                            <p class="mt-4 text-sm text-gray-500 dark:text-slate-400">Belum ada pengumuman.</p>
                        </div>
                    </x-card>
                </div>
            @endif
        @endforelse
    </div>
@endsection
