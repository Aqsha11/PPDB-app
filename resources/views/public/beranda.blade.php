<x-layouts.public title="Beranda">
    @if($hero->isNotEmpty())
        <section class="relative bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 text-white overflow-hidden">
            @foreach($hero as $item)
                @if($item->gambar)
                    <div class="absolute inset-0">
                        <img src="{{ Storage::url($item->gambar) }}" alt="" class="w-full h-full object-cover opacity-30">
                    </div>
                @endif
                <div class="absolute inset-0 bg-black/30"></div>
                <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-28 sm:py-36">
                    <div class="max-w-3xl">
                        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold leading-tight mb-6">
                            {{ $item->judul ?? 'Selamat Datang di ' . config('app.name', 'PPDB') }}
                        </h1>
                        @if($item->sub_judul)
                            <p class="text-lg sm:text-xl text-blue-100 mb-8 leading-relaxed">{{ $item->sub_judul }}</p>
                        @endif
                        @if($item->deskripsi)
                            <p class="text-base sm:text-lg text-blue-100/90 mb-8 leading-relaxed">{{ $item->deskripsi }}</p>
                        @endif
                        <div class="flex flex-wrap gap-4">
                            @auth
                                <a href="{{ route('dashboard') }}" class="inline-flex items-center px-6 py-3 bg-yellow-400 text-blue-900 font-semibold rounded-lg hover:bg-yellow-300 transition shadow-lg">
                                    Dashboard Saya
                                    <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                                </a>
                            @else
                                <a href="{{ route('register') }}" class="inline-flex items-center px-6 py-3 bg-yellow-400 text-blue-900 font-semibold rounded-lg hover:bg-yellow-300 transition shadow-lg">
                                    Daftar Sekarang
                                    <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                                </a>
                                <a href="{{ route('login') }}" class="inline-flex items-center px-6 py-3 bg-white/10 text-white font-semibold rounded-lg hover:bg-white/20 transition backdrop-blur-sm border border-white/20">
                                    Masuk
                                </a>
                            @endauth
                            @if($item->button_text && $item->button_link)
                                <a href="{{ $item->button_link }}" class="inline-flex items-center px-6 py-3 bg-white text-blue-700 font-semibold rounded-lg hover:bg-blue-50 transition shadow-lg">
                                    {{ $item->button_text }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="absolute bottom-0 left-0 right-0 h-24 bg-gradient-to-t from-gray-50 to-transparent"></div>
        </section>
    @endif

    @if($profil)
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900">Profil Sekolah</h2>
                <p class="text-gray-500 mt-2">Informasi lengkap tentang sekolah kami</p>
            </div>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="md:flex">
                    @if($profil->logo)
                        <div class="md:w-2/5 shrink-0">
                            <img src="{{ Storage::url($profil->logo) }}" alt="{{ $profil->nama_sekolah }}" class="w-full h-72 md:h-full object-cover">
                        </div>
                    @endif
                    <div class="p-8 md:p-10 flex-1">
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ $profil->nama_sekolah }}</h3>
                        @if($profil->sejarah)
                            <p class="text-gray-600 leading-relaxed mb-6">{{ Str::limit(strip_tags($profil->sejarah), 300) }}</p>
                        @endif
                        <div class="grid sm:grid-cols-2 gap-6">
                            @if($profil->visi)
                                <div class="bg-blue-50 rounded-xl p-5">
                                    <h4 class="font-semibold text-blue-800 mb-2">Visi</h4>
                                    <p class="text-blue-700 text-sm leading-relaxed">{{ $profil->visi }}</p>
                                </div>
                            @endif
                            @if($profil->misi)
                                <div class="bg-green-50 rounded-xl p-5">
                                    <h4 class="font-semibold text-green-800 mb-2">Misi</h4>
                                    <p class="text-green-700 text-sm leading-relaxed">{{ $profil->misi }}</p>
                                </div>
                            @endif
                        </div>
                        @if($profil->alamat || $profil->email || $profil->telepon)
                            <div class="mt-6 pt-6 border-t border-gray-100 grid sm:grid-cols-3 gap-4 text-sm">
                                @if($profil->alamat)
                                    <div>
                                        <span class="font-medium text-gray-900">Alamat</span>
                                        <p class="text-gray-600">{{ $profil->alamat }}</p>
                                    </div>
                                @endif
                                @if($profil->email)
                                    <div>
                                        <span class="font-medium text-gray-900">Email</span>
                                        <p class="text-gray-600">{{ $profil->email }}</p>
                                    </div>
                                @endif
                                @if($profil->telepon)
                                    <div>
                                        <span class="font-medium text-gray-900">Telepon</span>
                                        <p class="text-gray-600">{{ $profil->telepon }}</p>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if($sambutan)
        <section class="bg-gray-50 py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900">Sambutan {{ $sambutan->jabatan ?? 'Kepala Sekolah' }}</h2>
                </div>
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="md:flex items-center">
                        @if($sambutan->foto)
                            <div class="md:w-1/3 shrink-0">
                                <img src="{{ Storage::url($sambutan->foto) }}" alt="{{ $sambutan->nama }}" class="w-full h-72 md:h-96 object-cover">
                            </div>
                        @else
                            <div class="md:w-1/3 shrink-0 bg-blue-100 flex items-center justify-center h-72 md:h-96">
                                <span class="text-6xl text-blue-400 font-bold">{{ substr($sambutan->nama, 0, 1) }}</span>
                            </div>
                        @endif
                        <div class="p-8 md:p-12 flex-1">
                            <div class="prose prose-gray max-w-none text-gray-600 leading-relaxed mb-6">
                                {!! nl2br(e($sambutan->isi)) !!}
                            </div>
                            <div class="border-t pt-4">
                                <p class="font-semibold text-gray-900">{{ $sambutan->nama }}</p>
                                <p class="text-sm text-blue-600">{{ $sambutan->jabatan ?? 'Kepala Sekolah' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if($statistik->isNotEmpty())
        <section class="bg-gradient-to-r from-blue-600 to-indigo-700 py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                    @foreach($statistik as $item)
                        <div class="text-center text-white">
                            @if($item->icon)
                                <div class="text-3xl mb-3">{!! $item->icon !!}</div>
                            @endif
                            <div class="text-4xl font-bold mb-1">{{ $item->jumlah }}</div>
                            <div class="text-blue-200 text-sm font-medium">{{ $item->judul }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if($keunggulan->isNotEmpty())
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900">Keunggulan Sekolah Kami</h2>
                <p class="text-gray-500 mt-2">Mengapa memilih sekolah kami</p>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($keunggulan as $item)
                    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-lg hover:border-blue-100 transition group">
                        @if($item->icon)
                            <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center mb-5 text-2xl group-hover:bg-blue-600 group-hover:text-white transition">{!! $item->icon !!}</div>
                        @endif
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $item->judul }}</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">{{ $item->deskripsi }}</p>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    @if($tahapan->isNotEmpty())
        <section class="bg-gray-50 py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900">Tahapan PPDB</h2>
                    <p class="text-gray-500 mt-2">Ikuti tahapan berikut untuk mendaftar</p>
                </div>
                <div class="relative">
                    <div class="hidden lg:block absolute top-12 left-0 right-0 h-0.5 bg-blue-200"></div>
                    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($tahapan as $item)
                            <div class="relative flex flex-col items-center text-center">
                                <div class="w-12 h-12 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold text-lg mb-4 relative z-10 shadow-md">{{ $loop->iteration }}</div>
                                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 w-full">
                                    <h3 class="font-semibold text-gray-900 mb-2">{{ $item->judul }}</h3>
                                    <p class="text-gray-600 text-sm leading-relaxed">{{ $item->deskripsi }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if($berita->isNotEmpty())
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900">Berita Terbaru</h2>
                    <p class="text-gray-500 mt-1">Informasi terkini dari sekolah</p>
                </div>
                <a href="{{ route('public.berita.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium text-sm">
                    Lihat Semua
                    <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($berita as $item)
                    <a href="{{ route('public.berita.show', $item->slug) }}" class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition group">
                        @if($item->thumbnail)
                            <img src="{{ Storage::url($item->thumbnail) }}" alt="{{ $item->judul }}" class="w-full h-48 object-cover group-hover:scale-105 transition duration-300">
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-blue-100 to-blue-50 flex items-center justify-center">
                                <svg class="h-12 w-12 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                            </div>
                        @endif
                        <div class="p-5">
                            <p class="text-sm text-gray-500 mb-2">{{ $item->created_at->format('d M Y') }}</p>
                            <h3 class="font-semibold text-gray-900 group-hover:text-blue-600 transition mb-2 line-clamp-2">{{ $item->judul }}</h3>
                            <p class="text-gray-600 text-sm line-clamp-3">{{ Str::limit(strip_tags($item->konten), 150) }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    @endif

    @if($galeri->isNotEmpty())
        <section class="bg-gray-50 py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900">Galeri</h2>
                    <p class="text-gray-500 mt-2">Dokumentasi kegiatan sekolah</p>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach($galeri as $item)
                        <a href="{{ Storage::url($item->gambar) }}" target="_blank" class="group relative rounded-xl overflow-hidden aspect-square shadow-sm">
                            <img src="{{ Storage::url($item->gambar) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition duration-300 flex items-center justify-center">
                                <svg class="h-8 w-8 text-white opacity-0 group-hover:opacity-100 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                            </div>
                            <div class="absolute bottom-0 left-0 right-0 p-3 bg-gradient-to-t from-black/60 to-transparent">
                                <p class="text-white text-sm font-medium truncate">{{ $item->judul }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if($video->isNotEmpty())
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900">Video</h2>
                <p class="text-gray-500 mt-2">Video profil dan kegiatan sekolah</p>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($video as $item)
                    <div>
                        <div class="aspect-video rounded-xl overflow-hidden shadow-sm bg-gray-100">
                            <iframe class="w-full h-full" src="{{ str_replace('watch?v=', 'embed/', $item->youtube_url) }}" frameborder="0" allowfullscreen title="{{ $item->judul }}"></iframe>
                        </div>
                        @if($item->judul)
                            <p class="mt-2 text-sm font-medium text-gray-900">{{ $item->judul }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    @if($testimoni->isNotEmpty())
        <section class="bg-gray-50 py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900">Testimoni</h2>
                    <p class="text-gray-500 mt-2">Apa kata mereka tentang sekolah kami</p>
                </div>
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($testimoni as $item)
                        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition">
                            <div class="flex items-center mb-4">
                                @if($item->foto)
                                    <img src="{{ Storage::url($item->foto) }}" alt="{{ $item->nama }}" class="w-12 h-12 rounded-full object-cover mr-3">
                                @else
                                    <div class="w-12 h-12 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center mr-3 font-bold text-lg">{{ substr($item->nama, 0, 1) }}</div>
                                @endif
                                <div>
                                    <p class="font-semibold text-gray-900">{{ $item->nama }}</p>
                                </div>
                            </div>
                            <div class="relative">
                                <svg class="absolute -top-1 -left-1 h-6 w-6 text-blue-200 opacity-50" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
                                <p class="text-gray-600 text-sm italic leading-relaxed pl-4">"{{ $item->isi }}"</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if($partner->isNotEmpty())
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center mb-10">
                <h2 class="text-2xl font-bold text-gray-900">Mitra Kami</h2>
                <p class="text-gray-500 mt-1">Lembaga dan instansi yang bekerja sama dengan kami</p>
            </div>
            <div class="flex flex-wrap items-center justify-center gap-10">
                @foreach($partner as $item)
                    <a href="{{ $item->website }}" target="_blank" rel="noopener noreferrer" class="grayscale hover:grayscale-0 transition duration-300" title="{{ $item->nama }}">
                        <img src="{{ Storage::url($item->logo) }}" alt="{{ $item->nama }}" class="h-14 w-auto object-contain">
                    </a>
                @endforeach
            </div>
        </section>
    @endif
</x-layouts.public>
