<x-app-layout>
    <x-slot name="header">Partner</x-slot>

    <div class="space-y-6" x-data="{ open: false, form: { nama: '', website: '' } }">
        <x-breadcrumb :items="[['label' => 'Dashboard', 'url' => route('admin.dashboard')], ['label' => 'Partner']]" />

        <div class="flex justify-between items-center">
            <p class="text-sm text-gray-600">Kelola logo partner</p>
            <x-primary-button @click="open = true; form = { nama: '', website: '' }">
                + Tambah Partner
            </x-primary-button>
        </div>

        <x-card>
            <x-table :headers="['Logo', 'Nama', 'Website', 'Aksi']">
                @forelse($data as $item)
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="px-4 py-3 whitespace-nowrap">
                            @if($item->logo)
                                <img src="{{ Storage::url($item->logo) }}" alt="{{ $item->nama }}" class="w-12 h-12 object-contain rounded-lg">
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $item->nama }}</td>
                        <td class="px-4 py-3 text-gray-500 max-w-[200px] truncate">
                            @if($item->website)
                                <a href="{{ $item->website }}" target="_blank" class="text-blue-600 hover:underline">{{ $item->website }}</a>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <form action="{{ route('admin.partner.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus partner ini?')">
                                @csrf @method('DELETE')
                                <x-danger-button type="submit">Hapus</x-danger-button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-8">
                            <x-empty-state title="Belum ada partner" description="Tambahkan logo partner sekolah" />
                        </td>
                    </tr>
                @endforelse
            </x-table>
        </x-card>

        <x-modal name="partner-modal" :show="open" maxWidth="lg">
            <form action="{{ route('admin.partner.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Partner</label>
                    <input type="text" name="nama" x-model="form.nama" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Logo</label>
                    <input type="file" name="logo" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Website</label>
                    <input type="url" name="website" x-model="form.website" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="https://">
                </div>
                <div class="flex justify-end gap-2 pt-4 border-t border-gray-100">
                    <x-secondary-button type="button" @click="open = false">Batal</x-secondary-button>
                    <x-primary-button type="submit">Simpan</x-primary-button>
                </div>
            </form>
        </x-modal>
    </div>
</x-app-layout>
