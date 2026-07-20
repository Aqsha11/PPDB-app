<x-layouts.public :title="$data->judul">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
        <a href="{{ route('public.pengumuman.index') }}" class="inline-flex items-center gap-1 font-semibold mb-8 transition-all duration-200 hover:gap-2 group" style="color: var(--warna-primary)">
            <svg class="h-5 w-5 transition-transform duration-200 group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Kembali ke Pengumuman
        </a>

        <article class="bg-white dark:bg-slate-900 rounded-3xl border border-gray-200/80 dark:border-slate-800 overflow-hidden shadow-lg shadow-black/[0.04] dark:shadow-black/20">
            <div class="p-5 sm:p-8 lg:p-10">
                <div class="flex items-center gap-3 text-xs text-gray-400 dark:text-slate-500 mb-5 font-semibold uppercase tracking-wider">
                    <span class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0 theme-bg-light">
                        <svg class="h-5 w-5" style="color: var(--warna-primary)" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
                    </span>
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    {{ $data->created_at->translatedFormat('d F Y') }}
                </div>
                <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 dark:text-white mb-8 leading-tight tracking-tight">{{ $data->judul }}</h1>
                <div class="prose prose-lg prose-gray dark:prose-invert max-w-none text-gray-600 dark:text-slate-400 leading-relaxed">
                    {!! nl2br(e($data->isi)) !!}
                </div>
                @if($data->lampiran)
                    <div class="mt-10 pt-8 border-t border-gray-100 dark:border-slate-800">
                        <a href="{{ Storage::url($data->lampiran) }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-2xl font-semibold transition-all duration-200 text-white hover:shadow-lg hover:shadow-black/10 hover:-translate-y-0.5 btn-theme">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Download Lampiran
                        </a>
                    </div>
                @endif
            </div>
        </article>
    </div>
</x-layouts.public>
