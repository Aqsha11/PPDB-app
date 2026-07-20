<x-guest-layout>
    <x-card>
        <div class="text-center mb-8">
            @if(isset($profil) && $profil?->logo)
                <div class="mx-auto mb-4">
                    <img src="{{ Storage::url($profil->logo) }}" alt="{{ $profil->nama_sekolah }}" class="h-20 w-auto mx-auto">
                </div>
            @endif
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Lupa Kata Sandi</h2>
            <p class="mt-2 text-sm text-gray-500 dark:text-slate-400 leading-relaxed">
                Masukkan email Anda dan kami akan mengirimkan tautan reset kata sandi
            </p>
        </div>

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

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div>
                <x-input-label for="email" value="Email" />
                <div class="mt-1.5">
                    <x-text-input id="email" class="block w-full rounded-lg" type="email" name="email" :value="old('email')" required autofocus placeholder="nama@email.com" />
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mt-6">
                <x-primary-button class="w-full justify-center py-3">
                    Kirim Tautan Reset
                </x-primary-button>
            </div>
        </form>

        <p class="mt-6 text-center text-sm">
            <a href="{{ route('login') }}" class="font-medium theme-text hover:opacity-80 inline-flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali ke halaman masuk
            </a>
        </p>
    </x-card>
</x-guest-layout>
