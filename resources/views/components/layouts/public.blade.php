<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@isset($title) {{ $title }} | @endisset{{ config('app.name', 'PPDB') }}</title>
    @if(isset($profil) && $profil?->favicon)
        <link rel="icon" type="image/png" href="{{ Storage::url($profil->favicon) }}">
    @endif
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700;plus-ralato:wght@400;700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
<body class="font-sans antialiased bg-gray-50 dark:bg-slate-950 text-gray-900 dark:text-slate-100" x-data="themeToggle()">

    {{-- TOP BAR --}}
    <div class="bg-gray-900 dark:bg-black text-gray-400 text-xs border-b border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-10">
                <div class="flex items-center gap-5">
                    @if($profil?->telepon)
                        <a href="tel:{{ $profil->telepon }}" class="flex items-center gap-1.5 hover:text-white transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            {{ $profil->telepon }}
                        </a>
                    @endif
                    @if($profil?->email)
                        <a href="mailto:{{ $profil->email }}" class="hidden sm:flex items-center gap-1.5 hover:text-white transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            {{ $profil->email }}
                        </a>
                    @endif
                </div>
                <div class="hidden sm:flex items-center gap-3">
                    @forelse($mediaSosial as $media)
                        <a href="{{ $media->url }}" target="_blank" rel="noopener" class="hover:text-white transition-colors" title="{{ $media->platform }}">
                            <i class="{!! $media->icon !!} text-sm"></i>
                        </a>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    {{-- NAVBAR --}}
    <nav x-data="{ menuOpen: false, scrolled: false }"
         x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 10 })"
         :class="scrolled ? 'bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl shadow-lg shadow-black/[0.03] dark:shadow-black/20 border-b border-gray-200/50 dark:border-slate-800/50' : 'bg-white dark:bg-slate-900 border-b border-gray-100 dark:border-slate-800'"
         class="sticky top-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 lg:h-[68px]">
                {{-- Logo --}}
                <div class="flex items-center">
                    <a href="{{ route('public.beranda') }}" class="flex items-center gap-3 group">
                        @if($profil?->logo)
                            <img src="{{ Storage::url($profil->logo) }}" alt="{{ $profil->nama_sekolah }}" class="h-9 lg:h-10 w-auto rounded-xl transition-transform group-hover:scale-105">
                        @else
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center transition-transform group-hover:scale-105 theme-bg">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                        @endif
                        <div class="flex flex-col">
                            <span class="text-lg font-bold text-gray-900 dark:text-white leading-tight tracking-tight">{{ $profil->nama_sekolah ?? config('app.name', 'PPDB') }}</span>
                            <span class="hidden sm:inline text-[10px] text-gray-400 dark:text-slate-500 font-semibold tracking-widest uppercase">PPDB Online</span>
                        </div>
                    </a>
                </div>

                {{-- Desktop Nav --}}
                <div class="hidden lg:flex items-center space-x-1">
                    @php
                        $navItems = [
                            ['route' => 'public.beranda', 'label' => 'Beranda'],
                            ['route' => 'public.berita.index', 'label' => 'Berita'],
                            ['route' => 'public.pengumuman.index', 'label' => 'Pengumuman'],
                            ['route' => 'public.galeri.index', 'label' => 'Galeri'],
                            ['route' => 'public.kontak.index', 'label' => 'Kontak'],
                        ];
                    @endphp
                    @foreach($navItems as $item)
                        @php $isActive = request()->routeIs($item['route'] === 'public.beranda' ? $item['route'] : $item['route'] . '*'); @endphp
                        <a href="{{ route($item['route']) }}"
                           class="relative px-4 py-2 text-[13px] font-semibold rounded-full transition-all duration-200 {{ $isActive ? 'text-white' : 'text-gray-600 hover:text-gray-900 dark:text-slate-400 dark:hover:text-white' }}"
                           @if($isActive) style="background-color: var(--warna-primary)" @endif>
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                    <div class="w-px h-5 bg-gray-200 dark:bg-slate-700 mx-2"></div>
                    <x-theme-toggle />
                    @auth
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-1.5 px-5 py-2.5 btn-theme text-sm font-semibold rounded-full transition-all duration-200 hover:shadow-lg hover:shadow-primary-500/25 hover:-translate-y-0.5">
                            Dashboard
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="inline-flex items-center gap-1.5 px-5 py-2.5 btn-theme text-sm font-semibold rounded-full transition-all duration-200 hover:shadow-lg hover:shadow-primary-500/25 hover:-translate-y-0.5">
                            Masuk
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1z" /></svg>
                        </a>
                        <a href="{{ route('register') }}" class="inline-flex items-center gap-1.5 px-5 py-2.5 border-2 text-sm font-semibold rounded-full transition-all duration-200 hover:shadow-lg hover:-translate-y-0.5" style="border-color: var(--warna-primary); color: var(--warna-primary)">
                            Daftar
                        </a>
                    @endauth
                </div>

                {{-- Mobile Toggle --}}
                <div class="lg:hidden flex items-center gap-2">
                    <x-theme-toggle />
                    <button @click="menuOpen = !menuOpen" class="p-2 rounded-xl text-gray-600 dark:text-slate-300 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-slate-800 transition-colors">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path :class="{'hidden': menuOpen, 'inline-flex': !menuOpen}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': !menuOpen, 'inline-flex': menuOpen}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Mobile Sidebar Overlay --}}
        <div x-show="menuOpen" x-transition.opacity @click="menuOpen = false" class="fixed inset-0 z-[60] bg-black/40 backdrop-blur-sm lg:hidden"></div>

        {{-- Mobile Sidebar --}}
        <div x-show="menuOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full" class="fixed top-0 right-0 z-[70] h-full w-72 bg-white dark:bg-slate-900 shadow-2xl border-l border-gray-100 dark:border-slate-800 overflow-y-auto lg:hidden" @click.outside="menuOpen = false">
            <div class="p-5 border-b border-gray-100 dark:border-slate-800">
                <div class="flex items-center justify-between">
                    <a href="{{ route('public.beranda') }}" class="flex items-center space-x-3" @click="menuOpen = false">
                        @if($profil?->logo)
                            <img src="{{ Storage::url($profil->logo) }}" alt="{{ $profil->nama_sekolah }}" class="h-8 w-auto rounded-lg">
                        @else
                            <div class="w-8 h-8 rounded-lg flex items-center justify-center theme-bg">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                        @endif
                        <div class="flex flex-col">
                            <span class="text-sm font-bold text-gray-900 dark:text-white leading-tight">{{ $profil->nama_sekolah ?? config('app.name', 'PPDB') }}</span>
                            <span class="text-[10px] text-gray-400 dark:text-slate-500 uppercase tracking-wider font-semibold">PPDB Online</span>
                        </div>
                    </a>
                    <button @click="menuOpen = false" class="flex items-center justify-center w-9 h-9 text-gray-400 hover:text-gray-600 dark:hover:text-white rounded-xl hover:bg-gray-100 dark:hover:bg-slate-800 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
            <nav class="p-3 space-y-1">
                @php
                    $mobileNavItems = [
                        ['route' => 'public.beranda', 'label' => 'Beranda', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>'],
                        ['route' => 'public.berita.index', 'label' => 'Berita', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>'],
                        ['route' => 'public.pengumuman.index', 'label' => 'Pengumuman', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>'],
                        ['route' => 'public.galeri.index', 'label' => 'Galeri', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>'],
                        ['route' => 'public.kontak.index', 'label' => 'Kontak', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>'],
                    ];
                @endphp
                @foreach($mobileNavItems as $item)
                    @php $isActive = request()->routeIs($item['route'] === 'public.beranda' ? $item['route'] : $item['route'] . '*'); @endphp
                    <a href="{{ route($item['route']) }}" @click="menuOpen = false"
                       class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all duration-200 {{ $isActive ? 'text-white' : 'text-gray-600 dark:text-slate-300 hover:bg-gray-50 dark:hover:bg-slate-800' }}"
                       @if($isActive) style="background-color: var(--warna-primary)" @endif>
                        <svg class="w-5 h-5 shrink-0 {{ $isActive ? 'text-white' : 'text-gray-400 dark:text-slate-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $item['icon'] !!}</svg>
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </nav>
            <div class="p-3 border-t border-gray-100 dark:border-slate-800">
                @auth
                    <a href="{{ route('dashboard') }}" @click="menuOpen = false" class="flex items-center justify-center gap-2 w-full px-4 py-3 rounded-xl text-sm font-semibold text-white transition-all btn-theme">
                        Dashboard
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                    </a>
                @else
                    <div class="space-y-2">
                        <a href="{{ route('login') }}" @click="menuOpen = false" class="flex items-center justify-center gap-2 w-full px-4 py-3 rounded-xl text-sm font-semibold text-white transition-all btn-theme">
                            Masuk
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1z"/></svg>
                        </a>
                        <a href="{{ route('register') }}" @click="menuOpen = false" class="flex items-center justify-center gap-2 w-full px-4 py-3 rounded-xl text-sm font-semibold border-2 transition-all hover:-translate-y-0.5" style="border-color: var(--warna-primary); color: var(--warna-primary)">
                            Daftar
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </nav>

    {{-- MAIN --}}
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

    {{-- FOOTER --}}
    <footer class="relative bg-gray-900 dark:bg-black overflow-hidden">
        <div class="absolute inset-0 opacity-[0.03]">
            <div class="absolute top-0 left-1/4 w-96 h-96 rounded-full" style="background: var(--warna-primary); filter: blur(100px)"></div>
            <div class="absolute bottom-0 right-1/4 w-96 h-96 rounded-full" style="background: var(--warna-second); filter: blur(100px)"></div>
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16 lg:py-20">
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-10 lg:gap-12">
                {{-- Brand --}}
                <div class="lg:col-span-1">
                    <div class="flex items-center space-x-3 mb-5">
                        @if($profil?->logo)
                            <img src="{{ Storage::url($profil->logo) }}" alt="{{ $profil->nama_sekolah }}" class="h-9 w-auto rounded-xl">
                        @else
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center theme-bg">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                        @endif
                        <span class="text-lg font-bold text-white">{{ $profil->nama_sekolah ?? config('app.name', 'PPDB') }}</span>
                    </div>
                    <p class="text-sm text-gray-400 leading-relaxed mb-6">{{ $profil->sejarah ?? 'Sistem Penerimaan Peserta Didik Baru secara online. Mudah, cepat, dan transparan.' }}</p>
                    <div class="flex space-x-2">
                        @forelse($mediaSosial as $media)
                            <a href="{{ $media->url }}" target="_blank" rel="noopener" class="w-10 h-10 rounded-xl flex items-center justify-center bg-white/5 hover:bg-white/10 border border-white/5 transition-all duration-200 text-gray-400 hover:text-white hover:scale-110" title="{{ $media->platform }}">
                                <i class="{!! $media->icon !!}"></i>
                            </a>
                        @empty
                        @endforelse
                    </div>
                </div>

                {{-- Navigasi --}}
                <div>
                    <h3 class="text-white font-bold mb-5 pb-3 border-b border-white/10 text-sm uppercase tracking-wider">Navigasi</h3>
                    <ul class="space-y-3 text-sm">
                        <li><a href="{{ route('public.beranda') }}" class="text-gray-400 hover:text-white transition-colors duration-200 hover:translate-x-1 inline-block">Beranda</a></li>
                        <li><a href="{{ route('public.berita.index') }}" class="text-gray-400 hover:text-white transition-colors duration-200 hover:translate-x-1 inline-block">Berita</a></li>
                        <li><a href="{{ route('public.pengumuman.index') }}" class="text-gray-400 hover:text-white transition-colors duration-200 hover:translate-x-1 inline-block">Pengumuman</a></li>
                        <li><a href="{{ route('public.galeri.index') }}" class="text-gray-400 hover:text-white transition-colors duration-200 hover:translate-x-1 inline-block">Galeri</a></li>
                        <li><a href="{{ route('public.kontak.index') }}" class="text-gray-400 hover:text-white transition-colors duration-200 hover:translate-x-1 inline-block">Kontak</a></li>
                    </ul>
                </div>

                {{-- PPDB --}}
                <div>
                    <h3 class="text-white font-bold mb-5 pb-3 border-b border-white/10 text-sm uppercase tracking-wider">PPDB</h3>
                    <ul class="space-y-3 text-sm">
                        <li><a href="{{ route('login') }}" class="text-gray-400 hover:text-white transition-colors duration-200 hover:translate-x-1 inline-block">Login Peserta</a></li>
                        <li><a href="{{ route('register') }}" class="text-gray-400 hover:text-white transition-colors duration-200 hover:translate-x-1 inline-block">Daftar Akun</a></li>
                    </ul>
                </div>

                {{-- Kontak --}}
                <div>
                    <h3 class="text-white font-bold mb-5 pb-3 border-b border-white/10 text-sm uppercase tracking-wider">Kontak</h3>
                    <ul class="space-y-4 text-sm">
                        @if($profil?->email)
                            <li class="flex items-start space-x-3">
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0 mt-0.5 bg-white/5 border border-white/5">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                </div>
                                <span class="text-gray-400">{{ $profil->email }}</span>
                            </li>
                        @endif
                        @if($profil?->telepon)
                            <li class="flex items-start space-x-3">
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0 mt-0.5 bg-white/5 border border-white/5">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                </div>
                                <span class="text-gray-400">{{ $profil->telepon }}</span>
                            </li>
                        @endif
                        @if($profil?->alamat)
                            <li class="flex items-start space-x-3">
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0 mt-0.5 bg-white/5 border border-white/5">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                </div>
                                <span class="text-gray-400">{{ $profil->alamat }}</span>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>

            {{-- Copyright --}}
            <div class="border-t border-white/10 mt-12 pt-8 flex flex-col sm:flex-row justify-between items-center gap-4 text-sm text-gray-500">
                <p>&copy; {{ date('Y') }} {{ $profil->nama_sekolah ?? config('app.name', 'PPDB') }}. Hak cipta dilindungi.</p>
                <p class="flex items-center gap-1.5">
                    Dibuat dengan
                    <svg class="w-4 h-4 text-red-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/></svg>
                    untuk Pendidikan
                </p>
            </div>
        </div>
    </footer>

    {{-- Scroll to Top --}}
    <div x-data="{ show: false }"
         x-init="window.addEventListener('scroll', () => { show = window.scrollY > 400 })"
         x-show="show"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 translate-y-4"
         class="fixed bottom-4 right-4 sm:bottom-6 sm:right-6 z-[55]">
        <button @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
                class="w-10 h-10 sm:w-12 sm:h-12 rounded-full btn-theme text-white shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7"/>
            </svg>
        </button>
    </div>

    @stack('scripts')
</body>
</html>
