<x-app-layout>
    <x-slot name="header">Tahun Ajaran</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Tahun Ajaran'],
        ]" />

        <div class="flex justify-between items-center">
            <p class="text-sm text-gray-600">Kelola tahun ajaran</p>
            <a href="{{ route('admin.tahun-ajaran.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                + Tambah Tahun Ajaran
            </a>
        </div>

        <x-card>
            <x-table :headers="['Tahun Ajaran', 'Status', 'Jumlah Periode', 'Aksi']">
                @forelse($data as $item)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $item->tahun_awal }}/{{ $item->tahun_akhir }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($item->is_aktif)
                                <x-badge color="green">Aktif</x-badge>
                            @else
                                <x-badge color="gray">Tidak Aktif</x-badge>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            {{ $item->periode->count() }} periode
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.tahun-ajaran.edit', $item->id) }}" class="inline-flex items-center px-3 py-1.5 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Edit
                                </a>
                                <form action="{{ route('admin.tahun-ajaran.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus tahun ajaran ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center">
                            <x-empty-state title="Belum ada tahun ajaran" description="Tambahkan tahun ajaran baru untuk memulai." />
                        </td>
                    </tr>
                @endforelse
            </x-table>
        </x-card>
    </div>
</x-app-layout>
