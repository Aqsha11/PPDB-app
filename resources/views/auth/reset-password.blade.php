<x-guest-layout>
    <x-card>
        <div class="text-center mb-8">
            @if(isset($profil) && $profil?->logo)
                <div class="mx-auto mb-4">
                    <img src="{{ Storage::url($profil->logo) }}" alt="{{ $profil->nama_sekolah }}" class="h-20 w-auto mx-auto">
                </div>
            @endif
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Reset Kata Sandi</h2>
            <p class="mt-2 text-sm text-gray-500 dark:text-slate-400">Buat kata sandi baru untuk akun Anda</p>
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

        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div>
                <x-input-label for="email" value="Email" />
                <div class="mt-1.5">
                    <x-text-input id="email" class="block w-full rounded-lg bg-gray-50 dark:bg-slate-700" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" readonly />
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="password" value="Kata Sandi Baru" />
                <div class="mt-1.5">
                    <x-text-input id="password" class="block w-full rounded-lg" type="password" name="password" required autocomplete="new-password" placeholder="Min. 8 karakter" />
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="password_confirmation" value="Konfirmasi Kata Sandi" />
                <div class="mt-1.5">
                    <x-text-input id="password_confirmation" class="block w-full rounded-lg" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi kata sandi" />
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="mt-6">
                <x-primary-button class="w-full justify-center py-3">
                    Reset Kata Sandi
                </x-primary-button>
            </div>
        </form>
    </x-card>
</x-guest-layout>
