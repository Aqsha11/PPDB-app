@php
    $menuGroups = [
        [
            'label' => '',
            'items' => [
                ['label' => 'Dashboard', 'route' => 'admin.dashboard', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />'],
            ],
        ],
        [
            'label' => 'PPDB',
            'items' => [
                ['label' => 'Data Pendaftaran', 'route' => 'admin.pendaftaran.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />'],
                ['label' => 'Verifikasi', 'route' => 'admin.verifikasi.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />'],
                ['label' => 'Seleksi', 'route' => 'admin.kelulusan.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />'],
                ['label' => 'Daftar Ulang', 'route' => 'admin.daftar-ulang.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2m-6 9l2 2 4-4" />'],
                ['label' => 'Laporan', 'route' => 'admin.laporan.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />'],
            ],
        ],
        [
            'label' => 'Data Master',
            'items' => [
                ['label' => 'Tahun Ajaran', 'route' => 'admin.tahun-ajaran.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />'],
                ['label' => 'Periode PPDB', 'route' => 'admin.periode.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />'],
                ['label' => 'Jalur Pendaftaran', 'route' => 'admin.jalur.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />'],
                ['label' => 'Persyaratan Dokumen', 'route' => 'admin.dokumen-persyaratan.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />'],
            ],
        ],
        [
            'label' => 'Informasi Sekolah',
            'items' => [
                ['label' => 'Hero Banner', 'route' => 'admin.hero.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />'],
                ['label' => 'Profil Sekolah', 'route' => 'admin.profil.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />'],
                ['label' => 'Sambutan Kepsek', 'route' => 'admin.sambutan.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />'],
                ['label' => 'Keunggulan', 'route' => 'admin.keunggulan.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />'],
                ['label' => 'Statistik', 'route' => 'admin.statistik.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />'],
            ],
        ],
        [
            'label' => 'Konten PPDB',
            'items' => [
                ['label' => 'Tahapan', 'route' => 'admin.tahapan.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />'],
                ['label' => 'Jadwal', 'route' => 'admin.jadwal.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />'],
                ['label' => 'FAQ', 'route' => 'admin.faq.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />'],
                ['label' => 'Pengumuman', 'route' => 'admin.pengumuman.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />'],
            ],
        ],
        [
            'label' => 'Media & Galeri',
            'items' => [
                ['label' => 'Berita', 'route' => 'admin.berita.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />'],
                ['label' => 'Galeri', 'route' => 'admin.galeri.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />'],
                ['label' => 'Video', 'route' => 'admin.video.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />'],
                ['label' => 'Testimoni', 'route' => 'admin.testimoni.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />'],
            ],
        ],
        [
            'label' => 'Data Peserta',
            'items' => [
                ['label' => 'Biodata Peserta', 'route' => 'admin.biodata.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />'],
                ['label' => 'Dokumen Peserta', 'route' => 'admin.dokumen-peserta.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />'],
            ],
        ],
        [
            'label' => 'Pengaturan',
            'items' => [
                ['label' => 'Pesan Masuk', 'route' => 'admin.kontak.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />'],
                ['label' => 'Media Sosial', 'route' => 'admin.media-sosial.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />'],
                ['label' => 'Logo & Favicon', 'route' => 'admin.branding.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />'],
                ['label' => 'SEO', 'route' => 'admin.seo.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />'],
                ['label' => 'Users', 'route' => 'admin.user.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />'],
                ['label' => 'Roles', 'route' => 'admin.role.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />'],
                ['label' => 'Permissions', 'route' => 'admin.permission.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />'],
            ],
        ],
    ];
@endphp

<aside class="fixed inset-y-0 left-0 z-50 flex flex-col overflow-hidden transition-all duration-300 ease-in-out bg-white dark:bg-slate-800 border-r border-gray-100 dark:border-slate-700/50"
       :style="(desktop ? 'width: ' + (collapsed ? '80px' : '256px') : 'width: 256px') + '; transform: ' + (desktop ? 'translateX(0)' : (mobileOpen ? 'translateX(0)' : 'translateX(-100%)'))">

    {{-- Logo & School Name --}}
    <div class="flex items-center h-16 px-4 shrink-0" :class="collapsed ? 'justify-center' : 'justify-between'">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 group" :class="collapsed ? '' : ''">
            @if(isset($profil) && $profil?->logo)
                <img src="{{ Storage::url($profil->logo) }}" alt="{{ $profil->nama_sekolah }}" class="h-9 w-auto shrink-0 rounded-lg">
            @else
                <div class="w-9 h-9 rounded-xl flex items-center justify-center shrink-0 theme-bg shadow-md shadow-primary-500/20">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
            @endif
            <div x-show="!collapsed" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                <span class="text-sm font-bold text-gray-900 dark:text-white leading-tight block">{{ $profil->nama_sekolah ?? config('app.name', 'PPDB') }}</span>
                <p class="text-[10px] font-semibold theme-text uppercase tracking-widest">Admin Panel</p>
            </div>
        </a>
        <button @click="closeMobile()" class="lg:hidden text-gray-400 hover:text-gray-600 dark:hover:text-slate-300 transition-colors p-1.5 rounded-lg hover:bg-gray-100 dark:hover:bg-slate-700">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 overflow-y-auto py-3 px-3 space-y-4 scrollbar-thin">
        @foreach($menuGroups as $group)
            <div>
                @if($group['label'])
                    <p class="px-3 mb-2 text-[10px] font-bold text-gray-400 dark:text-slate-500 uppercase tracking-widest {{ $group['label'] ? '' : 'sr-only' }}">{{ $group['label'] }}</p>
                @endif
                <div class="space-y-0.5">
                    @foreach($group['items'] as $item)
                        @if(request()->routeIs($item['route']))
                            <a href="{{ route($item['route']) }}" @click="closeMobile()"
                               class="sidebar-active flex items-center px-3 py-2.5 text-sm font-semibold rounded-xl transition-all duration-200"
                               :class="collapsed ? 'justify-center' : ''"
                               x-tooltip="collapsed ? '{{ $item['label'] }}' : false">
                                <svg class="w-5 h-5 shrink-0" :class="collapsed ? '' : 'mr-3'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    {!! $item['icon'] !!}
                                </svg>
                                <span x-show="!collapsed" class="truncate">{{ $item['label'] }}</span>
                                <span class="sr-only" x-show="collapsed">{{ $item['label'] }}</span>
                            </a>
                        @else
                            <a href="{{ route($item['route']) }}" @click="closeMobile()"
                               class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl text-gray-600 dark:text-slate-400 hover:bg-gray-50 dark:hover:bg-slate-700/50 hover:text-gray-900 dark:hover:text-white transition-all duration-200"
                               :class="collapsed ? 'justify-center' : ''"
                               x-tooltip="collapsed ? '{{ $item['label'] }}' : false">
                                <svg class="w-5 h-5 shrink-0" :class="collapsed ? '' : 'mr-3'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    {!! $item['icon'] !!}
                                </svg>
                                <span x-show="!collapsed" class="truncate">{{ $item['label'] }}</span>
                                <span class="sr-only" x-show="collapsed">{{ $item['label'] }}</span>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        @endforeach
    </nav>

    {{-- User Card --}}
    <div class="shrink-0 border-t border-gray-100 dark:border-slate-700/50 p-3">
        <div class="flex items-center" :class="collapsed ? 'justify-center' : 'gap-3'">
            <div class="w-9 h-9 rounded-xl flex items-center justify-center shrink-0 theme-bg text-white font-bold text-sm shadow-md">
                {{ substr(auth()->user()->name, 0, 1) }}
            </div>
            <div x-show="!collapsed" class="flex-1 min-w-0">
                <p class="text-sm font-semibold text-gray-900 dark:text-white truncate">{{ auth()->user()->name }}</p>
                <p class="text-[11px] font-medium theme-text">{{ auth()->user()->roles->first()->name ?? 'Administrator' }}</p>
            </div>
            <form method="POST" action="{{ route('logout') }}" x-show="!collapsed">
                @csrf
                <button type="submit" class="text-gray-400 hover:text-red-500 dark:hover:text-red-400 transition-colors p-1.5 rounded-lg hover:bg-red-50 dark:hover:bg-red-500/10" title="Keluar">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </button>
            </form>
        </div>
    </div>
</aside>
