@extends('layouts.peserta')

@section('header', 'Pendaftaran Terkirim')

@section('content')
    <div class="animate-fade-in">
        <div class="rounded-2xl p-6 sm:p-10 text-center text-white relative overflow-hidden" style="background: linear-gradient(135deg, #059669, #047857)">
            <div class="absolute top-0 right-0 w-48 h-48 bg-white/10 rounded-full -translate-y-24 translate-x-24 blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-36 h-36 bg-white/5 rounded-full translate-y-18 -translate-x-18 blur-2xl"></div>
            <div class="relative">
                @if(isset($profil) && $profil?->logo)
                    <img src="{{ Storage::url($profil->logo) }}" alt="Logo" class="h-16 mx-auto mb-3 rounded-xl bg-white p-1.5">
                @else
                    <div class="w-20 h-20 bg-white/20 rounded-3xl flex items-center justify-center mx-auto backdrop-blur-sm">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                @endif
                <h2 class="mt-4 text-2xl sm:text-3xl font-extrabold">Pendaftaran Berhasil Dikirim!</h2>
                <p class="mt-2 text-sm text-emerald-100 max-w-md mx-auto">
                    Data pendaftaran Anda telah berhasil dikirim dan sedang menunggu verifikasi oleh petugas.
                </p>
                <div x-data="{ now: '' }" x-init="
                    const tick = () => {
                        const d = new Date();
                        const opts = { timeZone: 'Asia/Makassar', weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false };
                        now = d.toLocaleString('id-ID', opts) + ' WITA';
                    };
                    tick();
                    setInterval(tick, 1000);
                " class="mt-3">
                    <p class="text-xs font-mono text-emerald-200" x-text="now"></p>
                </div>
            </div>
        </div>
    </div>

    <div class="animate-fade-in" style="animation-delay: 0.1s">
        <x-card>
            <div class="text-center">
                <p class="text-xs font-bold text-gray-400 dark:text-slate-500 uppercase tracking-widest">Nomor Pendaftaran</p>
                <p class="mt-2 text-xl sm:text-2xl font-extrabold theme-text tracking-wide">{{ $pendaftaran->nomor_pendaftaran ?? '-' }}</p>
                @if($pendaftaran->peserta)
                    <p class="mt-1 text-sm text-gray-500 dark:text-slate-400">{{ $pendaftaran->peserta->nama_lengkap }}</p>
                @endif
            </div>

            <div class="grid grid-cols-2 gap-4 mt-6">
                <div class="rounded-xl bg-gray-50 dark:bg-slate-700/30 p-4 text-center">
                    <p class="text-[10px] font-bold text-gray-400 dark:text-slate-500 uppercase tracking-widest">Jalur</p>
                    <p class="mt-1.5 text-sm font-bold text-gray-900 dark:text-white">{{ $pendaftaran->jalurPendaftaran?->nama ?? '-' }}</p>
                </div>
                <div class="rounded-xl bg-gray-50 dark:bg-slate-700/30 p-4 text-center">
                    <p class="text-[10px] font-bold text-gray-400 dark:text-slate-500 uppercase tracking-widest">Status</p>
                    <div class="mt-1.5">
                        <x-peserta.status-badge :status="$pendaftaran->status_pendaftaran" />
                    </div>
                </div>
            </div>

            <div class="mt-4 rounded-xl bg-blue-50 dark:bg-blue-500/10 border border-blue-200 dark:border-blue-500/20 p-4">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-blue-600 dark:text-blue-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-xs text-blue-700 dark:text-blue-300">Simpan nomor pendaftaran Anda. Nomor ini digunakan untuk melacak status pendaftaran.</p>
                </div>
            </div>
        </x-card>
    </div>

    <div class="animate-fade-in" style="animation-delay: 0.2s">
        <x-card title="Langkah Selanjutnya">
            <div class="space-y-4">
                <div class="flex items-start gap-4">
                    <div class="w-8 h-8 rounded-xl theme-bg-light flex items-center justify-center shrink-0 mt-0.5">
                        <svg class="w-4 h-4 theme-text" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-900 dark:text-white">Verifikasi Data</p>
                        <p class="text-xs text-gray-500 dark:text-slate-400 mt-0.5">Petugas akan memeriksa kelengkapan data dan dokumen Anda.</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <div class="w-8 h-8 rounded-xl bg-amber-50 dark:bg-amber-500/10 flex items-center justify-center shrink-0 mt-0.5">
                        <svg class="w-4 h-4 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-900 dark:text-white">Menunggu Hasil Seleksi</p>
                        <p class="text-xs text-gray-500 dark:text-slate-400 mt-0.5">Hasil seleksi akan diumumkan melalui halaman pengumuman.</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <div class="w-8 h-8 rounded-xl bg-blue-50 dark:bg-blue-500/10 flex items-center justify-center shrink-0 mt-0.5">
                        <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-900 dark:text-white">Daftar Ulang</p>
                        <p class="text-xs text-gray-500 dark:text-slate-400 mt-0.5">Jika diterima, silakan melakukan daftar ulang sesuai jadwal yang ditentukan.</p>
                    </div>
                </div>
            </div>
        </x-card>
    </div>

    <div class="animate-fade-in flex flex-col sm:flex-row items-center justify-center gap-3 mt-2" style="animation-delay: 0.3s">
        <a href="{{ route('peserta.pendaftaran.cetak') }}"
           class="inline-flex items-center gap-2 px-6 py-2.5 btn-theme text-sm font-bold rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl hover:-translate-y-0.5">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
            </svg>
            Cetak Bukti Pendaftaran
        </a>
        <a href="{{ route('peserta.dashboard') }}"
           class="inline-flex items-center gap-2 px-6 py-2.5 bg-gray-100 dark:bg-slate-700 text-gray-700 dark:text-slate-300 text-sm font-bold rounded-xl hover:bg-gray-200 dark:hover:bg-slate-600 transition-all duration-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            Kembali ke Dashboard
        </a>
    </div>
@endsection
