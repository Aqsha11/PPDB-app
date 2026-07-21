@extends('layouts.peserta')

@section('header', 'Data Orang Tua')

@section('content')
    <div class="animate-fade-in">
        <x-card>
            <form method="POST" action="{{ route('peserta.orang-tua.update') }}" x-data="formValidation()">
                @csrf
                @method('PUT')

                <div class="space-y-8">
                    <div>
                        <div class="flex items-center gap-3 mb-5 pb-4 border-b border-gray-100 dark:border-slate-800">
                            <div class="w-10 h-10 rounded-xl bg-blue-50 dark:bg-blue-500/10 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <h3 class="text-sm font-bold text-gray-900 dark:text-white uppercase tracking-wider">Data Ayah</h3>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="nama_ayah" value="Nama Ayah" />
                                <x-text-input id="nama_ayah" name="nama_ayah" type="text" class="mt-1.5 block w-full" :value="old('nama_ayah', $ortu->nama_ayah)" placeholder="Masukkan nama ayah" maxlength="255" />
                                <x-input-error :messages="$errors->get('nama_ayah')" class="mt-1" />
                            </div>
                            <div>
                                <x-input-label for="nik_ayah" value="NIK Ayah" />
                                <x-text-input id="nik_ayah" name="nik_ayah" type="text" class="mt-1.5 block w-full" :value="old('nik_ayah', $ortu->nik_ayah)" placeholder="16 digit NIK" maxlength="16" pattern="[0-9]{16}" data-pattern-error="NIK harus 16 digit angka." />
                                <p class="mt-1 text-xs text-gray-400 dark:text-slate-500">16 karakter, angka saja</p>
                                <x-input-error :messages="$errors->get('nik_ayah')" class="mt-1" />
                            </div>
                            <div>
                                <x-input-label for="pekerjaan_ayah" value="Pekerjaan Ayah" />
                                <x-text-input id="pekerjaan_ayah" name="pekerjaan_ayah" type="text" class="mt-1.5 block w-full" :value="old('pekerjaan_ayah', $ortu->pekerjaan_ayah)" placeholder="Contoh: Guru" maxlength="255" />
                                <x-input-error :messages="$errors->get('pekerjaan_ayah')" class="mt-1" />
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center gap-3 mb-5 pb-4 border-b border-gray-100 dark:border-slate-800">
                            <div class="w-10 h-10 rounded-xl bg-pink-50 dark:bg-pink-500/10 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-pink-600 dark:text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <h3 class="text-sm font-bold text-gray-900 dark:text-white uppercase tracking-wider">Data Ibu</h3>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="nama_ibu" value="Nama Ibu" />
                                <x-text-input id="nama_ibu" name="nama_ibu" type="text" class="mt-1.5 block w-full" :value="old('nama_ibu', $ortu->nama_ibu)" placeholder="Masukkan nama ibu" maxlength="255" />
                                <x-input-error :messages="$errors->get('nama_ibu')" class="mt-1" />
                            </div>
                            <div>
                                <x-input-label for="nik_ibu" value="NIK Ibu" />
                                <x-text-input id="nik_ibu" name="nik_ibu" type="text" class="mt-1.5 block w-full" :value="old('nik_ibu', $ortu->nik_ibu)" placeholder="16 digit NIK" maxlength="16" pattern="[0-9]{16}" data-pattern-error="NIK harus 16 digit angka." />
                                <p class="mt-1 text-xs text-gray-400 dark:text-slate-500">16 karakter, angka saja</p>
                                <x-input-error :messages="$errors->get('nik_ibu')" class="mt-1" />
                            </div>
                            <div>
                                <x-input-label for="pekerjaan_ibu" value="Pekerjaan Ibu" />
                                <x-text-input id="pekerjaan_ibu" name="pekerjaan_ibu" type="text" class="mt-1.5 block w-full" :value="old('pekerjaan_ibu', $ortu->pekerjaan_ibu)" placeholder="Contoh: Ibu Rumah Tangga" maxlength="255" />
                                <x-input-error :messages="$errors->get('pekerjaan_ibu')" class="mt-1" />
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center gap-3 mb-5 pb-4 border-b border-gray-100 dark:border-slate-800">
                            <div class="w-10 h-10 rounded-xl bg-emerald-50 dark:bg-emerald-500/10 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <h3 class="text-sm font-bold text-gray-900 dark:text-white uppercase tracking-wider">Data Umum</h3>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="penghasilan" value="Penghasilan Orang Tua (per bulan)" />
                                <x-text-input id="penghasilan" name="penghasilan" type="number" class="mt-1.5 block w-full" :value="old('penghasilan', $ortu->penghasilan)" min="0" placeholder="Contoh: 3000000" />
                                <x-input-error :messages="$errors->get('penghasilan')" class="mt-1" />
                            </div>
                            <div>
                                <x-input-label for="no_hp" value="No. HP Orang Tua" />
                                <x-text-input id="no_hp" name="no_hp" type="text" class="mt-1.5 block w-full" :value="old('no_hp', $ortu->no_hp)" placeholder="Contoh: 081234567890" maxlength="20" pattern="[0-9]*" data-pattern-error="Nomor HP hanya boleh angka." />
                                <x-input-error :messages="$errors->get('no_hp')" class="mt-1" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-gray-100 dark:border-slate-800 flex flex-wrap items-center gap-3">
                    <x-primary-button>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Data Orang Tua
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
