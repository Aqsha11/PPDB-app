<x-app-layout>
    <x-slot name="header">Galeri</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Galeri'],
        ]" />

        <x-admin.module-header title="Galeri Foto" description="Kelola koleksi foto sekolah yang ditampilkan di halaman galeri publik. Upload, kategorikan, atau hapus gambar.">
            <x-slot name="icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </x-slot>
            <x-slot name="actions">
                <x-primary-button href="{{ route('admin.galeri.create') }}">
                    + Upload Gambar
                </x-primary-button>
            </x-slot>
        </x-admin.module-header>

        @if($data->count() > 0)
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                @foreach($data as $item)
                    <div class="relative group bg-white dark:bg-slate-800 rounded-xl border border-gray-200 dark:border-slate-700 overflow-hidden">
                        <img src="{{ Storage::url($item->gambar) }}" alt="{{ $item->judul }}" class="w-full h-40 object-cover">
                        <div class="p-3">
                            <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ $item->judul }}</p>
                            @if($item->kategori)
                                <span class="text-xs text-gray-500 dark:text-slate-400">{{ $item->kategori }}</span>
                            @endif
                        </div>
                        <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition flex items-center justify-center gap-2">
                            <x-icon-button :href="route('admin.galeri.edit', $item->id)" variant="primary" title="Ubah">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </x-icon-button>
                            <x-icon-button :href="route('admin.galeri.destroy', $item->id)" variant="danger" title="Hapus" :delete="true" />
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <x-card>
                <x-empty-state title="Belum ada gambar" description="Upload gambar untuk galeri sekolah">
                    <x-slot name="action">
                        <x-primary-button href="{{ route('admin.galeri.create') }}">+ Upload Gambar</x-primary-button>
                    </x-slot>
                </x-empty-state>
            </x-card>
        @endif
    </div>
</x-app-layout>
