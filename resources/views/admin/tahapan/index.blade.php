<x-app-layout>
    <x-slot name="header">Tahapan PPDB</x-slot>

    <div class="space-y-6" x-data="{ open: false, form: { judul: '', deskripsi: '', urutan: '' } }">
        <x-breadcrumb :items="[['label' => 'Dashboard', 'url' => route('admin.dashboard')], ['label' => 'Tahapan PPDB']]" />

        <div class="flex justify-between items-center">
            <p class="text-sm text-gray-600">Kelola tahapan pendaftaran PPDB</p>
            <x-primary-button @click="open = true; form = { judul: '', deskripsi: '', urutan: '' }">
                + Tambah Tahapan
            </x-primary-button>
        </div>

        <x-card>
            <x-table :headers="['Urutan', 'Nama Tahapan', 'Deskripsi', 'Aksi']">
                @forelse($data as $item)
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="px-4 py-3 text-gray-600">{{ $item->urutan ?? $loop->iteration }}</td>
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $item->judul }}</td>
                        <td class="px-4 py-3 text-gray-500 max-w-sm truncate">{{ Str::limit($item->deskripsi, 80) }}</td>
                        <td class="px-4 py-3">
                            <form action="{{ route('admin.tahapan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus tahapan ini?')">
                                @csrf @method('DELETE')
                                <x-danger-button type="submit">Hapus</x-danger-button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-8">
                            <x-empty-state title="Belum ada tahapan" description="Tambahkan tahapan pendaftaran PPDB" />
                        </td>
                    </tr>
                @endforelse
            </x-table>
        </x-card>

        <x-modal name="tahapan-modal" :show="open" maxWidth="lg">
            <form action="{{ route('admin.tahapan.store') }}" method="POST" class="p-6 space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Tahapan</label>
                    <input type="text" name="judul" x-model="form.judul" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Deskripsi</label>
                    <textarea name="deskripsi" x-model="form.deskripsi" rows="3" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Urutan</label>
                    <input type="number" name="urutan" x-model="form.urutan" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                </div>
                <div class="flex justify-end gap-2 pt-4 border-t border-gray-100">
                    <x-secondary-button type="button" @click="open = false">Batal</x-secondary-button>
                    <x-primary-button type="submit">Simpan</x-primary-button>
                </div>
            </form>
        </x-modal>
    </div>
</x-app-layout>
