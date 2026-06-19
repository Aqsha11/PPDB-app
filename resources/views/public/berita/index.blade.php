<x-layouts.public title="Berita">
    <div class="bg-gray-50 border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <h1 class="text-3xl font-bold text-gray-900">Berita Terbaru</h1>
            <p class="text-gray-500 mt-2">Informasi dan kegiatan terbaru dari sekolah</p>
        </div>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @if($data->isEmpty())
            <div class="text-center py-20">
                <svg class="h-20 w-20 mx-auto mb-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                <p class="text-gray-500 text-lg">Belum ada berita.</p>
                <p class="text-gray-400 text-sm mt-1">Silakan kembali lagi nanti untuk melihat informasi terbaru.</p>
            </div>
        @else
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($data as $item)
                    <a href="{{ route('public.berita.show', $item->slug) }}" class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition group">
                        @if($item->thumbnail)
                            <div class="overflow-hidden">
                                <img src="{{ Storage::url($item->thumbnail) }}" alt="{{ $item->judul }}" class="w-full h-52 object-cover group-hover:scale-105 transition duration-500">
                            </div>
                        @else
                            <div class="w-full h-52 bg-gradient-to-br from-blue-100 to-blue-50 flex items-center justify-center">
                                <svg class="h-14 w-14 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                            </div>
                        @endif
                        <div class="p-5">
                            <div class="flex items-center text-sm text-gray-500 mb-3">
                                <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                {{ $item->created_at->format('d M Y') }}
                            </div>
                            <h2 class="text-lg font-semibold text-gray-900 group-hover:text-blue-600 transition mb-2 line-clamp-2">{{ $item->judul }}</h2>
                            <p class="text-gray-600 text-sm leading-relaxed line-clamp-3">{{ Str::limit(strip_tags($item->konten), 150) }}</p>
                            <span class="inline-flex items-center text-blue-600 text-sm font-medium mt-4 group-hover:text-blue-700">
                                Baca Selengkapnya
                                <svg class="ml-1 h-4 w-4 transition group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
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
