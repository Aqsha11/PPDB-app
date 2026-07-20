@php
    $breadcrumb = [
        ['label' => 'Profil Saya'],
    ];
@endphp

<x-app-layout>
    <div class="py-6 max-w-3xl mx-auto space-y-6">
        <div class="flex items-center gap-3 mb-2">
            <div class="w-10 h-10 rounded-xl bg-blue-600 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </div>
            <div>
                <h1 class="text-xl font-bold text-gray-900 dark:text-white">Profil Saya</h1>
                <p class="text-sm text-gray-500 dark:text-slate-400">Kelola informasi akun Anda</p>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-xl">
            <div class="px-4 sm:px-6 py-4 border-b border-gray-200 dark:border-slate-700">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <h2 class="text-base font-semibold text-gray-900 dark:text-white">Informasi Profil</h2>
                </div>
                <p class="text-sm text-gray-500 dark:text-slate-400 mt-1">Perbarui informasi profil dan alamat email akun Anda.</p>
            </div>
            <div class="p-4 sm:p-6">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-xl">
            <div class="px-4 sm:px-6 py-4 border-b border-gray-200 dark:border-slate-700">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    <h2 class="text-base font-semibold text-gray-900 dark:text-white">Ubah Kata Sandi</h2>
                </div>
                <p class="text-sm text-gray-500 dark:text-slate-400 mt-1">Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar tetap aman.</p>
            </div>
            <div class="p-4 sm:p-6">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-xl">
            <div class="px-4 sm:px-6 py-4 border-b border-gray-200 dark:border-slate-700">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    <h2 class="text-base font-semibold text-gray-900 dark:text-white">Hapus Akun</h2>
                </div>
                <p class="text-sm text-gray-500 dark:text-slate-400 mt-1">Hapus akun Anda secara permanen. Semua data akan dihapus dan tidak dapat dikembalikan.</p>
            </div>
            <div class="p-4 sm:p-6">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
