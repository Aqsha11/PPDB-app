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
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
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
<body class="font-sans antialiased bg-gray-50 dark:bg-slate-900 text-gray-900 dark:text-slate-100" x-data="themeToggle()">
    <div class="min-h-screen flex flex-col">
        <header class="sticky top-0 z-40 bg-white dark:bg-slate-800 border-b border-gray-200 dark:border-slate-700">
            <div class="max-w-4xl mx-auto flex items-center justify-between h-16 px-4 sm:px-6">
                <a href="{{ route('peserta.dashboard') }}" class="flex items-center space-x-3">
                    @if(isset($profil) && $profil?->logo)
                        <img src="{{ Storage::url($profil->logo) }}" alt="{{ $profil->nama_sekolah }}" class="h-8 w-auto">
                    @else
                        <div class="w-8 h-8 theme-bg rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                    @endif
                    <span class="text-lg font-bold text-gray-900 dark:text-white hidden sm:block">{{ $profil->nama_sekolah ?? config('app.name', 'PPDB') }}</span>
                </a>

                <div class="flex items-center gap-2">
                    <x-theme-switcher />
                    <div class="relative" x-data="{ open: false }" @click.outside="open = false">
                        <button @click="open = !open" class="flex items-center space-x-2 p-1 rounded-lg hover:bg-gray-100 dark:hover:bg-slate-700 transition-colors">
                            <div class="w-8 h-8 rounded-full theme-bg flex items-center justify-center">
                                <span class="text-white font-bold text-sm">{{ substr(auth()->user()->name, 0, 1) }}</span>
                            </div>
                            <svg class="w-4 h-4 text-gray-400 dark:text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" x-transition class="absolute right-0 mt-2 w-56 bg-white dark:bg-slate-800 rounded-xl border border-gray-200 dark:border-slate-700 py-1 z-50">
                            <div class="px-4 py-3 border-b border-gray-100 dark:border-slate-700">
                                <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-gray-500 dark:text-slate-400">Peserta</p>
                            </div>
                            <a href="{{ route('peserta.profil.index') }}" class="flex items-center px-4 py-2.5 text-sm text-gray-700 dark:text-slate-300 hover:bg-gray-50 dark:hover:bg-slate-700/50 transition-colors">
                                <svg class="w-4 h-4 mr-3 text-gray-400 dark:text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Profil Saya
                            </a>
                            <hr class="my-1 border-gray-100 dark:border-slate-700">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex items-center w-full px-4 py-2.5 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-500/10 transition-colors">
                                    <svg class="w-4 h-4 mr-3 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-1">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 py-6 sm:py-8">
                @if(session('success'))
                    <x-alert type="success" :message="session('success')" />
                @endif
                @if(session('error'))
                    <x-alert type="error" :message="session('error')" />
                @endif
                @if(session('warning'))
                    <x-alert type="warning" :message="session('warning')" />
                @endif
                @if(session('info'))
                    <x-alert type="info" :message="session('info')" />
                @endif
                @hasSection('header')
                    <div class="mb-6">
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">@yield('header')</h1>
                    </div>
                @endif
                <div class="space-y-6">
                    @yield('content')
                </div>
            </div>
        </main>

        <footer class="border-t border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 px-6 py-4 text-center text-xs text-gray-500 dark:text-slate-400">
            <div class="flex flex-col sm:flex-row items-center justify-center gap-1.5">
                &copy; {{ date('Y') }} {{ $profil->nama_sekolah ?? config('app.name', 'PPDB') }}. All rights reserved.
            </div>
            <div class="mt-1.5 flex items-center justify-center gap-1.5">
                <span>Powered by</span>
                <a href="https://viteks.id/" target="_blank" rel="noopener" class="inline-flex items-center gap-1 font-semibold hover:opacity-80 transition-opacity">
                    <img src="https://viteks.id/storage/site/J5MNxOhayYQO9ENI3oFOxy0fQd50ll84bFpyFshl.png" alt="Viteks" class="h-4 w-auto">
                    <span style="color:#0ea5a0">VITEKS</span>
                </a>
            </div>
        </footer>
    </div>
    @stack('scripts')
</body>
</html>
