<x-layouts.public title="Berita">
    <div class="relative overflow-hidden" style="background-color: var(--warna-primary)">
        <div class="absolute inset-0 opacity-10"><div class="absolute -top-20 -right-20 w-72 h-72 bg-white rounded-full blur-3xl"></div><div class="absolute -bottom-20 -left-20 w-72 h-72 bg-white rounded-full blur-3xl"></div></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20">
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight">Berita Terbaru</h1>
            <p class="text-white/70 mt-3 text-lg">Informasi dan kegiatan terbaru dari sekolah</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-16">
        @if($data->isEmpty())
            <div class="text-center py-24">
                <div class="w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-6" style="background-color: color-mix(in srgb, var(--warna-primary) 10%, transparent)">
                    <svg class="h-10 w-10" style="color: var(--warna-primary)" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                </div>
                <p class="text-gray-700 dark:text-slate-300 text-lg font-semibold">Belum ada berita.</p>
                <p class="text-gray-400 dark:text-slate-500 text-sm mt-1">Silakan kembali lagi nanti untuk melihat informasi terbaru.</p>
            </div>
        @else
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-7">
                @foreach($data as $item)
                    <a href="{{ route('public.berita.show', $item->slug) }}" class="bg-white dark:bg-slate-900 rounded-3xl border border-gray-200/80 dark:border-slate-800 overflow-hidden transition-all duration-300 hover:shadow-xl hover:shadow-black/[0.06] dark:hover:shadow-black/30 hover:-translate-y-1 group">
                        @if($item->thumbnail)
                            <div class="overflow-hidden">
                                <img src="{{ Storage::url($item->thumbnail) }}" alt="{{ $item->judul }}" class="w-full h-52 object-cover group-hover:scale-105 transition-transform duration-500">
                            </div>
                        @else
                            <div class="w-full h-52 flex items-center justify-center" style="background-color: color-mix(in srgb, var(--warna-primary) 8%, transparent)">
                                <svg class="h-14 w-14" style="color: var(--warna-primary); opacity: 0.3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                            </div>
                        @endif
                        <div class="p-6">
                            <div class="flex items-center text-xs text-gray-400 dark:text-slate-500 mb-3 font-semibold uppercase tracking-wider">
                                <svg class="h-4 w-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                {{ $item->created_at->translatedFormat('d M Y') }}
                            </div>
                            <h2 class="text-lg font-bold text-gray-900 dark:text-white group-hover:transition mb-3 line-clamp-2" style="group-hover:color: var(--warna-primary)">{{ $item->judul }}</h2>
                            <p class="text-gray-600 dark:text-slate-400 text-sm leading-relaxed line-clamp-3">{{ Str::limit(strip_tags($item->konten), 150) }}</p>
                            <span class="inline-flex items-center text-sm font-semibold mt-5 transition-all duration-200 group-hover:gap-2" style="color: var(--warna-primary)">
                                Baca Selengkapnya
                                <svg class="ml-1 h-4 w-4 transition-transform duration-200 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="mt-12">
                {{ $data->links() }}
            </div>
        @endif
    </div>
</x-layouts.public>
