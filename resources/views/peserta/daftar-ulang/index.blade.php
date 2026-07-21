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

    @elseif($pendaftaran->status_pendaftaran !== 'diterima')
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

    @elseif($daftarUlang && $daftarUlang->status === 'sudah')
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
                        Anda telah melakukan daftar ulang pada {{ $daftarUlang->tanggal_daftar_ulang ? $daftarUlang->tanggal_daftar_ulang->setTimezone('Asia/Makassar')->translatedFormat('d F Y H:i') : '-' }} WITA.
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
                        <p class="text-xs text-gray-400 dark:text-slate-500 font-mono" x-text="now"></p>
                    </div>
                </div>
            </x-card>
        </div>

        <div class="animate-fade-in" style="animation-delay: 0.1s">
            <x-card title="Dokumen yang Diunggah">
                @php
                    $docs = [
                        'bukti_kelulusan' => 'Bukti Kelulusan / Tanda Diterima',
                        'fotokopi_kk' => 'Fotokopi Kartu Keluarga',
                        'akta_kelahiran' => 'Akta Kelahiran',
                        'ktp_orang_tua' => 'KTP Orang Tua',
                        'skl_ijazah' => 'SKL / Ijazah',
                    ];
                @endphp
                <div class="space-y-3">
                    @foreach($docs as $field => $label)
                        <div class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-4 py-2 border-b border-gray-100 dark:border-slate-700 last:border-0">
                            <span class="text-xs font-bold text-gray-400 dark:text-slate-500 uppercase tracking-widest w-48 shrink-0">{{ $label }}</span>
                            <span class="text-sm text-gray-900 dark:text-white font-medium">
                                @if($daftarUlang->$field)
                                    <a href="{{ Storage::url($daftarUlang->$field) }}" target="_blank" class="theme-text hover:underline flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        Lihat File
                                    </a>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </span>
                        </div>
                    @endforeach
                </div>
            </x-card>
        </div>

    @elseif($pendaftaran->status_pendaftaran === 'diterima')
        <div class="animate-fade-in">
            <x-card>
                <div class="rounded-2xl p-6 sm:p-8 text-center text-white relative overflow-hidden theme-bg">
                    <div class="absolute top-0 right-0 w-40 h-40 bg-white/10 rounded-full -translate-y-20 translate-x-20 blur-3xl"></div>
                    <div class="relative">
                        <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mx-auto backdrop-blur-sm">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="mt-4 text-2xl font-extrabold">Selamat Anda Diterima!</h3>
                        <p class="mt-2 text-white/75 max-w-md mx-auto">Silakan unggah dokumen daftar ulang di bawah ini.</p>
                    </div>
                </div>
            </x-card>
        </div>

        <div class="animate-fade-in" style="animation-delay: 0.1s">
            <form method="POST" action="{{ route('peserta.daftar-ulang.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <x-card title="Unggah Dokumen Daftar Ulang">
                    @php
                        $docFields = [
                            ['field' => 'bukti_kelulusan', 'label' => 'Bukti Kelulusan / Tanda Diterima', 'desc' => 'Surat pengumuman kelulusan atau tanda diterima'],
                            ['field' => 'fotokopi_kk', 'label' => 'Fotokopi Kartu Keluarga', 'desc' => 'Fotokopi KK yang masih berlaku'],
                            ['field' => 'akta_kelahiran', 'label' => 'Akta Kelahiran', 'desc' => 'Fotokopi akta kelahiran'],
                            ['field' => 'ktp_orang_tua', 'label' => 'KTP Orang Tua', 'desc' => 'Fotokopi KTP ayah dan/atau ibu'],
                            ['field' => 'skl_ijazah', 'label' => 'SKL / Ijazah', 'desc' => 'Surat Keterangan Lulus atau Ijazah SD'],
                        ];
                    @endphp

                    <div class="space-y-5">
                        @foreach($docFields as $doc)
                            <div class="p-4 rounded-xl border border-gray-200 dark:border-slate-600 bg-gray-50/50 dark:bg-slate-700/30">
                                <label class="block text-sm font-semibold text-gray-700 dark:text-slate-300 mb-1">
                                    {{ $doc['label'] }}
                                    <span class="text-red-500">*</span>
                                </label>
                                <p class="text-xs text-gray-400 dark:text-slate-500 mb-2">{{ $doc['desc'] }}</p>
                                <input type="file" name="{{ $doc['field'] }}" required
                                    class="w-full text-sm text-gray-700 dark:text-slate-300 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:theme-bg-light file:theme-text hover:file:opacity-80 file:cursor-pointer file:transition-all">
                                <p class="mt-1 text-xs text-gray-400">Format: PDF, JPG, JPEG, PNG. Maks 5MB.</p>
                                @error($doc['field'])
                                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        @endforeach
                    </div>
                </x-card>

                <div class="flex items-center justify-center gap-3">
                    <button type="submit" onclick="return confirm('Yakin akan melakukan daftar ulang?')"
                        class="inline-flex items-center gap-2 px-6 py-3 btn-theme text-sm font-bold rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Kirim Daftar Ulang
                    </button>
                    <a href="{{ route('peserta.dashboard') }}"
                       class="inline-flex items-center gap-2 px-6 py-3 bg-gray-100 dark:bg-slate-700 text-gray-700 dark:text-slate-300 text-sm font-bold rounded-xl hover:bg-gray-200 dark:hover:bg-slate-600 transition-all">
                        Kembali
                    </a>
                </div>
            </form>
        </div>

        <div class="animate-fade-in" style="animation-delay: 0.2s">
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
    @endif
@endsection
