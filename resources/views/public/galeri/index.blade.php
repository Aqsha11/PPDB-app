<x-layouts.public title="Galeri">
    <div class="bg-gray-50 border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <h1 class="text-3xl font-bold text-gray-900">Galeri</h1>
            <p class="text-gray-500 mt-2">Dokumentasi kegiatan dan momen di sekolah</p>
        </div>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @if($data->isEmpty())
            <div class="text-center py-20">
                <svg class="h-20 w-20 mx-auto mb-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <p class="text-gray-500 text-lg">Belum ada galeri.</p>
                <p class="text-gray-400 text-sm mt-1">Silakan kembali lagi nanti.</p>
            </div>
        @else
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($data as $item)
                    <a href="{{ Storage::url($item->gambar) }}" target="_blank" rel="noopener noreferrer" class="group relative rounded-xl overflow-hidden aspect-square shadow-sm bg-gray-100">
                        <img src="{{ Storage::url($item->gambar) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" loading="lazy">
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/50 transition duration-300 flex items-center justify-center">
                            <div class="text-center opacity-0 group-hover:opacity-100 transition duration-300">
                                <svg class="h-10 w-10 text-white mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                                <span class="text-white text-xs font-medium">Lihat</span>
                            </div>
                        </div>
                        <div class="absolute bottom-0 left-0 right-0 p-3 bg-gradient-to-t from-black/70 via-black/20 to-transparent">
                            <p class="text-white text-sm font-medium truncate">{{ $item->judul }}</p>
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
