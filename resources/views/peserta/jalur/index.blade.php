@extends('layouts.peserta')

@section('header', 'Pilih Jalur Pendaftaran')

@section('content')
    @if($pendaftaran)
        <div class="animate-fade-in">
            <x-card title="Pilihan Saat Ini">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl theme-second-bg-light flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6 theme-second-text" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold text-lg text-gray-900 dark:text-white">{{ $pendaftaran->jalurPendaftaran?->nama ?? '-' }}</p>
                            <p class="text-sm text-gray-500 dark:text-slate-400 mt-0.5">{{ $pendaftaran->jalurPendaftaran?->deskripsi ?? '' }}</p>
                        </div>
                    </div>
                    <x-badge :color="$pendaftaran->status_pendaftaran === 'submitted' ? 'blue' : 'yellow'">
                        {{ $pendaftaran->status_pendaftaran === 'submitted' ? 'Telah Dikirim' : 'Dipilih' }}
                    </x-badge>
                </div>
            </x-card>
        </div>

        @if($pendaftaran->status_pendaftaran !== 'draft')
            <div class="animate-fade-in" style="animation-delay: 0.1s">
                <x-card>
                    <div class="text-center py-8">
                        <div class="w-14 h-14 bg-gray-50 dark:bg-slate-800 rounded-2xl flex items-center justify-center mx-auto">
                            <svg class="w-7 h-7 text-gray-400 dark:text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <p class="mt-4 text-gray-600 dark:text-slate-300 font-semibold">Pendaftaran telah dikirimkan</p>
                        <p class="text-sm text-gray-500 dark:text-slate-400 mt-1">Jalur pendaftaran tidak dapat diubah karena pendaftaran sudah diproses.</p>
                    </div>
                </x-card>
            </div>
        @endif
    @endif

    @if(!$pendaftaran || $pendaftaran->status_pendaftaran === 'draft')
        <form method="POST" action="{{ route('peserta.jalur.store') }}" x-data="{ selected: '{{ $pendaftaran?->jalur_pendaftaran_id ?? '' }}' }">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @forelse($jalur as $j)
                    <div @click="selected = '{{ $j->id }}'"
                         class="cursor-pointer rounded-2xl border-2 p-5 transition-all duration-200 hover:shadow-md"
                         :class="selected === '{{ $j->id }}' ? 'theme-border theme-bg-light shadow-lg' : 'border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-900 hover:border-gray-300 dark:hover:border-slate-600'">
                        <div class="flex items-start justify-between gap-2">
                            <div class="w-11 h-11 rounded-xl flex items-center justify-center shrink-0 transition-all"
                                 :class="selected === '{{ $j->id }}' ? 'theme-bg-light theme-text' : 'bg-gray-100 dark:bg-slate-800 text-gray-500 dark:text-slate-400'">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                            </div>
                            <input type="radio" name="jalur_pendaftaran_id" value="{{ $j->id }}" x-model="selected" class="sr-only">
                        </div>
                        <h4 class="mt-3 font-bold text-gray-900 dark:text-white">{{ $j->nama }}</h4>
                        <p class="text-xs text-gray-500 dark:text-slate-400 mt-1 font-medium">Kuota: {{ $j->kuota }} peserta</p>
                        @if($j->deskripsi)
                            <p class="text-sm text-gray-600 dark:text-slate-300 mt-2">{{ $j->deskripsi }}</p>
                        @endif
                        @if($j->persyaratanDokumens->count())
                            <div class="mt-3 pt-3 border-t border-gray-100 dark:border-slate-800">
                                <p class="text-[10px] font-bold text-gray-400 dark:text-slate-500 uppercase tracking-wider mb-1.5">Persyaratan:</p>
                                <div class="space-y-1">
                                    @foreach($j->persyaratanDokumens as $p)
                                        <div class="flex items-center gap-1.5">
                                            <svg class="w-3 h-3 text-gray-400 dark:text-slate-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                            <p class="text-xs text-gray-600 dark:text-slate-400">{{ $p->nama }}{{ $p->is_wajib ? ' *' : '' }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        <div class="mt-4">
                            <button type="submit" @click="selected = '{{ $j->id }}'"
                                    class="w-full text-center px-4 py-2.5 text-sm font-bold rounded-xl transition-all duration-200"
                                    :class="selected === '{{ $j->id }}' ? 'btn-theme shadow-lg' : 'bg-gray-100 dark:bg-slate-800 text-gray-700 dark:text-slate-300 hover:bg-gray-200 dark:hover:bg-slate-700'">
                                <span class="inline-flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Pilih Jalur Ini
                                </span>
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full">
                        <x-card>
                            <div class="text-center py-12">
                                <div class="w-14 h-14 bg-gray-50 dark:bg-slate-800 rounded-2xl flex items-center justify-center mx-auto">
                                    <svg class="w-7 h-7 text-gray-400 dark:text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                                <p class="mt-4 text-gray-600 dark:text-slate-300 font-semibold">Belum ada jalur pendaftaran</p>
                                <p class="text-sm text-gray-500 dark:text-slate-400 mt-1">Belum ada jalur pendaftaran tersedia saat ini.</p>
                            </div>
                        </x-card>
                    </div>
                @endforelse
            </div>
        </form>
    @endif
@endsection
