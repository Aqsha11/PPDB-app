<x-guest-layout>
    <x-card>
        <div class="text-center mb-8">
            @if(isset($profil) && $profil?->logo)
                <div class="mx-auto mb-4">
                    <img src="{{ Storage::url($profil->logo) }}" alt="{{ $profil->nama_sekolah }}" class="h-20 w-auto mx-auto">
                </div>
            @endif
            <div class="w-16 h-16 rounded-2xl mx-auto mb-4 flex items-center justify-center theme-bg">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Konfirmasi Kata Sandi</h2>
            <p class="mt-3 text-sm text-gray-500 dark:text-slate-400 leading-relaxed">
                Ini adalah area aman aplikasi. Harap konfirmasi kata sandi Anda sebelum melanjutkan.
            </p>
        </div>

        @if ($errors->any())
            <div class="mb-5 p-4 rounded-xl bg-red-50 border border-red-200 text-sm text-red-600">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <div>
                <x-input-label for="password" value="Kata Sandi" />
                <div class="mt-1.5">
                    <x-text-input id="password" class="block w-full rounded-lg" type="password" name="password" required autocomplete="current-password" placeholder="Masukkan kata sandi Anda" />
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="mt-6">
                <x-primary-button class="w-full justify-center py-3">
                    Konfirmasi
                </x-primary-button>
            </div>
        </form>
    </x-card>
</x-guest-layout>
