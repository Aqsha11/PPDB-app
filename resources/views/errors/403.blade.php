<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $exception->getMessage() ?: 'Akses Ditolak' }} - {{ config('app.name', 'PPDB') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --warna-primary: {{ $profil->warna_primary ?? '#2563EB' }};
            --warna-second: {{ $profil->warna_second ?? '#7C3AED' }};
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50 dark:bg-slate-900 flex items-center justify-center min-h-screen px-6">
    <div class="text-center max-w-md">
        <div class="w-24 h-24 rounded-3xl mx-auto mb-6 flex items-center justify-center bg-red-50 border border-red-200 dark:bg-red-500/10 dark:border-red-500/30">
            <svg class="w-12 h-12 text-red-500 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
        </div>
        <h1 class="text-6xl font-bold text-gray-900 dark:text-white mb-3">403</h1>
        <h2 class="text-xl font-semibold text-gray-700 dark:text-slate-300 mb-3">Akses Ditolak</h2>
        <p class="text-gray-500 dark:text-slate-400 mb-8 leading-relaxed">{{ $exception->getMessage() ?: 'Anda tidak memiliki akses ke halaman ini.' }}</p>
        @auth
            @php $role = auth()->user()->roles->first()->name ?? ''; @endphp
            @if($role === 'Peserta')
                <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                    <a href="{{ route('peserta.biodata.edit') }}" class="inline-flex items-center px-6 py-3 rounded-lg text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                        Lengkapi Biodata
                    </a>
                    <a href="{{ route('peserta.dashboard') }}" class="inline-flex items-center px-6 py-3 bg-white dark:bg-slate-800 border border-gray-300 dark:border-slate-600 rounded-lg text-sm font-semibold text-gray-700 dark:text-slate-300 hover:bg-gray-50 dark:hover:bg-slate-700 transition-colors">
                        Dashboard
                    </a>
                </div>
            @else
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-6 py-3 rounded-lg text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                    Dashboard Admin
                </a>
            @endif
        @else
            <a href="{{ url('/') }}" class="inline-flex items-center px-6 py-3 rounded-lg text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                Kembali ke Beranda
            </a>
        @endauth
    </div>
</body>
</html>
