<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'PPDB') }} @isset($title) - {{ $title }} @endisset</title>
    @if(isset($profil) && $profil?->favicon)
        <link rel="icon" type="image/png" href="{{ Storage::url($profil->favicon) }}">
    @endif
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --warna-primary: {{ $profil->warna_primary ?? '#2563EB' }};
            --warna-second: {{ $profil->warna_second ?? '#7C3AED' }};
            --color-primary: {{ $profil->warna_primary ?? '#2563EB' }};
            --color-primary-rgb: {{ implode(', ', sscanf($profil->warna_primary ?? '#2563EB', '#%02x%02x%02x')) }};
            --color-second: {{ $profil->warna_second ?? '#7C3AED' }};
            --color-second-rgb: {{ implode(', ', sscanf($profil->warna_second ?? '#7C3AED', '#%02x%02x%02x')) }};
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50 dark:bg-slate-900" x-data="themeToggle()">
    <div class="min-h-screen flex">
        <div class="hidden lg:flex lg:w-[45%] relative overflow-hidden" style="background-color: var(--warna-primary)">
            <div class="relative flex flex-col justify-between px-10 py-10 w-full">
                <div class="flex items-center space-x-3">
                    @if(isset($profil) && $profil?->logo)
                        <img src="{{ Storage::url($profil->logo) }}" alt="{{ $profil->nama_sekolah }}" class="h-14 w-auto">
                    @else
                        <div class="w-14 h-14 rounded-2xl flex items-center justify-center" style="background-color: color-mix(in srgb, var(--warna-primary) 80%, black)">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                    @endif
                    <div>
                        <h2 class="text-xl font-bold text-white">{{ $profil->nama_sekolah ?? config('app.name', 'PPDB') }}</h2>
                        <p class="text-sm" style="color: rgba(255,255,255,0.8)">Penerimaan Peserta Didik Baru</p>
                    </div>
                </div>

                <div class="flex-1 flex flex-col justify-center">
                    <h1 class="text-4xl font-bold text-white leading-tight">
                        Selamat Datang di<br>
                        <span class="text-white">{{ $profil->nama_sekolah ?? 'PPDB Online' }}</span>
                    </h1>
                    <p class="mt-5 text-lg max-w-md leading-relaxed" style="color: rgba(255,255,255,0.8)">
                        Sistem Penerimaan Peserta Didik Baru secara online. Mudah, cepat, dan transparan.
                    </p>
                    <div class="mt-10 space-y-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0" style="background-color: color-mix(in srgb, var(--warna-primary) 70%, white)">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <span class="text-sm" style="color: rgba(255,255,255,0.9)">Pendaftaran online 100% tanpa kertas</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0" style="background-color: color-mix(in srgb, var(--warna-primary) 70%, white)">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <span class="text-sm" style="color: rgba(255,255,255,0.9)">Pantau status pendaftaran secara real-time</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0" style="background-color: color-mix(in srgb, var(--warna-primary) 70%, white)">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <span class="text-sm" style="color: rgba(255,255,255,0.9)">Informasi lengkap dan transparan</span>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="w-12 h-[2px] rounded-full mb-4" style="background-color: rgba(255,255,255,0.4)"></div>
                    <p class="text-xs" style="color: rgba(255,255,255,0.6)">&copy; {{ date('Y') }} {{ $profil->nama_sekolah ?? config('app.name', 'PPDB') }}. All rights reserved.</p>
                    <p class="text-xs mt-1 flex items-center gap-1" style="color: rgba(255,255,255,0.4)">
                        Powered by
                        <a href="https://viteks.id/" target="_blank" rel="noopener" class="inline-flex items-center gap-1 font-semibold hover:opacity-90 transition-opacity">
                            <img src="https://viteks.id/storage/site/J5MNxOhayYQO9ENI3oFOxy0fQd50ll84bFpyFshl.png" alt="Viteks" class="h-3.5 w-auto" style="filter:brightness(10);">
                            <span style="color:#0ea5a0">VITEKS</span>
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <div class="flex-1 flex flex-col items-center justify-center px-5 sm:px-12 lg:px-16 bg-gray-50 dark:bg-slate-900">
            <div class="lg:hidden mb-8 text-center">
                <div class="inline-flex items-center space-x-3">
                    @if(isset($profil) && $profil?->logo)
                        <img src="{{ Storage::url($profil->logo) }}" alt="{{ $profil->nama_sekolah }}" class="h-12 w-auto">
                    @else
                        <div class="w-12 h-12 rounded-2xl flex items-center justify-center theme-bg">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                    @endif
                    <div class="text-left">
                        <span class="text-lg font-bold text-gray-900 dark:text-white block leading-tight">{{ $profil->nama_sekolah ?? config('app.name', 'PPDB') }}</span>
                        <span class="text-xs text-gray-400 dark:text-slate-500">PPDB Online</span>
                    </div>
                </div>
            </div>
            <div class="w-full max-w-md mx-auto">
                {{ $slot }}
            </div>
            <div class="mt-8 flex flex-col items-center gap-4">
                <x-theme-toggle />
                <p class="text-center text-xs text-gray-400 dark:text-slate-500 lg:hidden">
                    &copy; {{ date('Y') }} {{ $profil->nama_sekolah ?? config('app.name', 'PPDB') }}. All rights reserved.
                </p>
                <p class="text-center text-xs text-gray-400 dark:text-slate-500 lg:hidden flex items-center justify-center gap-1">
                    Powered by
                    <a href="https://viteks.id/" target="_blank" rel="noopener" class="inline-flex items-center gap-1 font-semibold hover:opacity-80 transition-opacity">
                        <img src="https://viteks.id/storage/site/J5MNxOhayYQO9ENI3oFOxy0fQd50ll84bFpyFshl.png" alt="Viteks" class="h-3.5 w-auto">
                        <span style="color:#0ea5a0">VITEKS</span>
                    </a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
