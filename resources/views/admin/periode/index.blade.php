<x-app-layout>
    <x-slot name="header">Periode PPDB</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Periode PPDB'],
        ]" />

        <div class="flex justify-between items-center">
            <p class="text-sm text-gray-600">Kelola periode pendaftaran PPDB</p>
            <a href="{{ route('admin.periode.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                + Tambah Periode
            </a>
        </div>

        <x-card>
            <x-table :headers="['Nama Periode', 'Tahun Ajaran', 'Tanggal Mulai', 'Tanggal Selesai', 'Status', 'Aksi']">
                @forelse($data as $item)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $item->nama_periode }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            {{ $item->tahunAjaran->tahun_awal ?? '-' }}/{{ $item->tahunAjaran->tahun_akhir ?? '' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            {{ $item->tanggal_mulai ? $item->tanggal_mulai->format('d/m/Y') : '-' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            {{ $item->tanggal_selesai ? $item->tanggal_selesai->format('d/m/Y') : '-' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($item->is_aktif)
                                <x-badge color="green">Aktif</x-badge>
                            @else
                                <x-badge color="gray">Tidak Aktif</x-badge>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.periode.edit', $item->id) }}" class="inline-flex items-center px-3 py-1.5 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Edit
                                </a>
                                <form action="{{ route('admin.periode.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus periode ini?')">
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
                        <td colspan="6" class="px-6 py-12 text-center">
                            <x-empty-state title="Belum ada periode" description="Tambahkan periode PPDB baru untuk memulai." />
                        </td>
                    </tr>
                @endforelse
            </x-table>
        </x-card>
    </div>
</x-app-layout>
