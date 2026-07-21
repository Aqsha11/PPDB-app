<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="sidebar()">
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
<body class="font-sans antialiased bg-gray-50 dark:bg-slate-950 text-gray-900 dark:text-slate-100" x-data="themeToggle()">
    <div class="flex h-screen overflow-hidden">
        <x-peserta.sidebar />

        <div x-show="mobileOpen" x-transition.opacity @click="closeMobile()" class="fixed inset-0 z-[60] bg-black/50 backdrop-blur-sm lg:hidden"></div>

        <div class="flex flex-1 flex-col overflow-hidden min-w-0 transition-all duration-300 ease-in-out" :style="desktop ? 'margin-left: ' + (collapsed ? '80px' : '272px') : 'margin-left: 0'">
            <header class="sticky top-0 z-30 glass border-b border-white/10 dark:border-white/5 shrink-0">
                <div class="flex items-center justify-between h-16 px-4 sm:px-6">
                    <div class="flex items-center gap-3">
                        <button @click="toggleSidebar()" class="flex items-center justify-center w-10 h-10 rounded-xl text-gray-500 hover:text-gray-700 dark:text-slate-400 dark:hover:text-white hover:bg-white/60 dark:hover:bg-white/10 transition-all duration-200" aria-label="Toggle menu">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </button>
                        <div class="hidden sm:block">
                            <span class="text-sm font-bold text-gray-900 dark:text-white">{{ $profil->nama_sekolah ?? config('app.name', 'PPDB') }}</span>
                            <p class="text-[10px] font-medium text-gray-400 dark:text-slate-500 uppercase tracking-wider">Portal Peserta</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <x-theme-toggle />
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto">
                <div class="max-w-4xl mx-auto px-4 sm:px-6 py-6 sm:py-8">
                    @if(session('success'))
                        <div class="mb-4 flex items-center gap-3 bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-200 dark:border-emerald-500/20 text-emerald-700 dark:text-emerald-400 rounded-xl px-4 py-3 animate-slide-up">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span class="text-sm font-medium">{{ session('success') }}</span>
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="mb-4 flex items-center gap-3 bg-red-50 dark:bg-red-500/10 border border-red-200 dark:border-red-500/20 text-red-700 dark:text-red-400 rounded-xl px-4 py-3 animate-slide-up">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span class="text-sm font-medium">{{ session('error') }}</span>
                        </div>
                    @endif
                    @if(session('warning'))
                        <div class="mb-4 flex items-center gap-3 bg-amber-50 dark:bg-amber-500/10 border border-amber-200 dark:border-amber-500/20 text-amber-700 dark:text-amber-400 rounded-xl px-4 py-3 animate-slide-up">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                            <span class="text-sm font-medium">{{ session('warning') }}</span>
                        </div>
                    @endif
                    @if(session('info'))
                        <div class="mb-4 flex items-center gap-3 bg-blue-50 dark:bg-blue-500/10 border border-blue-200 dark:border-blue-500/20 text-blue-700 dark:text-blue-400 rounded-xl px-4 py-3 animate-slide-up">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span class="text-sm font-medium">{{ session('info') }}</span>
                        </div>
                    @endif
                    @hasSection('header')
                        <div class="mb-6 animate-fade-in">
                            <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">@yield('header')</h1>
                        </div>
                    @endif
                    <div class="space-y-6">
                        @yield('content')
                    </div>
                </div>
            </main>

            <footer class="shrink-0 border-t border-gray-200/60 dark:border-slate-800 bg-gray-50 dark:bg-slate-900 px-6 py-4 text-center text-xs">
                <div class="flex flex-col sm:flex-row items-center justify-center gap-1.5">
                    &copy; {{ date('Y') }} {{ $profil->nama_sekolah ?? config('app.name', 'PPDB') }}. All rights reserved.
                </div>
                <div class="mt-1.5 flex items-center justify-center gap-1.5 text-gray-400 dark:text-slate-500">
                    <span>Powered by</span>
                    <a href="https://viteks.id/" target="_blank" rel="noopener" class="inline-flex items-center gap-1 font-semibold hover:opacity-80 transition-opacity">
                        <img src="https://viteks.id/storage/site/J5MNxOhayYQO9ENI3oFOxy0fQd50ll84bFpyFshl.png" alt="Viteks" class="h-4 w-auto">
                        <span style="color:#0ea5a0">VITEKS</span>
                    </a>
                </div>
            </footer>
        </div>
    </div>
    <x-peserta.chat-widget />
    @stack('scripts')
</body>
</html>
