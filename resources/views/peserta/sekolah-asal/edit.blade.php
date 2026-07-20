@extends('layouts.peserta')

@section('header', 'Sekolah Asal')

@section('content')
    <div class="animate-fade-in">
        <x-card>
            <form method="POST" action="{{ route('peserta.sekolah-asal.update') }}">
                @csrf
                @method('PUT')

                <div class="space-y-8">
                    <div>
                        <div class="flex items-center gap-3 mb-5 pb-4 border-b border-gray-100 dark:border-slate-800">
                            <div class="w-10 h-10 rounded-xl bg-indigo-50 dark:bg-indigo-500/10 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                            </div>
                            <h3 class="text-sm font-bold text-gray-900 dark:text-white uppercase tracking-wider">Informasi Sekolah</h3>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="md:col-span-2">
                                <x-input-label for="nama_sekolah" value="Nama Sekolah Asal" />
                                <x-text-input id="nama_sekolah" name="nama_sekolah" type="text" class="mt-1.5 block w-full" :value="old('nama_sekolah', $sekolah->nama_sekolah)" placeholder="Masukkan nama sekolah asal" required />
                                <x-input-error :messages="$errors->get('nama_sekolah')" class="mt-1" />
                            </div>
                            <div>
                                <x-input-label for="npsn" value="NPSN" />
                                <x-text-input id="npsn" name="npsn" type="text" class="mt-1.5 block w-full" :value="old('npsn', $sekolah->npsn)" placeholder="Minimal 8 digit angka" />
                                <p class="mt-1 text-xs text-gray-400 dark:text-slate-500">Minimal 8 karakter, angka saja</p>
                                <x-input-error :messages="$errors->get('npsn')" class="mt-1" />
                            </div>
                            <div>
                                <x-input-label for="tahun_lulus" value="Tahun Lulus" />
                                <x-text-input id="tahun_lulus" name="tahun_lulus" type="number" min="2000" max="{{ date('Y') }}" class="mt-1.5 block w-full" :value="old('tahun_lulus', $sekolah->tahun_lulus)" placeholder="Contoh: 2025" />
                                <p class="mt-1 text-xs text-gray-400 dark:text-slate-500">Tahun antara 2000 - {{ date('Y') }}</p>
                                <x-input-error :messages="$errors->get('tahun_lulus')" class="mt-1" />
                            </div>
                            <div class="md:col-span-2">
                                <x-input-label for="alamat" value="Alamat Sekolah" />
                                <textarea id="alamat" name="alamat" rows="3" class="mt-1.5 block w-full border-gray-300 dark:border-slate-600 dark:bg-slate-800 focus:border-[var(--color-primary)] focus:ring-[var(--color-primary)] rounded-xl" placeholder="Masukkan alamat sekolah">{{ old('alamat', $sekolah->alamat) }}</textarea>
                                <x-input-error :messages="$errors->get('alamat')" class="mt-1" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-gray-100 dark:border-slate-800 flex flex-wrap items-center gap-3">
                    <x-primary-button>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Sekolah Asal
                    </x-primary-button>
                    <x-secondary-button onclick="window.location='{{ route('peserta.dashboard') }}'">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Batal
                    </x-secondary-button>
                </div>
            </form>
        </x-card>
    </div>
@endsection
