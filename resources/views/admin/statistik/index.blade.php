<x-app-layout>
    <x-slot name="header">Statistik Sekolah</x-slot>

    <div class="space-y-6" x-data="{ open: false, form: { judul: '', jumlah: '', icon: '' } }">
        <x-breadcrumb :items="[['label' => 'Dashboard', 'url' => route('admin.dashboard')], ['label' => 'Statistik']]" />

        <p class="text-sm text-gray-600">Kelola angka statistik yang ditampilkan</p>

        @if($data->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($data as $item)
                    <div class="relative group bg-white rounded-xl shadow-sm border border-gray-200 p-6 text-center">
                        <form action="{{ route('admin.statistik.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')" class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition">
                            @csrf @method('DELETE')
                            <x-danger-button type="submit" class="!p-1 !text-xs">Hapus</x-danger-button>
                        </form>
                        @if($item->icon)
                            <div class="text-5xl mb-3">{{ $item->icon }}</div>
                        @endif
                        <div class="text-3xl font-bold text-gray-900">{{ $item->jumlah }}</div>
                        <div class="text-sm text-gray-600 mt-1">{{ $item->judul }}</div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="flex justify-center">
            <x-primary-button @click="open = true; form = { judul: '', jumlah: '', icon: '' }">
                + Tambah Statistik
            </x-primary-button>
        </div>

        <x-card>
            <x-table :headers="['Ikon', 'Judul', 'Jumlah', 'Aksi']">
                @forelse($data as $item)
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="px-4 py-3 text-2xl">{{ $item->icon }}</td>
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $item->judul }}</td>
                        <td class="px-4 py-3 text-gray-700 font-semibold">{{ $item->jumlah }}</td>
                        <td class="px-4 py-3">
                            <form action="{{ route('admin.statistik.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf @method('DELETE')
                                <x-danger-button type="submit">Hapus</x-danger-button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-8">
                            <x-empty-state title="Belum ada data statistik" description="Tambahkan statistik sekolah" />
                        </td>
                    </tr>
                @endforelse
            </x-table>
        </x-card>

        <x-modal name="statistik-modal" :show="open" maxWidth="lg">
            <form action="{{ route('admin.statistik.store') }}" method="POST" class="p-6 space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Judul</label>
                    <input type="text" name="judul" x-model="form.judul" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent" required placeholder="Guru, Siswa, dll">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Jumlah</label>
                    <input type="number" name="jumlah" x-model="form.jumlah" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Ikon</label>
                    <input type="text" name="icon" x-model="form.icon" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Contoh: 👨‍🏫">
                </div>
                <div class="flex justify-end gap-2 pt-4 border-t border-gray-100">
                    <x-secondary-button type="button" @click="open = false">Batal</x-secondary-button>
                    <x-primary-button type="submit">Simpan</x-primary-button>
                </div>
            </form>
        </x-modal>
    </div>
</x-app-layout>
