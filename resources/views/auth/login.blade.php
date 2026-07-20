<x-guest-layout>
    <x-card>
        <div class="text-center mb-8">
            @if(isset($profil) && $profil?->logo)
                <div class="mx-auto mb-4">
                    <img src="{{ Storage::url($profil->logo) }}" alt="{{ $profil->nama_sekolah }}" class="h-20 w-auto mx-auto">
                </div>
            @endif
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Masuk ke Akun Anda</h2>
            <p class="mt-2 text-sm text-gray-500 dark:text-slate-400">Silakan masuk untuk melanjutkan</p>
        </div>

        @if(!$periodeAktif)
            <x-alert type="warning" message="Saat ini tidak ada periode PPDB yang aktif." />
        @endif

        <x-auth-session-status class="mb-4" :status="session('status')" />

        @if ($errors->any())
            <div class="mb-5 p-4 rounded-xl bg-red-50 border border-red-200 text-sm text-red-600">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-input-label for="email" value="Email" />
                <div class="mt-1.5">
                    <x-text-input id="email" class="block w-full rounded-lg" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="nama@email.com" />
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="password" value="Kata Sandi" />
                <div class="mt-1.5">
                    <x-text-input id="password" class="block w-full rounded-lg" type="password" name="password" required autocomplete="current-password" placeholder="Masukkan kata sandi" />
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="flex items-center justify-between mt-5">
                <label for="remember_me" class="flex items-center cursor-pointer">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 theme-text focus:theme-ring" name="remember">
                    <span class="ml-2 text-sm text-gray-600 dark:text-slate-400">Ingat saya</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm font-medium theme-text hover:opacity-80" href="{{ route('password.request') }}">
                        Lupa kata sandi?
                    </a>
                @endif
            </div>

            <div class="mt-6">
                <x-primary-button class="w-full justify-center py-3">
                    Masuk
                </x-primary-button>
            </div>
        </form>

        @if($periodeAktif)
            <p class="mt-6 text-center text-sm text-gray-500 dark:text-slate-400">
                Belum punya akun?
                <a href="{{ route('register') }}" class="font-semibold theme-text hover:opacity-80">Daftar sekarang</a>
            </p>
        @endif
    </x-card>
</x-guest-layout>
