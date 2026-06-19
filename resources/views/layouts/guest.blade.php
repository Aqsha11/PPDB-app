<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'PPDB') }} @isset($title) - {{ $title }} @endisset</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen flex">
        <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 relative overflow-hidden">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-10 left-10 w-72 h-72 bg-white rounded-full blur-3xl"></div>
                <div class="absolute bottom-10 right-10 w-96 h-96 bg-indigo-300 rounded-full blur-3xl"></div>
            </div>
            <div class="relative flex flex-col justify-center px-12 py-12">
                <div class="flex items-center space-x-3 mb-8">
                    <div class="w-12 h-12 bg-white/20 backdrop-blur rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-white">{{ config('app.name', 'PPDB') }}</h2>
                        <p class="text-blue-200 text-sm">Penerimaan Peserta Didik Baru</p>
                    </div>
                </div>
                <h1 class="text-4xl font-bold text-white leading-tight">Selamat Datang di<br>PPDB Online</h1>
                <p class="mt-4 text-lg text-blue-200 max-w-md">Sistem Penerimaan Peserta Didik Baru secara online. Mudah, cepat, dan transparan.</p>
                <div class="mt-12 space-y-4">
                    <div class="flex items-center space-x-3 text-white">
                        <svg class="w-5 h-5 text-blue-300 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span class="text-blue-100">Pendaftaran online 100% tanpa kertas</span>
                    </div>
                    <div class="flex items-center space-x-3 text-white">
                        <svg class="w-5 h-5 text-blue-300 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span class="text-blue-100">Pantau status pendaftaran secara real-time</span>
                    </div>
                    <div class="flex items-center space-x-3 text-white">
                        <svg class="w-5 h-5 text-blue-300 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span class="text-blue-100">Informasi lengkap dan transparan</span>
                    </div>
                </div>
                <div class="mt-auto pt-16">
                    <p class="text-blue-300 text-sm">&copy; {{ date('Y') }} {{ config('app.name', 'PPDB') }}. All rights reserved.</p>
                </div>
            </div>
        </div>
        <div class="flex-1 flex flex-col justify-center px-6 sm:px-12 lg:px-16 bg-gray-50">
            <div class="lg:hidden mb-8 text-center">
                <div class="inline-flex items-center space-x-2">
                    <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-gray-900">{{ config('app.name', 'PPDB') }}</span>
                </div>
                <p class="mt-1 text-sm text-gray-500">Penerimaan Peserta Didik Baru</p>
            </div>
            <div class="w-full max-w-sm mx-auto">
                {{ $slot }}
            </div>
            <p class="mt-8 text-center text-xs text-gray-400 lg:hidden">
                &copy; {{ date('Y') }} {{ config('app.name', 'PPDB') }}. All rights reserved.
            </p>
        </div>
    </div>
</body>
</html>