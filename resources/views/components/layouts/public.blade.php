<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@isset($title) {{ $title }} | @endisset{{ config('app.name', 'PPDB') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="font-sans antialiased">
    <nav x-data="{ open: false }" class="bg-white/80 backdrop-blur-lg border-b border-gray-200/60 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('public.beranda') }}" class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <div>
                            <span class="text-lg font-bold text-gray-900">{{ config('app.name', 'PPDB') }}</span>
                            <span class="hidden sm:inline text-xs text-gray-500 ml-1">Penerimaan Peserta Didik Baru</span>
                        </div>
                    </a>
                </div>
                <div class="hidden md:flex items-center space-x-1">
                    <a href="{{ route('public.beranda') }}" class="px-4 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('public.beranda') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }}">Beranda</a>
                    <a href="{{ route('public.berita.index') }}" class="px-4 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('public.berita*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }}">Berita</a>
                    <a href="{{ route('public.pengumuman.index') }}" class="px-4 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('public.pengumuman*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }}">Pengumuman</a>
                    <a href="{{ route('public.galeri.index') }}" class="px-4 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('public.galeri*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }}">Galeri</a>
                    <a href="{{ route('public.kontak.index') }}" class="px-4 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('public.kontak*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }}">Kontak</a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="ml-3 inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors shadow-sm">
                            Dashboard
                            <svg class="w-4 h-4 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="ml-3 inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors shadow-sm">
                            Masuk
                            <svg class="w-4 h-4 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                    @endauth
                </div>
                <div class="md:hidden flex items-center">
                    <button @click="open = !open" class="p-2 rounded-lg text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition-colors">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': !open}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <div :class="{'block': open, 'hidden': !open}" class="md:hidden border-t border-gray-200/60">
            <div class="px-4 py-3 space-y-1 bg-white/80 backdrop-blur-lg">
                <a href="{{ route('public.beranda') }}" class="block px-4 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('public.beranda') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-100' }}">Beranda</a>
                <a href="{{ route('public.berita.index') }}" class="block px-4 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('public.berita*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-100' }}">Berita</a>
                <a href="{{ route('public.pengumuman.index') }}" class="block px-4 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('public.pengumuman*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-100' }}">Pengumuman</a>
                <a href="{{ route('public.galeri.index') }}" class="block px-4 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('public.galeri*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-100' }}">Galeri</a>
                <a href="{{ route('public.kontak.index') }}" class="block px-4 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('public.kontak*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-100' }}">Kontak</a>
                <div class="pt-2">
                    @auth
                        <a href="{{ route('dashboard') }}" class="block w-full text-center px-4 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="block w-full text-center px-4 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">Masuk</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main>
        @if(session('success'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                <x-alert type="success" :message="session('success')" />
            </div>
        @endif
        @if(session('error'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                <x-alert type="error" :message="session('error')" />
            </div>
        @endif
        {{ $slot }}
    </main>

    <footer class="bg-gray-900 text-gray-400 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid md:grid-cols-4 gap-8">
                <div class="md:col-span-1">
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <span class="text-lg font-bold text-white">{{ config('app.name', 'PPDB') }}</span>
                    </div>
                    <p class="text-sm text-gray-400 leading-relaxed">Sistem Penerimaan Peserta Didik Baru secara online. Mudah, cepat, dan transparan.</p>
                    <div class="flex space-x-3 mt-4">
                        <a href="#" class="w-8 h-8 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-gray-700 transition-colors">
                            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                        </a>
                        <a href="#" class="w-8 h-8 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-gray-700 transition-colors">
                            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        </a>
                        <a href="#" class="w-8 h-8 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-gray-700 transition-colors">
                            <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg>
                        </a>
                    </div>
                </div>
                <div>
                    <h3 class="text-white font-semibold mb-4">Navigasi</h3>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="{{ route('public.beranda') }}" class="hover:text-white transition-colors">Beranda</a></li>
                        <li><a href="{{ route('public.berita.index') }}" class="hover:text-white transition-colors">Berita</a></li>
                        <li><a href="{{ route('public.pengumuman.index') }}" class="hover:text-white transition-colors">Pengumuman</a></li>
                        <li><a href="{{ route('public.galeri.index') }}" class="hover:text-white transition-colors">Galeri</a></li>
                        <li><a href="{{ route('public.kontak.index') }}" class="hover:text-white transition-colors">Kontak</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-white font-semibold mb-4">PPDB</h3>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="{{ route('login') }}" class="hover:text-white transition-colors">Login Pendaftar</a></li>
                        <li><a href="{{ route('register') }}" class="hover:text-white transition-colors">Daftar Akun</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-white font-semibold mb-4">Kontak</h3>
                    <ul class="space-y-2.5 text-sm">
                        <li class="flex items-start space-x-2">
                            <svg class="w-4 h-4 mt-0.5 shrink-0 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <span>info@sekolah.sch.id</span>
                        </li>
                        <li class="flex items-start space-x-2">
                            <svg class="w-4 h-4 mt-0.5 shrink-0 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            <span>(021) 12345678</span>
                        </li>
                        <li class="flex items-start space-x-2">
                            <svg class="w-4 h-4 mt-0.5 shrink-0 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span>Jl. Pendidikan No. 123, Jakarta</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-10 pt-8 text-center text-sm">
                <p>&copy; {{ date('Y') }} {{ config('app.name', 'PPDB') }}. All rights reserved.</p>
            </div>
        </div>
    </footer>
    @stack('scripts')
</body>
</html>