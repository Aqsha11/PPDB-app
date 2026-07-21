<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="sidebar()">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'PPDB') }} @isset($title) - {{ $title }} @endisset</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50">
    <script>window.adminSearchUrl = '{{ route("admin.search") }}';</script>
    <div class="flex h-screen overflow-hidden">
        <x-admin.sidebar />
        <div x-show="mobileOpen" x-transition.opacity @click="mobileOpen = false" class="fixed inset-0 z-40 bg-black/50 backdrop-blur-sm lg:hidden"></div>
        <div class="flex flex-1 flex-col overflow-y-auto min-w-0 transition-all duration-300" :style="desktop ? 'margin-left: ' + (collapsed ? '80px' : '256px') : 'margin-left: 0'">
            <x-admin.navbar />
            <main class="flex-1 p-4 sm:p-6 lg:p-8">
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
                @isset($header)
                    <div class="mb-6">
                        <h1 class="text-2xl font-bold text-gray-900">{{ $header }}</h1>
                    </div>
                @endisset
                {{ $slot }}
            </main>
            <footer class="border-t bg-gray-50 px-6 py-4 text-center text-xs">
                <div class="flex items-center justify-center gap-1.5 text-gray-500">
                    &copy; {{ date('Y') }} {{ config('app.name', 'PPDB') }}. All rights reserved.
                    <span class="text-gray-300">·</span>
                    <span>Powered by</span>
                    <a href="https://viteks.id/" target="_blank" rel="noopener" class="inline-flex items-center gap-1 font-semibold hover:opacity-80 transition-opacity">
                        <img src="https://viteks.id/storage/site/J5MNxOhayYQO9ENI3oFOxy0fQd50ll84bFpyFshl.png" alt="Viteks" class="h-4 w-auto">
                        <span style="color:#0ea5a0">VITEKS</span>
                    </a>
                </div>
            </footer>
        </div>
    </div>
    @stack('scripts')
</body>
</html>