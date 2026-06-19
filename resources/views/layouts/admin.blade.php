<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ sidebarOpen: false }">
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
    <div class="flex h-screen overflow-hidden">
        <x-admin.sidebar />
        <div class="flex flex-1 flex-col overflow-y-auto lg:ml-64">
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
            <footer class="border-t bg-white px-6 py-4 text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} {{ config('app.name', 'PPDB') }}. All rights reserved.
            </footer>
        </div>
    </div>
    @stack('scripts')
</body>
</html>