<x-app-layout>
    <x-slot name="header">Galeri</x-slot>

    <div class="space-y-6" x-data="{ open: false, form: { judul: '', kategori: '' } }">
        <x-breadcrumb :items="[['label' => 'Dashboard', 'url' => route('admin.dashboard')], ['label' => 'Galeri']]" />

        <div class="flex justify-between items-center">
            <p class="text-sm text-gray-600">Kelola galeri gambar</p>
            <x-primary-button @click="open = true; form = { judul: '', kategori: '' }">
                + Upload Gambar
            </x-primary-button>
        </div>

        @if($data->count() > 0)
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                @foreach($data as $item)
                    <div class="relative group bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <img src="{{ Storage::url($item->gambar) }}" alt="{{ $item->judul }}" class="w-full h-40 object-cover">
                        <div class="p-3">
                            <p class="text-sm font-medium text-gray-900 truncate">{{ $item->judul }}</p>
                            @if($item->kategori)
                                <span class="text-xs text-gray-500">{{ $item->kategori }}</span>
                            @endif
                        </div>
                        <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                            <form action="{{ route('admin.galeri.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus gambar ini?')">
                                @csrf @method('DELETE')
                                <x-danger-button type="submit">Hapus</x-danger-button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <x-card>
            <x-table :headers="['Gambar', 'Judul', 'Kategori', 'Aksi']">
                @forelse($data as $item)
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="px-4 py-3 whitespace-nowrap">
                            <img src="{{ Storage::url($item->gambar) }}" class="w-16 h-16 object-cover rounded-lg">
                        </td>
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $item->judul }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $item->kategori ?? '-' }}</td>
                        <td class="px-4 py-3">
                            <form action="{{ route('admin.galeri.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus gambar ini?')">
                                @csrf @method('DELETE')
                                <x-danger-button type="submit">Hapus</x-danger-button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-8">
                            <x-empty-state title="Belum ada gambar" description="Upload gambar untuk galeri sekolah" />
                        </td>
                    </tr>
                @endforelse
            </x-table>
        </x-card>

        <x-modal name="galeri-modal" :show="open" maxWidth="lg">
            <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Judul</label>
                    <input type="text" name="judul" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Gambar</label>
                    <input type="file" name="gambar" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Kategori</label>
                    <input type="text" name="kategori" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Misal: Kegiatan, Prestasi, dll">
                </div>
                <div class="flex justify-end gap-2 pt-4 border-t border-gray-100">
                    <x-secondary-button type="button" @click="open = false">Batal</x-secondary-button>
                    <x-primary-button type="submit">Upload</x-primary-button>
                </div>
            </form>
        </x-modal>
    </div>
</x-app-layout>
