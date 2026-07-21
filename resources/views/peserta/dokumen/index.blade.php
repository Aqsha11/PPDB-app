@extends('layouts.peserta')

@section('header', 'Dokumen Persyaratan')

@section('content')
    @if(session('error'))
        <div class="animate-fade-in">
            <x-alert type="danger" :message="session('error')" />
        </div>
    @endif

    @if(!$pendaftaran)
        <div class="animate-fade-in">
            <x-card>
                <div class="text-center py-12">
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center mx-auto theme-bg-light">
                        <svg class="w-7 h-7 theme-text" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <p class="mt-4 text-gray-600 dark:text-slate-300 font-semibold">Belum memilih jalur pendaftaran</p>
                    <p class="text-sm text-gray-500 dark:text-slate-400 mt-1">Silakan pilih jalur pendaftaran terlebih dahulu sebelum mengunggah dokumen.</p>
                    <a href="{{ route('peserta.jalur.index') }}"
                       class="mt-5 inline-flex items-center gap-1.5 px-5 py-2.5 btn-theme text-sm font-bold rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                        Pilih Jalur
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </x-card>
        </div>
    @else
        @php
            $wajib = $persyaratan->where('is_wajib', true)->sortBy('urutan');
            $opsional = $persyaratan->where('is_wajib', false)->sortBy('urutan');
        @endphp

        {{-- Ringkasan --}}
        <div class="animate-fade-in">
            <x-card>
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div class="flex items-start gap-4">
                        <div class="w-11 h-11 rounded-xl theme-bg-light flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 theme-text" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold text-gray-900 dark:text-white">Dokumen Persyaratan</p>
                            <p class="text-sm text-gray-500 dark:text-slate-400 mt-0.5">
                                @php
                                    $totalWajib = $wajib->count();
                                    $uploadedWajib = $wajib->filter(fn($item) => $dokumen->contains('persyaratan_dokumen_id', $item->id))->count();
                                @endphp
                                {{ $uploadedWajib }}/{{ $totalWajib }} dokumen wajib terunggah
                                @if($opsional->count() > 0)
                                    · {{ $opsional->filter(fn($item) => $dokumen->contains('persyaratan_dokumen_id', $item->id))->count() }}/{{ $opsional->count() }} dokumen opsional
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="h-2 sm:w-32 bg-gray-200 dark:bg-slate-700 rounded-full overflow-hidden shrink-0">
                        @php
                            $pct = $totalWajib > 0 ? round(($uploadedWajib / $totalWajib) * 100) : 0;
                        @endphp
                        <div class="h-full rounded-full transition-all duration-500 {{ $pct >= 100 ? 'bg-emerald-500' : 'theme-bg' }}" style="width: {{ $pct }}%"></div>
                    </div>
                </div>
            </x-card>
        </div>

        {{-- Dokumen Wajib --}}
        @if($wajib->count() > 0)
            <div class="animate-fade-in" style="animation-delay: 0.05s">
                <x-card>
                    <x-slot name="title">
                        <span class="flex items-center gap-2">
                            Dokumen Wajib
                            <x-badge color="red">{{ $wajib->count() }}</x-badge>
                        </span>
                    </x-slot>
                    <div class="divide-y divide-gray-100 dark:divide-slate-800">
                        @foreach($wajib as $item)
                            @php
                                $uploaded = $dokumen->firstWhere('persyaratan_dokumen_id', $item->id);
                                $formats = $item->format ? explode(',', $item->format) : ['pdf','jpg','jpeg','png'];
                                $accept = collect($formats)->map(fn($f) => '.' . trim($f))->implode(',');
                            @endphp
                            <div class="py-5 first:pt-0 last:pb-0">
                                <div class="flex flex-col sm:flex-row sm:items-start gap-4">
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center gap-2 flex-wrap">
                                            <p class="text-sm font-bold text-gray-900 dark:text-white">{{ $item->nama }}</p>
                                            @if($item->kategori)
                                                <span class="text-[10px] font-semibold px-2 py-0.5 rounded-full bg-gray-100 dark:bg-slate-700 text-gray-500 dark:text-slate-400 uppercase tracking-wider">{{ $item->kategori }}</span>
                                            @endif
                                        </div>
                                        @if($item->keterangan)
                                            <p class="text-xs text-gray-500 dark:text-slate-400 mt-1">{{ $item->keterangan }}</p>
                                        @endif
                                        <p class="text-[11px] text-gray-400 dark:text-slate-500 mt-1">
                                            Format: {{ strtoupper(implode(', ', $formats)) }}
                                            @if($item->max_size)
                                                · Maks: {{ $item->max_size }} MB
                                            @endif
                                        </p>

                                        @if($uploaded)
                                            <div class="mt-3 flex items-center gap-2 flex-wrap">
                                                <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-emerald-50 dark:bg-emerald-500/10 text-emerald-700 dark:text-emerald-400 rounded-xl text-sm font-medium">
                                                    <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                    </svg>
                                                    <span class="truncate max-w-[180px]">{{ basename($uploaded->file) }}</span>
                                                </div>
                                                @if($uploaded->status === 'terverifikasi')
                                                    <x-badge color="green">Terverifikasi</x-badge>
                                                @elseif($uploaded->status === 'revisi')
                                                    <x-badge color="red">Revisi</x-badge>
                                                @else
                                                    <x-badge color="yellow">Menunggu</x-badge>
                                                @endif
                                            </div>
                                        @endif
                                    </div>

                                    <div class="shrink-0">
                                        @if($uploaded)
                                            <form method="POST" action="{{ route('peserta.dokumen.destroy', $uploaded) }}" onsubmit="return confirm('Hapus dokumen ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <x-icon-button variant="danger" size="sm" title="Hapus dokumen" delete />
                                            </form>
                                        @else
                                            <form method="POST" action="{{ route('peserta.dokumen.store') }}" enctype="multipart/form-data" class="flex flex-col items-end gap-2">
                                                @csrf
                                                <input type="hidden" name="persyaratan_dokumen_id" value="{{ $item->id }}">
                                                <div class="relative">
                                                    <input type="file" name="file" accept="{{ $accept }}"
                                                           class="block w-full sm:w-64 text-sm text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-theme-bg-light file:theme-text hover:file:opacity-80 file:transition-colors file:cursor-pointer"
                                                           required>
                                                </div>
                                                <x-input-error :messages="$errors->get('file')" class="mt-1" />
                                                <x-primary-button type="submit" class="!px-4 !py-1.5 text-xs !rounded-xl">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                                    </svg>
                                                    Upload
                                                </x-primary-button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </x-card>
            </div>
        @endif

        {{-- Dokumen Opsional --}}
        @if($opsional->count() > 0)
            <div class="animate-fade-in" style="animation-delay: 0.1s">
                <x-card>
                    <x-slot name="title">
                        <span class="flex items-center gap-2">
                            Dokumen Opsional
                            <x-badge color="gray">{{ $opsional->count() }}</x-badge>
                        </span>
                    </x-slot>
                    <div class="divide-y divide-gray-100 dark:divide-slate-800">
                        @foreach($opsional as $item)
                            @php
                                $uploaded = $dokumen->firstWhere('persyaratan_dokumen_id', $item->id);
                                $formats = $item->format ? explode(',', $item->format) : ['pdf','jpg','jpeg','png'];
                                $accept = collect($formats)->map(fn($f) => '.' . trim($f))->implode(',');
                            @endphp
                            <div class="py-5 first:pt-0 last:pb-0">
                                <div class="flex flex-col sm:flex-row sm:items-start gap-4">
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center gap-2 flex-wrap">
                                            <p class="text-sm font-bold text-gray-900 dark:text-white">{{ $item->nama }}</p>
                                            @if($item->kategori)
                                                <span class="text-[10px] font-semibold px-2 py-0.5 rounded-full bg-gray-100 dark:bg-slate-700 text-gray-500 dark:text-slate-400 uppercase tracking-wider">{{ $item->kategori }}</span>
                                            @endif
                                        </div>
                                        @if($item->keterangan)
                                            <p class="text-xs text-gray-500 dark:text-slate-400 mt-1">{{ $item->keterangan }}</p>
                                        @endif
                                        <p class="text-[11px] text-gray-400 dark:text-slate-500 mt-1">
                                            Format: {{ strtoupper(implode(', ', $formats)) }}
                                            @if($item->max_size)
                                                · Maks: {{ $item->max_size }} MB
                                            @endif
                                        </p>

                                        @if($uploaded)
                                            <div class="mt-3 flex items-center gap-2 flex-wrap">
                                                <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-emerald-50 dark:bg-emerald-500/10 text-emerald-700 dark:text-emerald-400 rounded-xl text-sm font-medium">
                                                    <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                    </svg>
                                                    <span class="truncate max-w-[180px]">{{ basename($uploaded->file) }}</span>
                                                </div>
                                                @if($uploaded->status === 'terverifikasi')
                                                    <x-badge color="green">Terverifikasi</x-badge>
                                                @elseif($uploaded->status === 'revisi')
                                                    <x-badge color="red">Revisi</x-badge>
                                                @else
                                                    <x-badge color="yellow">Menunggu</x-badge>
                                                @endif
                                            </div>
                                        @endif
                                    </div>

                                    <div class="shrink-0">
                                        @if($uploaded)
                                            <form method="POST" action="{{ route('peserta.dokumen.destroy', $uploaded) }}" onsubmit="return confirm('Hapus dokumen ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <x-icon-button variant="danger" size="sm" title="Hapus dokumen" delete />
                                            </form>
                                        @else
                                            <form method="POST" action="{{ route('peserta.dokumen.store') }}" enctype="multipart/form-data" class="flex flex-col items-end gap-2">
                                                @csrf
                                                <input type="hidden" name="persyaratan_dokumen_id" value="{{ $item->id }}">
                                                <div class="relative">
                                                    <input type="file" name="file" accept="{{ $accept }}"
                                                           class="block w-full sm:w-64 text-sm text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-theme-bg-light file:theme-text hover:file:opacity-80 file:transition-colors file:cursor-pointer">
                                                </div>
                                                <x-input-error :messages="$errors->get('file')" class="mt-1" />
                                                <x-primary-button type="submit" class="!px-4 !py-1.5 text-xs !rounded-xl">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                                    </svg>
                                                    Upload
                                                </x-primary-button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </x-card>
            </div>
        @endif

        @if($pendaftaran->status_pendaftaran === 'draft')
            <div class="animate-fade-in" style="animation-delay: 0.15s">
                <x-card>
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div class="flex items-start gap-4">
                            <div class="w-11 h-11 rounded-xl theme-bg-light flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 theme-text" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-bold text-gray-900 dark:text-white">Finalisasi Pendaftaran</p>
                                <p class="text-sm text-gray-500 dark:text-slate-400 mt-0.5">Pastikan semua data dan dokumen sudah lengkap sebelum mengirimkan pendaftaran.</p>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('peserta.pendaftaran.submit') }}" onsubmit="return confirm('Yakin akan mengirimkan pendaftaran? Data tidak dapat diubah setelah dikirim.')">
                            @csrf
                            <x-primary-button class="!bg-emerald-600 hover:!bg-emerald-700 !rounded-xl">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                </svg>
                                Kirim Pendaftaran
                            </x-primary-button>
                        </form>
                    </div>
                </x-card>
            </div>
        @elseif(in_array($pendaftaran->status_pendaftaran, ['submitted', 'verifikasi']))
            <div class="animate-fade-in">
                <x-alert type="info" message="Pendaftaran telah dikirim dan sedang dalam proses verifikasi." />
            </div>
        @endif
    @endif
@endsection
