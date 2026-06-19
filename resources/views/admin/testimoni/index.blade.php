<x-app-layout>
    <x-slot name="header">Testimoni</x-slot>

    <div class="space-y-6" x-data="{ open: false, form: { nama: '', asal_sekolah: '', isi: '', rating: 5 } }">
        <x-breadcrumb :items="[['label' => 'Dashboard', 'url' => route('admin.dashboard')], ['label' => 'Testimoni']]" />

        <div class="flex justify-between items-center">
            <p class="text-sm text-gray-600">Kelola testimoni</p>
            <x-primary-button @click="open = true; form = { nama: '', asal_sekolah: '', isi: '', rating: 5 }">
                + Tambah Testimoni
            </x-primary-button>
        </div>

        <x-card>
            <x-table :headers="['Foto', 'Nama', 'Asal Sekolah', 'Testimoni', 'Rating', 'Aksi']">
                @forelse($data as $item)
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="px-4 py-3 whitespace-nowrap">
                            @if($item->foto)
                                <img src="{{ Storage::url($item->foto) }}" class="w-10 h-10 rounded-full object-cover">
                            @else
                                <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 font-bold text-sm">
                                    {{ strtoupper(substr($item->nama, 0, 1)) }}
                                </div>
                            @endif
                        </td>
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $item->nama }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $item->asal_sekolah ?? '-' }}</td>
                        <td class="px-4 py-3 text-gray-500 max-w-xs truncate">{{ Str::limit($item->isi, 60) }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-0.5">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= ($item->rating ?? 0))
                                        <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                    @else
                                        <svg class="w-4 h-4 text-gray-300 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                    @endif
                                @endfor
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <form action="{{ route('admin.testimoni.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus testimoni ini?')">
                                @csrf @method('DELETE')
                                <x-danger-button type="submit">Hapus</x-danger-button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8">
                            <x-empty-state title="Belum ada testimoni" description="Tambahkan testimoni dari siswa atau orang tua" />
                        </td>
                    </tr>
                @endforelse
            </x-table>
        </x-card>

        <x-modal name="testimoni-modal" :show="open" maxWidth="lg">
            <form action="{{ route('admin.testimoni.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama</label>
                        <input type="text" name="nama" x-model="form.nama" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Asal Sekolah</label>
                        <input type="text" name="asal_sekolah" x-model="form.asal_sekolah" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Testimoni</label>
                    <textarea name="isi" x-model="form.isi" rows="4" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent" required></textarea>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Foto</label>
                        <input type="file" name="foto" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Rating (1-5)</label>
                        <input type="number" name="rating" x-model="form.rating" min="1" max="5" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                </div>
                <div class="flex justify-end gap-2 pt-4 border-t border-gray-100">
                    <x-secondary-button type="button" @click="open = false">Batal</x-secondary-button>
                    <x-primary-button type="submit">Simpan</x-primary-button>
                </div>
            </form>
        </x-modal>
    </div>
</x-app-layout>
