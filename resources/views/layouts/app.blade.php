<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="sidebar()" data-admin>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@isset($header){{ $header }} | @endisset{{ config('app.name', 'PPDB') }}</title>
    @if(isset($profil) && $profil?->favicon)
        <link rel="icon" type="image/png" href="{{ Storage::url($profil->favicon) }}">
    @endif
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
    @stack('styles')
</head>
<body class="font-sans antialiased bg-gray-50 dark:bg-slate-900 text-gray-900 dark:text-slate-100" x-data="darkMode()">
    <div class="flex h-screen overflow-hidden">
        <x-admin.sidebar />
        <div x-show="mobileOpen" x-transition.opacity @click="mobileOpen = false" class="fixed inset-0 z-40 bg-black/50 backdrop-blur-sm lg:hidden"></div>
        <div class="flex flex-1 flex-col overflow-y-auto min-w-0 transition-all duration-300" :style="desktop ? 'margin-left: ' + (collapsed ? '80px' : '256px') : 'margin-left: 0'">
            <x-admin.navbar />
            <main class="flex-1 px-4 sm:px-6 lg:px-8 py-6 w-full" style="max-width:1600px;margin-left:auto;margin-right:auto">
                @if(session('success'))
                    <div class="mb-4 animate-slide-up">
                        <x-alert type="success" :message="session('success')" />
                    </div>
                @endif
                @if(session('error'))
                    <div class="mb-4 animate-slide-up">
                        <x-alert type="error" :message="session('error')" />
                    </div>
                @endif
                @if(session('warning'))
                    <div class="mb-4 animate-slide-up">
                        <x-alert type="warning" :message="session('warning')" />
                    </div>
                @endif
                {{ $slot }}
            </main>
            <footer class="border-t border-gray-100 dark:border-slate-700/50 bg-gray-50 dark:bg-slate-800/80 backdrop-blur-sm px-6 py-3 text-center text-xs">
                <div class="flex flex-col sm:flex-row items-center justify-center gap-1.5 text-gray-400 dark:text-slate-500">
                    &copy; {{ date('Y') }} {{ $profil->nama_sekolah ?? config('app.name', 'PPDB') }}. All rights reserved.
                    <span class="hidden sm:inline text-gray-300 dark:text-slate-600">·</span>
                    <span class="hidden sm:inline">Powered by</span>
                    <a href="https://viteks.id/" target="_blank" rel="noopener" class="inline-flex items-center gap-1 font-semibold hover:opacity-80 transition-opacity">
                        <img src="https://viteks.id/storage/site/J5MNxOhayYQO9ENI3oFOxy0fQd50ll84bFpyFshl.png" alt="Viteks" class="h-4 w-auto">
                        <span style="color:#0ea5a0">VITEKS</span>
                    </a>
                </div>
            </footer>
        </div>
    </div>
    <script>window.notifBaseUrl = '{{ url("admin/notifikasi") }}';</script>
    @stack('scripts')
</body>
</html>
