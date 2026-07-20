<x-app-layout>
    <div class="space-y-6" x-data="dashboardGreeting()" x-init="startClock()">

        {{-- Greeting Banner --}}
        <div class="relative overflow-hidden rounded-2xl theme-bg p-6 sm:p-8 text-white">
            <div class="absolute inset-0 opacity-10">
                <svg class="absolute -right-20 -top-20 h-64 w-64" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                <svg class="absolute -left-10 -bottom-10 h-48 w-48" fill="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/></svg>
            </div>
            <div class="relative flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight"><span x-text="greeting"></span>, {{ auth()->user()->name }}!</h1>
                    <p class="text-white/70 mt-1 text-sm sm:text-base">Selamat datang di panel admin PPDB. Kelola penerimaan peserta didik baru dengan mudah.</p>
                </div>
                <div class="flex items-center gap-2 px-4 py-2 bg-white/10 backdrop-blur-sm rounded-xl text-sm font-medium shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span x-text="dateStr"></span>
                </div>
            </div>
        </div>

        {{-- Stats --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            <a href="{{ route('admin.pendaftaran.index') }}" class="group block stagger-item">
                <div class="stat-gradient-blue rounded-2xl border border-gray-100 dark:border-slate-700/50 p-5 hover:shadow-lg hover:shadow-primary-500/5 transition-all duration-300 group-hover:-translate-y-0.5">
                    <div class="flex items-start justify-between">
                        <div class="flex-1 min-w-0">
                            <p class="text-[11px] font-bold text-gray-500 dark:text-slate-400 uppercase tracking-wider">Total Pendaftar</p>
                            <p class="mt-2 text-2xl sm:text-3xl font-extrabold text-gray-900 dark:text-white">{{ $totalPendaftar }}</p>
                        </div>
                        <div class="w-11 h-11 rounded-xl theme-bg-light flex items-center justify-center shrink-0 ml-3">
                            <svg class="w-5 h-5 theme-text" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </a>

            <a href="{{ route('admin.verifikasi.index') }}" class="group block stagger-item">
                <div class="stat-gradient-amber rounded-2xl border border-gray-100 dark:border-slate-700/50 p-5 hover:shadow-lg hover:shadow-amber-500/5 transition-all duration-300 group-hover:-translate-y-0.5">
                    <div class="flex items-start justify-between">
                        <div class="flex-1 min-w-0">
                            <p class="text-[11px] font-bold text-gray-500 dark:text-slate-400 uppercase tracking-wider">Menunggu Verifikasi</p>
                            <p class="mt-2 text-2xl sm:text-3xl font-extrabold text-gray-900 dark:text-white">{{ $submitted }}</p>
                        </div>
                        <div class="w-11 h-11 rounded-xl bg-amber-50 dark:bg-amber-500/10 flex items-center justify-center shrink-0 ml-3">
                            <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </a>

            <a href="{{ route('admin.kelulusan.index') }}" class="group block stagger-item">
                <div class="stat-gradient-green rounded-2xl border border-gray-100 dark:border-slate-700/50 p-5 hover:shadow-lg hover:shadow-emerald-500/5 transition-all duration-300 group-hover:-translate-y-0.5">
                    <div class="flex items-start justify-between">
                        <div class="flex-1 min-w-0">
                            <p class="text-[11px] font-bold text-gray-500 dark:text-slate-400 uppercase tracking-wider">Diterima</p>
                            <p class="mt-2 text-2xl sm:text-3xl font-extrabold text-gray-900 dark:text-white">{{ $diterimaCount }}</p>
                        </div>
                        <div class="w-11 h-11 rounded-xl bg-emerald-50 dark:bg-emerald-500/10 flex items-center justify-center shrink-0 ml-3">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </a>

            <a href="{{ route('admin.pendaftaran.index') }}" class="group block stagger-item">
                <div class="stat-gradient-red rounded-2xl border border-gray-100 dark:border-slate-700/50 p-5 hover:shadow-lg hover:shadow-red-500/5 transition-all duration-300 group-hover:-translate-y-0.5">
                    <div class="flex items-start justify-between">
                        <div class="flex-1 min-w-0">
                            <p class="text-[11px] font-bold text-gray-500 dark:text-slate-400 uppercase tracking-wider">Ditolak</p>
                            <p class="mt-2 text-2xl sm:text-3xl font-extrabold text-gray-900 dark:text-white">{{ $ditolak }}</p>
                        </div>
                        <div class="w-11 h-11 rounded-xl bg-red-50 dark:bg-red-500/10 flex items-center justify-center shrink-0 ml-3">
                            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        {{-- Statistik Sekolah --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 sm:gap-8">
            @php
                $statColors = [
                    ['bg' => 'bg-sky-50 dark:bg-sky-500/10', 'text' => 'text-sky-600 dark:text-sky-400'],
                    ['bg' => 'bg-emerald-50 dark:bg-emerald-500/10', 'text' => 'text-emerald-600 dark:text-emerald-400'],
                    ['bg' => 'bg-amber-50 dark:bg-amber-500/10', 'text' => 'text-amber-600 dark:text-amber-400'],
                    ['bg' => 'bg-purple-50 dark:bg-purple-500/10', 'text' => 'text-purple-600 dark:text-purple-400'],
                ];
                $statIcons = [
                    'fas fa-user-graduate' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>',
                    'fas fa-chalkboard-teacher' => '<path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>',
                    'fas fa-door-open' => '<path stroke-linecap="round" stroke-linejoin="round" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"/>',
                    'fas fa-trophy' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>',
                ];
            @endphp
            @forelse($statistik as $index => $s)
                @php $color = $statColors[$index % count($statColors)]; @endphp
                <div class="group block stagger-item">
                    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-gray-200/60 dark:border-slate-800 p-6 shadow-sm hover:shadow-xl transition-all duration-300 group-hover:-translate-y-1">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 rounded-2xl {{ $color['bg'] }} flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6 {{ $color['text'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    {!! $statIcons[$s->icon] ?? '<path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>' !!}
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <p class="text-[11px] font-bold text-gray-400 dark:text-slate-500 uppercase tracking-widest">{{ $s->judul }}</p>
                                <p class="mt-1.5 text-2xl sm:text-3xl font-extrabold text-gray-900 dark:text-white">{{ number_format($s->jumlah, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-8 text-gray-400 dark:text-slate-500 text-sm">
                    Belum ada data statistik sekolah.
                </div>
            @endforelse
        </div>

        <div class="grid lg:grid-cols-3 gap-6">
            {{-- Quick Actions --}}
            <div class="lg:col-span-2">
                <x-card>
                    <x-slot name="title">Aksi Cepat</x-slot>
                    <x-slot name="subtitle">Akses cepat ke modul yang sering digunakan</x-slot>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                        @can('pendaftaran.view')
                            <a href="{{ route('admin.pendaftaran.index') }}" class="group flex items-center gap-3 p-4 rounded-xl border border-gray-100 dark:border-slate-700/50 hover:border-transparent hover:shadow-md hover:shadow-primary-500/5 hover:-translate-y-0.5 transition-all duration-200">
                                <div class="w-10 h-10 rounded-xl theme-bg-light flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                                    <svg class="w-5 h-5 theme-text" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <span class="text-sm font-semibold text-gray-700 dark:text-slate-300">Pendaftaran</span>
                            </a>
                        @endcan

                        @can('pendaftaran.verify')
                            <a href="{{ route('admin.verifikasi.index') }}" class="group flex items-center gap-3 p-4 rounded-xl border border-gray-100 dark:border-slate-700/50 hover:border-transparent hover:shadow-md hover:shadow-amber-500/5 hover:-translate-y-0.5 transition-all duration-200">
                                <div class="w-10 h-10 rounded-xl bg-amber-50 dark:bg-amber-500/10 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <span class="text-sm font-semibold text-gray-700 dark:text-slate-300">Verifikasi</span>
                            </a>
                        @endcan

                        @can('pendaftaran.select')
                            <a href="{{ route('admin.kelulusan.index') }}" class="group flex items-center gap-3 p-4 rounded-xl border border-gray-100 dark:border-slate-700/50 hover:border-transparent hover:shadow-md hover:shadow-emerald-500/5 hover:-translate-y-0.5 transition-all duration-200">
                                <div class="w-10 h-10 rounded-xl bg-emerald-50 dark:bg-emerald-500/10 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                    </svg>
                                </div>
                                <span class="text-sm font-semibold text-gray-700 dark:text-slate-300">Seleksi</span>
                            </a>
                        @endcan

                        @can('pendaftaran.reenroll')
                            <a href="{{ route('admin.daftar-ulang.index') }}" class="group flex items-center gap-3 p-4 rounded-xl border border-gray-100 dark:border-slate-700/50 hover:border-transparent hover:shadow-md hover:shadow-purple-500/5 hover:-translate-y-0.5 transition-all duration-200">
                                <div class="w-10 h-10 rounded-xl bg-purple-50 dark:bg-purple-500/10 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                    </svg>
                                </div>
                                <span class="text-sm font-semibold text-gray-700 dark:text-slate-300">Daftar Ulang</span>
                            </a>
                        @endcan

                        @can('biodata.view')
                            <a href="{{ route('admin.biodata.index') }}" class="group flex items-center gap-3 p-4 rounded-xl border border-gray-100 dark:border-slate-700/50 hover:border-transparent hover:shadow-md hover:shadow-gray-500/5 hover:-translate-y-0.5 transition-all duration-200">
                                <div class="w-10 h-10 rounded-xl bg-gray-100 dark:bg-gray-500/10 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <span class="text-sm font-semibold text-gray-700 dark:text-slate-300">Biodata</span>
                            </a>
                        @endcan

                        @can('cms.manage')
                            <a href="{{ route('admin.berita.index') }}" class="group flex items-center gap-3 p-4 rounded-xl border border-gray-100 dark:border-slate-700/50 hover:border-transparent hover:shadow-md hover:shadow-sky-500/5 hover:-translate-y-0.5 transition-all duration-200">
                                <div class="w-10 h-10 rounded-xl bg-sky-50 dark:bg-sky-500/10 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                                    <svg class="w-5 h-5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                    </svg>
                                </div>
                                <span class="text-sm font-semibold text-gray-700 dark:text-slate-300">Berita</span>
                            </a>
                        @endcan
                    </div>
                </x-card>
            </div>

            {{-- Status Ring --}}
            <div class="lg:col-span-1">
                <x-card>
                    <x-slot name="title">Status Pendaftaran</x-slot>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between p-3 rounded-xl bg-gray-50 dark:bg-slate-700/30">
                            <div class="flex items-center gap-3">
                                <span class="w-2.5 h-2.5 rounded-full bg-gray-400"></span>
                                <span class="text-sm text-gray-600 dark:text-slate-400">Draft</span>
                            </div>
                            <span class="text-sm font-bold text-gray-900 dark:text-white">{{ $draft }}</span>
                        </div>
                        <div class="flex items-center justify-between p-3 rounded-xl bg-amber-50 dark:bg-amber-500/5">
                            <div class="flex items-center gap-3">
                                <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
                                <span class="text-sm text-gray-600 dark:text-slate-400">Submitted</span>
                            </div>
                            <span class="text-sm font-bold text-gray-900 dark:text-white">{{ $submitted }}</span>
                        </div>
                        <div class="flex items-center justify-between p-3 rounded-xl bg-sky-50 dark:bg-sky-500/5">
                            <div class="flex items-center gap-3">
                                <span class="w-2.5 h-2.5 rounded-full bg-sky-500"></span>
                                <span class="text-sm text-gray-600 dark:text-slate-400">Verifikasi</span>
                            </div>
                            <span class="text-sm font-bold text-gray-900 dark:text-white">{{ $verifikasi }}</span>
                        </div>
                        <div class="flex items-center justify-between p-3 rounded-xl bg-emerald-50 dark:bg-emerald-500/5">
                            <div class="flex items-center gap-3">
                                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                                <span class="text-sm text-gray-600 dark:text-slate-400">Diterima</span>
                            </div>
                            <span class="text-sm font-bold text-gray-900 dark:text-white">{{ $diterima }}</span>
                        </div>
                        <div class="flex items-center justify-between p-3 rounded-xl bg-purple-50 dark:bg-purple-500/5">
                            <div class="flex items-center gap-3">
                                <span class="w-2.5 h-2.5 rounded-full bg-purple-500"></span>
                                <span class="text-sm text-gray-600 dark:text-slate-400">Cadangan</span>
                            </div>
                            <span class="text-sm font-bold text-gray-900 dark:text-white">{{ $cadangan }}</span>
                        </div>
                        <div class="flex items-center justify-between p-3 rounded-xl bg-red-50 dark:bg-red-500/5">
                            <div class="flex items-center gap-3">
                                <span class="w-2.5 h-2.5 rounded-full bg-red-500"></span>
                                <span class="text-sm text-gray-600 dark:text-slate-400">Ditolak</span>
                            </div>
                            <span class="text-sm font-bold text-gray-900 dark:text-white">{{ $ditolak }}</span>
                        </div>
                        <div class="flex items-center justify-between p-3 rounded-xl theme-bg-lighter">
                            <div class="flex items-center gap-3">
                                <span class="w-2.5 h-2.5 rounded-full theme-bg"></span>
                                <span class="text-sm text-gray-600 dark:text-slate-400">Daftar Ulang</span>
                            </div>
                            <span class="text-sm font-bold text-gray-900 dark:text-white">{{ $daftarUlangCount }}</span>
                        </div>
                    </div>
                </x-card>
            </div>
        </div>

    </div>
</x-app-layout>
