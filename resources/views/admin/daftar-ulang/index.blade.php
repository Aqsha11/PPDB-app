<x-app-layout>
    <x-slot name="header">Daftar Ulang</x-slot>

    <x-breadcrumb :items="[['label'=>'Dashboard','url'=>route('admin.dashboard')],['label'=>'Daftar Ulang']]" />

    <div class="mt-6">
        <x-card>
            <x-table :headers="['No', 'Nama Siswa', 'Jalur', 'Status Daftar Ulang', 'Aksi']">
                @forelse($data as $row)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $row->siswa->nama_lengkap ?? $row->siswa->user->name ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $row->jalurPendaftaran->nama ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($row->daftarUlang && $row->daftarUlang->status === 'daftar_ulang')
                                <x-badge color="green">Sudah Daftar Ulang</x-badge>
                            @elseif($row->daftarUlang && $row->daftarUlang->status === 'mengundurkan_diri')
                                <x-badge color="red">Mengundurkan Diri</x-badge>
                            @else
                                <x-badge color="yellow">Belum</x-badge>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if(!$row->daftarUlang || $row->daftarUlang->status !== 'daftar_ulang')
                                <form action="{{ route('admin.daftar-ulang.update', $row->id) }}" method="POST" class="inline" onsubmit="return confirm('Konfirmasi daftar ulang siswa ini?')">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="daftar_ulang">
                                    <button type="submit"
                                        class="inline-flex items-center px-3 py-1.5 bg-indigo-600 text-white rounded-lg hover:bg-indigo-500 transition text-xs font-semibold">
                                        Konfirmasi Daftar Ulang
                                    </button>
                                </form>
                            @else
                                <span class="text-sm text-gray-400">Selesai</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-0 py-0">
                            <x-empty-state title="Tidak ada data daftar ulang" description="Tidak ada siswa yang diterima untuk ditampilkan." />
                        </td>
                    </tr>
                @endforelse
            </x-table>
        </x-card>
    </div>
</x-app-layout>
