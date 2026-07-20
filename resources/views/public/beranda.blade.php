<x-layouts.public title="Beranda">

    {{-- HERO --}}
    @if($hero->isNotEmpty())
        <section class="relative text-white overflow-hidden bg-gray-900"
            x-data="{
                current: 0,
                total: {{ $hero->count() }},
                interval: null,
                init() {
                    this.interval = setInterval(() => {
                        this.current = (this.current + 1) % this.total
                    }, 5000)
                },
                stop() { clearInterval(this.interval) },
                start() { this.interval = setInterval(() => { this.current = (this.current + 1) % this.total }, 5000) },
                go(i) { this.current = i }
            }"
            @mouseenter="stop"
            @mouseleave="start">
            @foreach($hero as $i => $item)
                <div x-show="current === {{ $i }}" x-cloak>
                    <div x-transition:enter="transition ease-out duration-[1200ms]" x-transition:enter-start="scale-[1.08]" x-transition:enter-end="scale-100" x-transition:leave="transition ease-in duration-700" x-transition:leave-start="scale-100" x-transition:leave-end="scale-[1.05]" class="absolute inset-0">
                        @if($item->gambar)
                            <img src="{{ Storage::url($item->gambar) }}" alt="" class="w-full h-full object-cover">
                            <div class="absolute inset-0" style="background: linear-gradient(135deg, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.3) 100%)"></div>
                        @else
                            <div class="absolute inset-0" style="background-color: var(--warna-primary)"></div>
                        @endif
                    </div>

                    <div x-transition:enter="transition ease-out duration-1000 delay-300" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-500" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-28 sm:py-36 lg:py-44 xl:py-52">
                        <div class="max-w-3xl">
                            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 border border-white/10 text-sm font-medium mb-6 backdrop-blur-sm">
                                <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                                PPDB Terbuka
                            </div>
                            <h1 class="text-4xl sm:text-5xl lg:text-6xl xl:text-[4.25rem] font-extrabold leading-[1.08] mb-6 tracking-tight">
                                {{ $item->judul ?? 'Selamat Datang di ' . config('app.name', 'PPDB') }}
                            </h1>
                            @if($item->sub_judul)
                                <p class="text-lg sm:text-xl text-white/80 mb-4 leading-relaxed max-w-2xl">{{ $item->sub_judul }}</p>
                            @endif
                            @if($item->deskripsi)
                                <p class="text-base text-white/50 mb-10 leading-relaxed max-w-2xl">{{ $item->deskripsi }}</p>
                            @endif
                            <div class="flex flex-wrap gap-3 sm:gap-4">
                                @auth
                                    <a href="{{ route('dashboard') }}" class="group inline-flex items-center gap-2 px-5 py-3 sm:px-7 sm:py-3.5 bg-white text-gray-900 font-semibold rounded-2xl hover:bg-gray-50 transition-all duration-200 hover:shadow-xl hover:shadow-black/10 hover:-translate-y-0.5">
                                        Dashboard Saya
                                        <svg class="h-4 w-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                                    </a>
                                @endauth
                                @if($item->button_text && $item->button_link)
                                    <a href="{{ $item->button_link }}" class="inline-flex items-center gap-2 px-5 py-3 sm:px-7 sm:py-3.5 text-white font-semibold rounded-2xl border-2 border-white/20 hover:border-white/40 hover:bg-white/10 transition-all duration-200 backdrop-blur-sm">
                                        {{ $item->button_text }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            {{-- Dots --}}
            <div class="absolute bottom-8 left-0 right-0 z-10 flex justify-center gap-2.5">
                @foreach($hero as $i => $item)
                    <button @click="go({{ $i }})" :class="current === {{ $i }} ? 'w-10' : 'w-3 hover:bg-white/50'" class="h-3 rounded-full transition-all duration-300 focus:outline-none" :style="current === {{ $i }} ? 'background-color: white' : 'background-color: rgba(255,255,255,0.3)'" :aria-label="'Slide ' + ({{ $i }} + 1)"></button>
                @endforeach
            </div>
        </section>
    @endif

    {{-- STATISTIK --}}
    @if($statistik->isNotEmpty())
        <section class="relative z-20 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 -mt-10 reveal">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-5">
                @php
                    $statBg = ['bg-sky-50 dark:bg-sky-500/10', 'bg-emerald-50 dark:bg-emerald-500/10', 'bg-amber-50 dark:bg-amber-500/10', 'bg-purple-50 dark:bg-purple-500/10'];
                    $statText = ['text-sky-600 dark:text-sky-400', 'text-emerald-600 dark:text-emerald-400', 'text-amber-600 dark:text-amber-400', 'text-purple-600 dark:text-purple-400'];
                    $statIcons = [
                        'fas fa-user-graduate' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>',
                        'fas fa-chalkboard-teacher' => '<path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>',
                        'fas fa-door-open' => '<path stroke-linecap="round" stroke-linejoin="round" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"/>',
                        'fas fa-trophy' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>',
                    ];
                @endphp
                @foreach($statistik as $i => $s)
                    @php $ci = $i % 4; @endphp
                    <div class="group bg-white dark:bg-slate-900 rounded-2xl border border-gray-200/80 dark:border-slate-800 p-5 sm:p-6 shadow-xl shadow-black/[0.04] dark:shadow-black/20 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 text-center">
                        <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl mx-auto mb-4 flex items-center justify-center {{ $statBg[$ci] }} group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 sm:w-7 sm:h-7 {{ $statText[$ci] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                {!! $statIcons[$s->icon] ?? '<path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>' !!}
                            </svg>
                        </div>
                        <p class="text-3xl sm:text-4xl font-extrabold text-gray-900 dark:text-white mb-1" data-count-to="{{ $s->jumlah }}">0</p>
                        <p class="text-xs sm:text-sm font-semibold text-gray-500 dark:text-slate-400 uppercase tracking-wider">{{ $s->judul }}</p>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    {{-- PROFIL SEKOLAH --}}
    @if($profil)
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-24 reveal">
            <div class="text-center mb-14">
                <span class="inline-block px-4 py-1.5 rounded-full text-sm font-semibold mb-4" style="background-color: color-mix(in srgb, var(--warna-primary) 10%, transparent); color: var(--warna-primary)">Profil</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 dark:text-white tracking-tight">Profil Sekolah</h2>
                <p class="text-gray-500 dark:text-slate-400 mt-3 text-lg">Informasi lengkap tentang sekolah kami</p>
            </div>
            <div class="bg-white dark:bg-slate-900 rounded-3xl border border-gray-200/80 dark:border-slate-800 overflow-hidden shadow-xl shadow-black/[0.04] dark:shadow-black/20">
                <div class="md:flex">
                    @if($profil->foto_sekolah)
                        <div class="md:w-2/5 shrink-0">
                            <img src="{{ Storage::url($profil->foto_sekolah) }}" alt="{{ $profil->nama_sekolah }}" class="w-full h-72 md:h-full object-cover">
                        </div>
                    @endif
                    <div class="p-8 md:p-10 lg:p-12 flex-1">
                        <h3 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white mb-4">{{ $profil->nama_sekolah }}</h3>
                        @if($profil->sejarah)
                            <p class="text-gray-600 dark:text-slate-400 leading-relaxed mb-8">{{ Str::limit(strip_tags($profil->sejarah), 300) }}</p>
                        @endif
                        <div class="grid sm:grid-cols-2 gap-5">
                            @if($profil->visi)
                                <div class="rounded-2xl p-6 border border-gray-100 dark:border-slate-800" style="background-color: color-mix(in srgb, var(--warna-primary) 5%, transparent)">
                                    <h4 class="font-bold mb-2" style="color: var(--warna-primary)">Visi</h4>
                                    <p class="text-sm leading-relaxed text-gray-600 dark:text-slate-400">{{ $profil->visi }}</p>
                                </div>
                            @endif
                            @if($profil->misi)
                                <div class="rounded-2xl p-6 border border-gray-100 dark:border-slate-800" style="background-color: color-mix(in srgb, var(--warna-second) 5%, transparent)">
                                    <h4 class="font-bold mb-2" style="color: var(--warna-second)">Misi</h4>
                                    <p class="text-sm leading-relaxed text-gray-600 dark:text-slate-400">{{ $profil->misi }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- INFORMASI KONTAK --}}
    @if($profil && ($profil->alamat || $profil->email || $profil->telepon || $profil->whatsapp))
        <section class="py-20 lg:py-24 bg-gray-100/80 dark:bg-slate-900/50 reveal">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-14">
                    <span class="inline-block px-4 py-1.5 rounded-full text-sm font-semibold mb-4" style="background-color: color-mix(in srgb, var(--warna-primary) 10%, transparent); color: var(--warna-primary)">Kontak</span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 dark:text-white tracking-tight">Informasi Kontak</h2>
                    <p class="text-gray-500 dark:text-slate-400 mt-3 text-lg">Hubungi kami untuk informasi lebih lanjut</p>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @if($profil->alamat)
                        <div class="bg-white dark:bg-slate-900 rounded-3xl p-7 border border-gray-200/80 dark:border-slate-800 text-center transition-all duration-300 hover:shadow-xl hover:shadow-black/[0.06] dark:hover:shadow-black/30 hover:-translate-y-1 group">
                            <div class="w-14 h-14 rounded-2xl mx-auto mb-5 flex items-center justify-center transition-all duration-300 group-hover:scale-110" style="background-color: color-mix(in srgb, var(--warna-primary) 10%, transparent)">
                                <svg class="w-7 h-7" style="color: var(--warna-primary)" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <h3 class="font-bold text-gray-900 dark:text-white mb-2">Alamat</h3>
                            <p class="text-sm text-gray-500 dark:text-slate-400 leading-relaxed">{{ $profil->alamat }}</p>
                        </div>
                    @endif
                    @if($profil->telepon)
                        <div class="bg-white dark:bg-slate-900 rounded-3xl p-7 border border-gray-200/80 dark:border-slate-800 text-center transition-all duration-300 hover:shadow-xl hover:shadow-black/[0.06] dark:hover:shadow-black/30 hover:-translate-y-1 group">
                            <div class="w-14 h-14 rounded-2xl mx-auto mb-5 flex items-center justify-center transition-all duration-300 group-hover:scale-110" style="background-color: color-mix(in srgb, var(--warna-primary) 10%, transparent)">
                                <svg class="w-7 h-7" style="color: var(--warna-primary)" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </div>
                            <h3 class="font-bold text-gray-900 dark:text-white mb-2">Telepon</h3>
                            <p class="text-sm text-gray-500 dark:text-slate-400">{{ $profil->telepon }}</p>
                        </div>
                    @endif
                    @if($profil->email)
                        <div class="bg-white dark:bg-slate-900 rounded-3xl p-7 border border-gray-200/80 dark:border-slate-800 text-center transition-all duration-300 hover:shadow-xl hover:shadow-black/[0.06] dark:hover:shadow-black/30 hover:-translate-y-1 group">
                            <div class="w-14 h-14 rounded-2xl mx-auto mb-5 flex items-center justify-center transition-all duration-300 group-hover:scale-110" style="background-color: color-mix(in srgb, var(--warna-primary) 10%, transparent)">
                                <svg class="w-7 h-7" style="color: var(--warna-primary)" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <h3 class="font-bold text-gray-900 dark:text-white mb-2">Email</h3>
                            <p class="text-sm text-gray-500 dark:text-slate-400">{{ $profil->email }}</p>
                        </div>
                    @endif
                    @if($profil->whatsapp)
                        <div class="bg-white dark:bg-slate-900 rounded-3xl p-7 border border-gray-200/80 dark:border-slate-800 text-center transition-all duration-300 hover:shadow-xl hover:shadow-black/[0.06] dark:hover:shadow-black/30 hover:-translate-y-1 group">
                            <div class="w-14 h-14 rounded-2xl mx-auto mb-5 flex items-center justify-center transition-all duration-300 group-hover:scale-110" style="background-color: color-mix(in srgb, var(--warna-primary) 10%, transparent)">
                                <svg class="w-7 h-7" style="color: var(--warna-primary)" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                            </div>
                            <h3 class="font-bold text-gray-900 dark:text-white mb-2">WhatsApp</h3>
                            <a href="https://wa.me/{{ $profil->whatsapp }}" target="_blank" class="text-sm text-gray-500 dark:text-slate-400 hover:underline">{{ $profil->whatsapp }}</a>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @endif

    {{-- SAMBUTAN --}}
    @if($sambutan)
        <section class="py-20 lg:py-24 bg-gray-100/80 dark:bg-slate-900/50 reveal">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-14">
                    <span class="inline-block px-4 py-1.5 rounded-full text-sm font-semibold mb-4" style="background-color: color-mix(in srgb, var(--warna-primary) 10%, transparent); color: var(--warna-primary)">Sambutan</span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 dark:text-white tracking-tight">Sambutan {{ $sambutan->jabatan ?? 'Kepala Sekolah' }}</h2>
                </div>
                <div class="bg-white dark:bg-slate-900 rounded-3xl border border-gray-200/80 dark:border-slate-800 overflow-hidden max-w-5xl mx-auto shadow-xl shadow-black/[0.04] dark:shadow-black/20">
                    <div class="md:flex items-center">
                        @if($sambutan->foto)
                            <div class="md:w-1/3 shrink-0">
                                <img src="{{ Storage::url($sambutan->foto) }}" alt="{{ $sambutan->nama }}" class="w-full h-72 md:h-96 object-cover">
                            </div>
                        @else
                            <div class="md:w-1/3 shrink-0 flex items-center justify-center h-72 md:h-96 theme-bg-light">
                                <span class="text-7xl font-extrabold" style="color: var(--warna-primary)">{{ substr($sambutan->nama, 0, 1) }}</span>
                            </div>
                        @endif
                        <div class="p-8 md:p-12 flex-1">
                            <svg class="h-12 w-12 mb-4 opacity-10" style="color: var(--warna-primary)" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
                            <div class="prose prose-gray dark:prose-invert max-w-none text-gray-600 dark:text-slate-400 leading-relaxed mb-8">
                                {!! nl2br(e($sambutan->isi)) !!}
                            </div>
                            <div class="border-t border-gray-100 dark:border-slate-800 pt-5">
                                <p class="font-bold text-gray-900 dark:text-white text-lg">{{ $sambutan->nama }}</p>
                                <p class="text-sm font-semibold" style="color: var(--warna-primary)">{{ $sambutan->jabatan ?? 'Kepala Sekolah' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- KEUNGGULAN --}}
    @if($keunggulan->isNotEmpty())
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-24 reveal">
            <div class="text-center mb-14">
                <span class="inline-block px-4 py-1.5 rounded-full text-sm font-semibold mb-4" style="background-color: color-mix(in srgb, var(--warna-primary) 10%, transparent); color: var(--warna-primary)">Keunggulan</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 dark:text-white tracking-tight">Keunggulan Sekolah Kami</h2>
                <p class="text-gray-500 dark:text-slate-400 mt-3 text-lg">Mengapa memilih sekolah kami</p>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($keunggulan as $item)
                    <div class="bg-white dark:bg-slate-900 rounded-3xl p-7 border border-gray-200/80 dark:border-slate-800 transition-all duration-300 hover:shadow-xl hover:shadow-black/[0.06] dark:hover:shadow-black/30 hover:-translate-y-1 group">
                        @if($item->icon)
                            <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-5 text-2xl transition-all duration-300 group-hover:scale-110" style="background-color: color-mix(in srgb, var(--warna-primary) 10%, transparent); color: var(--warna-primary)"><i class="{{ $item->icon }}"></i></div>
                        @endif
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-3">{{ $item->judul }}</h3>
                        <p class="text-gray-600 dark:text-slate-400 text-sm leading-relaxed">{{ $item->deskripsi }}</p>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    {{-- TAHAPAN PPDB --}}
    @if($tahapan->isNotEmpty())
        <section class="py-20 lg:py-24 bg-gray-100/80 dark:bg-slate-900/50 reveal">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-14">
                    <span class="inline-block px-4 py-1.5 rounded-full text-sm font-semibold mb-4" style="background-color: color-mix(in srgb, var(--warna-primary) 10%, transparent); color: var(--warna-primary)">Tahapan</span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 dark:text-white tracking-tight">Tahapan PPDB</h2>
                    <p class="text-gray-500 dark:text-slate-400 mt-3 text-lg">Ikuti tahapan berikut untuk mendaftar</p>
                </div>
                <div class="relative">
                    <div class="hidden lg:block absolute top-16 left-[12%] right-[12%] h-0.5" style="background: var(--warna-primary); opacity: 0.2"></div>
                    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($tahapan as $item)
                            <div class="relative flex flex-col items-center text-center group">
                                 <div class="w-14 h-14 text-white rounded-2xl flex items-center justify-center font-bold text-lg mb-5 relative z-10 shadow-lg transition-transform duration-300 group-hover:scale-110 theme-bg">{{ $loop->iteration }}</div>
                                <div class="bg-white dark:bg-slate-900 rounded-3xl p-6 border border-gray-200/80 dark:border-slate-800 w-full transition-all duration-300 group-hover:shadow-lg group-hover:shadow-black/[0.06] dark:group-hover:shadow-black/30">
                                    <h3 class="font-bold text-gray-900 dark:text-white mb-2">{{ $item->judul }}</h3>
                                    <p class="text-gray-600 dark:text-slate-400 text-sm leading-relaxed">{{ $item->deskripsi }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- BERITA --}}
    @if($berita->isNotEmpty())
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-24 reveal">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-10">
                <div>
                    <span class="inline-block px-4 py-1.5 rounded-full text-sm font-semibold mb-3" style="background-color: color-mix(in srgb, var(--warna-primary) 10%, transparent); color: var(--warna-primary)">Berita</span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 dark:text-white tracking-tight">Berita Terbaru</h2>
                    <p class="text-gray-500 dark:text-slate-400 mt-2 text-lg">Informasi terkini dari sekolah</p>
                </div>
                <a href="{{ route('public.berita.index') }}" class="group inline-flex items-center gap-1 font-semibold text-sm transition-all duration-200 hover:gap-2" style="color: var(--warna-primary)">
                    Lihat Semua
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-7">
                @foreach($berita as $item)
                    <a href="{{ route('public.berita.show', $item->slug) }}" class="bg-white dark:bg-slate-900 rounded-3xl border border-gray-200/80 dark:border-slate-800 overflow-hidden transition-all duration-300 hover:shadow-xl hover:shadow-black/[0.06] dark:hover:shadow-black/30 hover:-translate-y-1 group">
                        @if($item->thumbnail)
                            <div class="overflow-hidden">
                                <img src="{{ Storage::url($item->thumbnail) }}" alt="{{ $item->judul }}" class="w-full h-52 object-cover group-hover:scale-105 transition-transform duration-500">
                            </div>
                        @else
                            <div class="w-full h-52 flex items-center justify-center theme-bg-light">
                                <svg class="h-14 w-14" style="color: var(--warna-primary); opacity: 0.3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                            </div>
                        @endif
                        <div class="p-6">
                            <p class="text-xs text-gray-400 dark:text-slate-500 mb-2 font-semibold uppercase tracking-wider">{{ $item->created_at->translatedFormat('d M Y') }}</p>
                            <h3 class="font-bold text-gray-900 dark:text-white group-hover:transition mb-3 line-clamp-2 text-lg" style="group-hover:color: var(--warna-primary)">{{ $item->judul }}</h3>
                            <p class="text-gray-600 dark:text-slate-400 text-sm line-clamp-3 leading-relaxed">{{ Str::limit(strip_tags($item->konten), 150) }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    @endif

    {{-- GALERI --}}
    @if($galeri->isNotEmpty())
        <section class="py-20 lg:py-24 bg-gray-100/80 dark:bg-slate-900/50 reveal">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-14">
                    <span class="inline-block px-4 py-1.5 rounded-full text-sm font-semibold mb-4" style="background-color: color-mix(in srgb, var(--warna-primary) 10%, transparent); color: var(--warna-primary)">Galeri</span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 dark:text-white tracking-tight">Galeri Foto</h2>
                    <p class="text-gray-500 dark:text-slate-400 mt-3 text-lg">Dokumentasi kegiatan sekolah</p>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach($galeri as $item)
                        <a href="{{ Storage::url($item->gambar) }}" target="_blank" class="group relative rounded-2xl overflow-hidden aspect-square bg-gray-200 dark:bg-slate-700">
                            <img src="{{ Storage::url($item->gambar) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition-all duration-300 flex items-center justify-center">
                                <div class="w-12 h-12 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 group-hover:scale-100 scale-75">
                                    <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                                </div>
                            </div>
                            <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/70 via-black/20 to-transparent">
                                <p class="text-white text-sm font-semibold truncate">{{ $item->judul }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- VIDEO --}}
    @if(isset($video) && $video->isNotEmpty())
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-24 reveal">
            <div class="text-center mb-14">
                <span class="inline-block px-4 py-1.5 rounded-full text-sm font-semibold mb-4" style="background-color: color-mix(in srgb, var(--warna-primary) 10%, transparent); color: var(--warna-primary)">Video</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 dark:text-white tracking-tight">Video Profil</h2>
                <p class="text-gray-500 dark:text-slate-400 mt-3 text-lg">Video profil dan kegiatan sekolah</p>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-7">
                @foreach($video as $item)
                    <div class="group">
                        <div class="aspect-video rounded-3xl overflow-hidden bg-gray-900 shadow-lg shadow-black/10 transition-shadow duration-300 group-hover:shadow-xl group-hover:shadow-black/20">
                            <iframe class="w-full h-full" src="{{ str_replace('watch?v=', 'embed/', $item->youtube_url) }}" frameborder="0" allowfullscreen title="{{ $item->judul }}"></iframe>
                        </div>
                        @if($item->judul)
                            <p class="mt-3 text-sm font-semibold text-gray-900 dark:text-white">{{ $item->judul }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    {{-- TESTIMONI --}}
    @if($testimoni->isNotEmpty())
        <section class="py-20 lg:py-24 bg-gray-100/80 dark:bg-slate-900/50 reveal">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-14">
                    <span class="inline-block px-4 py-1.5 rounded-full text-sm font-semibold mb-4" style="background-color: color-mix(in srgb, var(--warna-primary) 10%, transparent); color: var(--warna-primary)">Testimoni</span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 dark:text-white tracking-tight">Apa Kata Mereka</h2>
                    <p class="text-gray-500 dark:text-slate-400 mt-3 text-lg">Testimoni dari peserta, orang tua, dan mitra</p>
                </div>
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($testimoni as $item)
                        <div class="bg-white dark:bg-slate-900 rounded-3xl p-7 border border-gray-200/80 dark:border-slate-800 relative transition-all duration-300 hover:shadow-lg hover:shadow-black/[0.04] dark:hover:shadow-black/20">
                            <svg class="absolute top-6 right-6 h-10 w-10 opacity-[0.06]" style="color: var(--warna-primary)" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
                            <div class="flex items-center mb-5">
                                @if($item->foto)
                                    <img src="{{ Storage::url($item->foto) }}" alt="{{ $item->nama }}" class="w-12 h-12 rounded-full object-cover ring-2 ring-white dark:ring-slate-800 mr-3">
                                @else
                                    <div class="w-12 h-12 rounded-full flex items-center justify-center mr-3 font-bold text-lg text-white theme-bg">{{ substr($item->nama, 0, 1) }}</div>
                                @endif
                                <div>
                                    <p class="font-bold text-gray-900 dark:text-white">{{ $item->nama }}</p>
                                </div>
                            </div>
                            <p class="text-gray-600 dark:text-slate-400 text-sm italic leading-relaxed relative z-10">"{{ $item->isi }}"</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- FAQ --}}
    @if(isset($faq) && $faq->isNotEmpty())
        <section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-24 reveal">
            <div class="text-center mb-14">
                <span class="inline-block px-4 py-1.5 rounded-full text-sm font-semibold mb-4" style="background-color: color-mix(in srgb, var(--warna-primary) 10%, transparent); color: var(--warna-primary)">FAQ</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 dark:text-white tracking-tight">Pertanyaan Umum</h2>
                <p class="text-gray-500 dark:text-slate-400 mt-3 text-lg">Jawaban atas pertanyaan yang sering ditanyakan</p>
            </div>
            <div class="space-y-3">
                @foreach($faq as $item)
                    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-gray-200/80 dark:border-slate-800 overflow-hidden transition-all duration-300 hover:shadow-lg hover:shadow-black/[0.04] dark:hover:shadow-black/20" x-data="{ open: false }">
                        <button @click="open = !open" class="w-full flex items-center justify-between p-6 text-left">
                            <span class="font-semibold text-gray-900 dark:text-white pr-4">{{ $item->judul }}</span>
                            <svg class="w-5 h-5 shrink-0 transition-transform duration-300" :class="{ 'rotate-180': open }" style="color: var(--warna-primary)" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="open" x-collapse x-cloak>
                            <div class="px-6 pb-6 text-gray-600 dark:text-slate-400 text-sm leading-relaxed border-t border-gray-50 dark:border-slate-800 pt-4">
                                {!! nl2br(e($item->jawaban ?? $item->deskripsi ?? '')) !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    {{-- JADWAL --}}
    @if(isset($jadwal) && $jadwal->isNotEmpty())
        <section class="py-20 lg:py-24 bg-gray-100/80 dark:bg-slate-900/50 reveal">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-14">
                    <span class="inline-block px-4 py-1.5 rounded-full text-sm font-semibold mb-4" style="background-color: color-mix(in srgb, var(--warna-primary) 10%, transparent); color: var(--warna-primary)">Jadwal</span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 dark:text-white tracking-tight">Jadwal PPDB</h2>
                    <p class="text-gray-500 dark:text-slate-400 mt-3 text-lg">Jadwal penting penerimaan peserta didik baru</p>
                </div>
                <div class="bg-white dark:bg-slate-900 rounded-3xl border border-gray-200/80 dark:border-slate-800 overflow-hidden max-w-4xl mx-auto shadow-xl shadow-black/[0.04] dark:shadow-black/20">
                    <div class="divide-y divide-gray-100 dark:divide-slate-800">
                        @foreach($jadwal as $item)
                            <div class="flex items-center gap-4 sm:gap-5 p-5 sm:p-6 hover:bg-gray-50/50 dark:hover:bg-slate-800/50 transition-colors duration-200">
                                <div class="w-14 h-14 rounded-2xl flex flex-col items-center justify-center shrink-0 text-white shadow-lg theme-bg">
                                    <span class="text-xs font-bold uppercase leading-none">{{ $item->created_at->translatedFormat('M') }}</span>
                                    <span class="text-lg font-extrabold leading-none">{{ $item->created_at->format('d') }}</span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="font-bold text-gray-900 dark:text-white">{{ $item->judul }}</h3>
                                    @if($item->deskripsi)
                                        <p class="text-sm text-gray-500 dark:text-slate-400 mt-1 line-clamp-2">{{ $item->deskripsi }}</p>
                                    @endif
                                </div>
                                @if($item->tanggal_mulai)
                                    <div class="hidden sm:block text-right shrink-0">
                                        <p class="text-sm font-semibold" style="color: var(--warna-primary)">{{ $item->tanggal_mulai->translatedFormat('d M Y') }}</p>
                                        @if($item->tanggal_selesai)
                                            <p class="text-xs text-gray-400 dark:text-slate-500 mt-0.5">s/d {{ $item->tanggal_selesai->translatedFormat('d M Y') }}</p>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- CTA --}}
    @auth
        <section class="py-20 lg:py-24 relative overflow-hidden" style="background-color: var(--warna-primary)">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute -top-24 -right-24 w-96 h-96 bg-white rounded-full blur-3xl"></div>
                <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-white rounded-full blur-3xl"></div>
            </div>
            <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
                <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight mb-4">Siap Mendaftar?</h2>
                <p class="text-lg text-white/80 mb-8 max-w-2xl mx-auto">Daftarkan diri Anda sekarang dan jadilah bagian dari sekolah kami. Proses pendaftaran mudah dan cepat.</p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 px-8 py-3.5 bg-white font-semibold rounded-2xl transition-all duration-200 hover:shadow-xl hover:shadow-black/10 hover:-translate-y-0.5" style="color: var(--warna-primary)">
                        Buka Dashboard
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                    </a>
                </div>
            </div>
        </section>
    @endauth

</x-layouts.public>
