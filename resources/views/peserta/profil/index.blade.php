@extends('layouts.peserta')

@section('header', 'Profil Saya')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-1 animate-fade-in">
            <x-card>
                <div class="text-center py-8">
                    @if($peserta && $peserta->pas_foto)
                        <img src="{{ Storage::url($peserta->pas_foto) }}" alt="{{ $user->name }}" class="w-20 h-20 rounded-2xl object-cover mx-auto shadow-lg">
                    @else
                        <div class="w-20 h-20 rounded-2xl flex items-center justify-center mx-auto theme-bg">
                            <span class="text-white font-extrabold text-2xl">{{ substr($user->name, 0, 1) }}</span>
                        </div>
                    @endif
                    <h3 class="mt-4 text-lg font-extrabold text-gray-900 dark:text-white">{{ $user->name }}</h3>
                    <p class="text-sm text-gray-500 dark:text-slate-400">{{ $user->email }}</p>
                    <div class="mt-3">
                        <x-badge color="blue">Peserta</x-badge>
                    </div>
                </div>
            </x-card>
        </div>

        <div class="lg:col-span-2 space-y-6">
            <div class="animate-fade-in" style="animation-delay: 0.1s">
                <x-card>
                    <div class="flex items-center gap-3 mb-5 pb-4 border-b border-gray-100 dark:border-slate-800">
                        <div class="w-11 h-11 rounded-xl theme-bg flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-gray-900 dark:text-white">Informasi Profil</h3>
                            <p class="text-xs text-gray-500 dark:text-slate-400">Perbarui informasi profil Anda</p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('peserta.profil.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="space-y-4">
                            <div>
                                <x-input-label for="name" value="Nama Lengkap" />
                                <x-text-input id="name" name="name" type="text" class="mt-1.5 block w-full" :value="old('name', $user->name)" placeholder="Masukkan nama lengkap" required />
                                <x-input-error :messages="$errors->get('name')" class="mt-1" />
                            </div>
                            <div>
                                <x-input-label for="email" value="Email" />
                                <x-text-input id="email" name="email" type="email" class="mt-1.5 block w-full" :value="old('email', $user->email)" placeholder="nama@email.com" required />
                                <x-input-error :messages="$errors->get('email')" class="mt-1" />
                            </div>
                        </div>

                        <div class="mt-6 pt-4 border-t border-gray-100 dark:border-slate-800">
                            <x-primary-button>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Simpan Profil
                            </x-primary-button>
                        </div>
                    </form>
                </x-card>
            </div>

            <div class="animate-fade-in" style="animation-delay: 0.2s">
                <x-card>
                    <div class="flex items-center gap-3 mb-5 pb-4 border-b border-gray-100 dark:border-slate-800">
                        <div class="w-11 h-11 rounded-xl bg-amber-50 dark:bg-amber-500/10 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-gray-900 dark:text-white">Ganti Password</h3>
                            <p class="text-xs text-gray-500 dark:text-slate-400">Pastikan menggunakan password yang kuat</p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('peserta.profil.password') }}">
                        @csrf
                        @method('PUT')

                        <div class="space-y-4">
                            <div>
                                <x-input-label for="current_password" value="Password Saat Ini" />
                                <x-text-input id="current_password" name="current_password" type="password" class="mt-1.5 block w-full" placeholder="Masukkan password saat ini" required />
                                <x-input-error :messages="$errors->get('current_password')" class="mt-1" />
                            </div>
                            <div x-data="passwordValidator()">
                                <x-input-label for="password" value="Password Baru" />
                                <x-text-input id="password" name="password" type="password" class="mt-1.5 block w-full" x-model="password" placeholder="Masukkan password baru" required />
                                <div class="mt-2 space-y-1.5">
                                    <div class="flex items-center gap-2 text-xs" :class="length ? 'text-green-600 dark:text-green-400' : 'text-gray-400 dark:text-slate-500'">
                                        <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path x-show="length" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/><circle x-show="!length" cx="12" cy="12" r="9" stroke-width="2"/></svg>
                                        <span>Minimal 8 karakter</span>
                                    </div>
                                    <div class="flex items-center gap-2 text-xs" :class="uppercase ? 'text-green-600 dark:text-green-400' : 'text-gray-400 dark:text-slate-500'">
                                        <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path x-show="uppercase" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/><circle x-show="!uppercase" cx="12" cy="12" r="9" stroke-width="2"/></svg>
                                        <span>Huruf kapital (A-Z)</span>
                                    </div>
                                    <div class="flex items-center gap-2 text-xs" :class="number ? 'text-green-600 dark:text-green-400' : 'text-gray-400 dark:text-slate-500'">
                                        <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path x-show="number" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/><circle x-show="!number" cx="12" cy="12" r="9" stroke-width="2"/></svg>
                                        <span>Angka (0-9)</span>
                                    </div>
                                    <div class="flex items-center gap-2 text-xs" :class="symbol ? 'text-green-600 dark:text-green-400' : 'text-gray-400 dark:text-slate-500'">
                                        <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path x-show="symbol" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/><circle x-show="!symbol" cx="12" cy="12" r="9" stroke-width="2"/></svg>
                                        <span>Simbol @</span>
                                    </div>
                                    <div x-show="password.length > 0" class="flex items-center gap-2 mt-1">
                                        <div class="flex-1 h-1.5 bg-gray-200 dark:bg-slate-700 rounded-full overflow-hidden">
                                            <div class="h-full rounded-full transition-all duration-300" :class="strengthColor" :style="'width:' + (strength * 25) + '%'"></div>
                                        </div>
                                        <span class="text-xs font-medium" :class="strength === 4 ? 'text-green-600 dark:text-green-400' : 'text-gray-400 dark:text-slate-500'" x-text="strengthLabel"></span>
                                    </div>
                                </div>
                                <x-input-error :messages="$errors->get('password')" class="mt-1" />
                            </div>
                            <div>
                                <x-input-label for="password_confirmation" value="Konfirmasi Password Baru" />
                                <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1.5 block w-full" placeholder="Ulangi password baru" required />
                            </div>
                        </div>

                        <div class="mt-6 pt-4 border-t border-gray-100 dark:border-slate-800">
                            <x-primary-button>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                                Perbarui Password
                            </x-primary-button>
                        </div>
                    </form>
                </x-card>
            </div>
        </div>
    </div>
@endsection
