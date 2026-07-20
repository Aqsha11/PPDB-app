<x-layouts.public title="Galeri">
    <div class="relative overflow-hidden" style="background-color: var(--warna-primary)">
        <div class="absolute inset-0 opacity-10"><div class="absolute -top-20 -right-20 w-72 h-72 bg-white rounded-full blur-3xl"></div><div class="absolute -bottom-20 -left-20 w-72 h-72 bg-white rounded-full blur-3xl"></div></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20">
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight">Galeri Foto</h1>
            <p class="text-white/70 mt-3 text-lg">Dokumentasi kegiatan dan momen di sekolah</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-16"
         x-data="{
             lightbox: false,
             currentSrc: '',
             currentTitle: '',
             open(src, title) { this.currentSrc = src; this.currentTitle = title; this.lightbox = true; },
             close() { this.lightbox = false; this.currentSrc = ''; this.currentTitle = ''; }
         }">
        @if($data->isEmpty())
            <div class="text-center py-24">
                <div class="w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-6" style="background-color: color-mix(in srgb, var(--warna-primary) 10%, transparent)">
                    <svg class="h-10 w-10" style="color: var(--warna-primary)" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <p class="text-gray-700 dark:text-slate-300 text-lg font-semibold">Belum ada galeri.</p>
                <p class="text-gray-400 dark:text-slate-500 text-sm mt-1">Silakan kembali lagi nanti.</p>
            </div>
        @else
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($data as $item)
                    <button @click="open('{{ Storage::url($item->gambar) }}', '{{ addslashes($item->judul) }}')" class="group relative rounded-2xl overflow-hidden aspect-square bg-gray-200 dark:bg-slate-700 text-left">
                        <img src="{{ Storage::url($item->gambar) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" loading="lazy">
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition-all duration-300 flex items-center justify-center">
                            <div class="text-center opacity-0 group-hover:opacity-100 transition-all duration-300 group-hover:scale-100 scale-75">
                                <div class="w-14 h-14 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center mx-auto mb-2">
                                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                                </div>
                                <span class="text-white text-xs font-semibold">Lihat</span>
                            </div>
                        </div>
                        <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/70 via-black/20 to-transparent">
                            <p class="text-white text-sm font-semibold truncate">{{ $item->judul }}</p>
                        </div>
                    </button>
                @endforeach
            </div>
            <div class="mt-12">
                {{ $data->links() }}
            </div>
        @endif

        {{-- Lightbox --}}
        <template x-if="lightbox">
            <div class="fixed inset-0 z-[999] flex items-center justify-center bg-black/80 backdrop-blur-sm p-4"
                 @keydown.escape.window="close()">
                <button @click="close()" class="absolute top-4 right-4 text-white/80 hover:text-white transition-colors z-10 w-10 h-10 rounded-full bg-white/10 flex items-center justify-center backdrop-blur-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
                <div class="relative max-w-5xl w-full">
                    <img :src="currentSrc" :alt="currentTitle" class="w-full max-h-[80vh] object-contain rounded-2xl">
                    <p x-show="currentTitle" x-text="currentTitle" class="text-white text-center mt-4 text-sm font-medium"></p>
                </div>
            </div>
        </template>
    </div>
</x-layouts.public>
