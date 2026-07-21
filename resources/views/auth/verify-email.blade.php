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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Verifikasi Email Anda</h2>
            <p class="mt-3 text-sm text-gray-500 dark:text-slate-400 leading-relaxed">
                Terima kasih telah mendaftar! Sebelum memulai, silakan verifikasi alamat email Anda dengan mengklik tautan yang telah kami kirimkan.
            </p>
            <p class="mt-2 text-sm text-gray-500 dark:text-slate-400">
                Jika tidak menerima email, kami akan dengan senang hati mengirimkan ulang.
            </p>
        </div>

        @if (session('status') == 'verification-link-sent')
            <x-alert type="success" message="Tautan verifikasi baru telah dikirim ke alamat email yang Anda daftarkan." />
        @endif

        <div class="mt-6 space-y-3">
            <form method="POST" action="{{ route('verification.send') }}" class="w-full">
                @csrf
                <x-primary-button class="w-full justify-center py-3">
                    Kirim Ulang Email Verifikasi
                </x-primary-button>
            </form>

            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <x-secondary-button type="submit" class="w-full justify-center py-3">
                    Keluar
                </x-secondary-button>
            </form>
        </div>
    </x-card>
</x-guest-layout>
