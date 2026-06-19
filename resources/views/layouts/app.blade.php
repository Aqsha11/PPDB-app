<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ sidebarOpen: false }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@isset($header){{ $header }} | @endisset{{ config('app.name', 'PPDB') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="flex h-screen overflow-hidden">
        <x-admin.sidebar />
        <div class="flex flex-1 flex-col overflow-y-auto lg:ml-64">
            <x-admin.navbar />
            <main class="flex-1 px-4 sm:px-6 lg:px-8 py-6">
                <div class="max-w-7xl mx-auto">
                    @if(session('success'))
                        <div class="mb-4">
                            <x-alert type="success" :message="session('success')" />
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="mb-4">
                            <x-alert type="error" :message="session('error')" />
                        </div>
                    @endif
                    @if(session('warning'))
                        <div class="mb-4">
                            <x-alert type="warning" :message="session('warning')" />
                        </div>
                    @endif
                    @isset($header)
                        <div class="mb-6">
                            <h1 class="text-2xl font-bold text-gray-900">{{ $header }}</h1>
                        </div>
                    @endisset
                    {{ $slot }}
                </div>
            </main>
            <footer class="border-t bg-white px-6 py-4 text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} {{ config('app.name', 'PPDB') }}. All rights reserved.
            </footer>
        </div>
    </div>
    @stack('scripts')
</body>
</html>
