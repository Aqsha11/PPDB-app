<x-app-layout>
    <x-slot name="header">Pengumuman</x-slot>

    <div class="space-y-6" x-data="{ open: false, form: { judul: '', isi: '' } }">
        <x-breadcrumb :items="[['label' => 'Dashboard', 'url' => route('admin.dashboard')], ['label' => 'Pengumuman']]" />

        <div class="flex justify-between items-center">
            <p class="text-sm text-gray-600">Kelola pengumuman</p>
            <x-primary-button @click="open = true; form = { judul: '', isi: '' }">
                + Tambah Pengumuman
            </x-primary-button>
        </div>

        <x-card>
            <x-table :headers="['Judul', 'Isi', 'Tanggal', 'Status', 'Aksi']">
                @forelse($data as $item)
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="px-4 py-3 font-medium text-gray-900 max-w-xs truncate">{{ $item->judul }}</td>
                        <td class="px-4 py-3 text-gray-500 max-w-sm truncate">{{ Str::limit($item->isi, 80) }}</td>
                        <td class="px-4 py-3 text-gray-500 whitespace-nowrap">{{ $item->created_at->format('d/m/Y') }}</td>
                        <td class="px-4 py-3">
                            @if($item->status)
                                <x-badge color="green">Aktif</x-badge>
                            @else
                                <x-badge color="red">Nonaktif</x-badge>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <form action="{{ route('admin.pengumuman.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pengumuman ini?')">
                                @csrf @method('DELETE')
                                <x-danger-button type="submit">Hapus</x-danger-button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8">
                            <x-empty-state title="Belum ada pengumuman" description="Tambahkan pengumuman baru" />
                        </td>
                    </tr>
                @endforelse
            </x-table>
        </x-card>

        <x-modal name="pengumuman-modal" :show="open" maxWidth="2xl">
            <form action="{{ route('admin.pengumuman.store') }}" method="POST" class="p-6 space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Judul</label>
                    <input type="text" name="judul" x-model="form.judul" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Isi Pengumuman</label>
                    <textarea name="isi" x-model="form.isi" rows="6" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent" required></textarea>
                </div>
                <div class="flex justify-end gap-2 pt-4 border-t border-gray-100">
                    <x-secondary-button type="button" @click="open = false">Batal</x-secondary-button>
                    <x-primary-button type="submit">Simpan</x-primary-button>
                </div>
            </form>
        </x-modal>
    </div>
</x-app-layout>
