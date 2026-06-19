<x-layouts.public :title="$data->judul">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <a href="{{ route('public.berita.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-700 mb-8 font-medium">
            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Kembali ke Berita
        </a>
        <div class="lg:grid lg:grid-cols-3 lg:gap-12">
            <div class="lg:col-span-2">
                <article class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    @if($data->thumbnail)
                        <img src="{{ Storage::url($data->thumbnail) }}" alt="{{ $data->judul }}" class="w-full h-72 sm:h-96 object-cover">
                    @endif
                    <div class="p-8 sm:p-10">
                        <div class="flex items-center text-sm text-gray-500 mb-4">
                            <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            {{ $data->created_at->format('d F Y') }}
                        </div>
                        <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-6 leading-tight">{{ $data->judul }}</h1>
                        <div class="prose prose-gray max-w-none text-gray-700 leading-relaxed">
                            {!! nl2br(e($data->konten)) !!}
                        </div>
                    </div>
                </article>
            </div>
            <div class="mt-10 lg:mt-0">
                @if($beritaLainnya->isNotEmpty())
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sticky top-24">
                        <h3 class="text-lg font-bold text-gray-900 mb-5">Berita Lainnya</h3>
                        <div class="space-y-4">
                            @foreach($beritaLainnya as $item)
                                <a href="{{ route('public.berita.show', $item->slug) }}" class="flex gap-4 group">
                                    @if($item->thumbnail)
                                        <img src="{{ Storage::url($item->thumbnail) }}" alt="{{ $item->judul }}" class="w-16 h-16 rounded-lg object-cover shrink-0">
                                    @else
                                        <div class="w-16 h-16 rounded-lg bg-blue-50 flex items-center justify-center shrink-0">
                                            <svg class="h-6 w-6 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                                        </div>
                                    @endif
                                    <div class="flex-1 min-w-0">
                                        <p class="text-xs text-gray-500">{{ $item->created_at->format('d M Y') }}</p>
                                        <p class="text-sm font-medium text-gray-900 group-hover:text-blue-600 transition line-clamp-2">{{ $item->judul }}</p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                        <a href="{{ route('public.berita.index') }}" class="inline-flex items-center text-blue-600 text-sm font-medium mt-5 hover:text-blue-700">
                            Lihat Semua Berita
                            <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.public>
