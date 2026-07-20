<x-guest-layout>
    <x-card>
        <div class="text-center mb-8">
            @if(isset($profil) && $profil?->logo)
                <div class="mx-auto mb-4">
                    <img src="{{ Storage::url($profil->logo) }}" alt="{{ $profil->nama_sekolah }}" class="h-20 w-auto mx-auto">
                </div>
            @endif
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Daftar Akun Baru</h2>
            <p class="mt-2 text-sm text-gray-500 dark:text-slate-400">Isi data diri Anda untuk mendaftar</p>
        </div>

        @if(!$periodeAktif)
            <x-alert type="warning" message="Saat ini pendaftaran sedang ditutup. Silakan hubungi sekolah untuk informasi jadwal pendaftaran selanjutnya." />
        @endif

        @if ($errors->any())
            <div class="mb-5 p-4 rounded-xl bg-red-50 border border-red-200 text-sm text-red-600">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" @if(!$periodeAktif) x-data aria-disabled="true" @endif>
            @csrf

            <div>
                <x-input-label for="name" value="Nama Lengkap" />
                <div class="mt-1.5">
                    <x-text-input id="name" class="block w-full rounded-lg" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Nama lengkap Anda" :disabled="!$periodeAktif" />
                </div>
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="email" value="Email" />
                <div class="mt-1.5">
                    <x-text-input id="email" class="block w-full rounded-lg" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="nama@email.com" :disabled="!$periodeAktif" />
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mt-4" x-data="passwordValidator()">
                <x-input-label for="password" value="Kata Sandi" />
                <div class="mt-1.5">
                    <x-text-input id="password" class="block w-full rounded-lg" type="password" name="password" x-model="password" required autocomplete="new-password" placeholder="Masukkan kata sandi" :disabled="!$periodeAktif" />
                </div>
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

            <div class="mt-4">
                <x-input-label for="password_confirmation" value="Konfirmasi Kata Sandi" />
                <div class="mt-1.5">
                    <x-text-input id="password_confirmation" class="block w-full rounded-lg" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi kata sandi" :disabled="!$periodeAktif" />
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="mt-6">
                <x-primary-button class="w-full justify-center py-3" :disabled="!$periodeAktif">
                    Daftar
                </x-primary-button>
            </div>
        </form>

        <p class="mt-6 text-center text-sm text-gray-500 dark:text-slate-400">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="font-semibold theme-text hover:opacity-80">Masuk</a>
        </p>
    </x-card>
</x-guest-layout>
