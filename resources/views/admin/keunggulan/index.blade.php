<x-app-layout>
    <x-slot name="header">Keunggulan Sekolah</x-slot>

    <div class="space-y-6" x-data="{ open: false, form: { judul: '', deskripsi: '', icon: '' } }">
        <x-breadcrumb :items="[['label' => 'Dashboard', 'url' => route('admin.dashboard')], ['label' => 'Keunggulan']]" />

        <div class="flex justify-between items-center">
            <p class="text-sm text-gray-600">Kelola keunggulan sekolah</p>
            <x-primary-button @click="open = true; form = { judul: '', deskripsi: '', icon: '' }">
                + Tambah Keunggulan
            </x-primary-button>
        </div>

        <x-card>
            <x-table :headers="['Ikon', 'Judul', 'Deskripsi', 'Aksi']">
                @forelse($data as $item)
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="px-4 py-3 text-2xl">{{ $item->icon }}</td>
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $item->judul }}</td>
                        <td class="px-4 py-3 text-gray-500 max-w-xs truncate">{{ Str::limit($item->deskripsi, 60) }}</td>
                        <td class="px-4 py-3">
                            <form action="{{ route('admin.keunggulan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus keunggulan ini?')">
                                @csrf @method('DELETE')
                                <x-danger-button type="submit">Hapus</x-danger-button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-8">
                            <x-empty-state title="Belum ada keunggulan" description="Tambahkan keunggulan sekolah" />
                        </td>
                    </tr>
                @endforelse
            </x-table>
        </x-card>

        <x-modal name="keunggulan-modal" :show="open" maxWidth="lg">
            <form action="{{ route('admin.keunggulan.store') }}" method="POST" class="p-6 space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Judul</label>
                    <input type="text" name="judul" x-model="form.judul" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Deskripsi</label>
                    <textarea name="deskripsi" x-model="form.deskripsi" rows="3" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent" required></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Ikon</label>
                    <input type="text" name="icon" x-model="form.icon" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Contoh: 🎓">
                </div>
                <div class="flex justify-end gap-2 pt-4 border-t border-gray-100">
                    <x-secondary-button type="button" @click="open = false">Batal</x-secondary-button>
                    <x-primary-button type="submit">Simpan</x-primary-button>
                </div>
            </form>
        </x-modal>
    </div>
</x-app-layout>
