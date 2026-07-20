<x-layouts.public title="Pengumuman">
    <div class="relative overflow-hidden" style="background-color: var(--warna-primary)">
        <div class="absolute inset-0 opacity-10"><div class="absolute -top-20 -right-20 w-72 h-72 bg-white rounded-full blur-3xl"></div><div class="absolute -bottom-20 -left-20 w-72 h-72 bg-white rounded-full blur-3xl"></div></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20">
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight">Pengumuman</h1>
            <p class="text-white/70 mt-3 text-lg">Informasi resmi dan pengumuman dari sekolah</p>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-16">
        @if($data->isEmpty())
            <div class="text-center py-24">
                <div class="w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-6" style="background-color: color-mix(in srgb, var(--warna-primary) 10%, transparent)">
                    <svg class="h-10 w-10" style="color: var(--warna-primary)" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
                </div>
                <p class="text-gray-700 dark:text-slate-300 text-lg font-semibold">Belum ada pengumuman.</p>
                <p class="text-gray-400 dark:text-slate-500 text-sm mt-1">Silakan kembali lagi nanti.</p>
            </div>
        @else
            <div class="space-y-4">
                @foreach($data as $item)
                    <a href="{{ route('public.pengumuman.show', $item->slug) }}" class="block bg-white dark:bg-slate-900 rounded-2xl p-6 sm:p-7 border border-gray-200/80 dark:border-slate-800 transition-all duration-300 hover:shadow-xl hover:shadow-black/[0.06] dark:hover:shadow-black/30 hover:-translate-y-0.5 group">
                        <div class="flex items-start gap-4 sm:gap-5">
                            <div class="hidden sm:flex w-14 h-14 rounded-2xl items-center justify-center shrink-0 theme-bg-light">
                                <svg class="h-6 w-6" style="color: var(--warna-primary)" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-3 text-xs text-gray-400 dark:text-slate-500 mb-2 font-semibold uppercase tracking-wider">
                                    <span class="flex items-center">
                                        <svg class="h-4 w-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        {{ $item->created_at->translatedFormat('d M Y') }}
                                    </span>
                                </div>
                                <h2 class="text-lg font-bold text-gray-900 dark:text-white group-hover:transition" style="group-hover:color: var(--warna-primary)">{{ $item->judul }}</h2>
                                <p class="text-gray-500 dark:text-slate-400 text-sm mt-2 line-clamp-2 leading-relaxed">{{ Str::limit(strip_tags($item->isi), 200) }}</p>
                            </div>
                            <svg class="hidden sm:block h-5 w-5 text-gray-300 dark:text-slate-600 group-hover:transition shrink-0 mt-1" style="group-hover:color: var(--warna-primary)" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
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
