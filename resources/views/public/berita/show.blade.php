<x-layouts.public :title="$data->judul">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
        <a href="{{ route('public.berita.index') }}" class="inline-flex items-center gap-1 font-semibold mb-8 transition-all duration-200 hover:gap-2 group" style="color: var(--warna-primary)">
            <svg class="h-5 w-5 transition-transform duration-200 group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Kembali ke Berita
        </a>

        <div class="lg:grid lg:grid-cols-3 lg:gap-12">
            <div class="lg:col-span-2">
                <article class="bg-white dark:bg-slate-900 rounded-3xl border border-gray-200/80 dark:border-slate-800 overflow-hidden shadow-lg shadow-black/[0.04] dark:shadow-black/20">
                    @if($data->thumbnail)
                        <img src="{{ Storage::url($data->thumbnail) }}" alt="{{ $data->judul }}" class="w-full h-72 sm:h-96 object-cover">
                    @endif
                    <div class="p-5 sm:p-8 lg:p-10">
                        <div class="flex items-center text-xs text-gray-400 dark:text-slate-500 mb-5 font-semibold uppercase tracking-wider">
                            <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            {{ $data->created_at->translatedFormat('d F Y') }}
                        </div>
                        <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 dark:text-white mb-8 leading-tight tracking-tight">{{ $data->judul }}</h1>
                        <div class="prose prose-lg prose-gray dark:prose-invert max-w-none text-gray-600 dark:text-slate-400 leading-relaxed">
                            {!! nl2br(e($data->konten)) !!}
                        </div>
                    </div>
                </article>
            </div>

            <div class="mt-10 lg:mt-0">
                @if($beritaLainnya->isNotEmpty())
                    <div class="bg-white dark:bg-slate-900 rounded-3xl border border-gray-200/80 dark:border-slate-800 p-6 sticky top-28 shadow-lg shadow-black/[0.04] dark:shadow-black/20">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-6 pb-4 border-b border-gray-100 dark:border-slate-800">Berita Lainnya</h3>
                        <div class="space-y-5">
                            @foreach($beritaLainnya as $item)
                                <a href="{{ route('public.berita.show', $item->slug) }}" class="flex gap-4 group">
                                    @if($item->thumbnail)
                                        <img src="{{ Storage::url($item->thumbnail) }}" alt="{{ $item->judul }}" class="w-16 h-16 rounded-xl object-cover shrink-0">
                                    @else
                                        <div class="w-16 h-16 rounded-xl flex items-center justify-center shrink-0 theme-bg-light">
                                            <svg class="h-6 w-6" style="color: var(--warna-primary); opacity: 0.3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                                        </div>
                                    @endif
                                    <div class="flex-1 min-w-0">
                                        <p class="text-xs text-gray-400 dark:text-slate-500 font-semibold">{{ $item->created_at->translatedFormat('d M Y') }}</p>
                                        <p class="text-sm font-semibold text-gray-900 dark:text-white group-hover:transition line-clamp-2 mt-0.5" style="group-hover:color: var(--warna-primary)">{{ $item->judul }}</p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                        <a href="{{ route('public.berita.index') }}" class="inline-flex items-center gap-1 text-sm font-semibold mt-6 pt-4 border-t border-gray-100 dark:border-slate-800 w-full justify-center transition-all duration-200 group" style="color: var(--warna-primary)">
                            Lihat Semua Berita
                            <svg class="h-4 w-4 transition-transform duration-200 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.public>
