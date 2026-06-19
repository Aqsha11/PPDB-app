<x-layouts.public title="Pengumuman">
    <div class="bg-gray-50 border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <h1 class="text-3xl font-bold text-gray-900">Pengumuman</h1>
            <p class="text-gray-500 mt-2">Informasi resmi dan pengumuman dari sekolah</p>
        </div>
    </div>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @if($data->isEmpty())
            <div class="text-center py-20">
                <svg class="h-20 w-20 mx-auto mb-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
                <p class="text-gray-500 text-lg">Belum ada pengumuman.</p>
                <p class="text-gray-400 text-sm mt-1">Silakan kembali lagi nanti.</p>
            </div>
        @else
            <div class="space-y-4">
                @foreach($data as $item)
                    <a href="{{ route('public.pengumuman.show', $item->slug) }}" class="block bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md hover:border-blue-100 transition group">
                        <div class="flex items-start gap-4">
                            <div class="hidden sm:flex w-12 h-12 bg-blue-50 text-blue-600 rounded-lg items-center justify-center shrink-0">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-3 text-sm text-gray-500 mb-1">
                                    <span class="flex items-center">
                                        <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        {{ $item->created_at->format('d M Y') }}
                                    </span>
                                </div>
                                <h2 class="text-lg font-semibold text-gray-900 group-hover:text-blue-600 transition">{{ $item->judul }}</h2>
                                <p class="text-gray-600 text-sm mt-2 line-clamp-2">{{ Str::limit(strip_tags($item->isi), 200) }}</p>
                            </div>
                            <svg class="hidden sm:block h-5 w-5 text-gray-300 group-hover:text-blue-500 transition shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="mt-10">
                {{ $data->links() }}
            </div>
        @endif
    </div>
</x-layouts.public>
