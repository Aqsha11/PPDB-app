<x-app-layout>
    <x-slot name="header">Data Pendaftaran</x-slot>

    <x-breadcrumb :items="[['label'=>'Dashboard','url'=>route('admin.dashboard')],['label'=>'Pendaftaran']]" />

    <div class="mt-6">
        <x-card>
            <div class="mb-4">
                <form method="GET" class="flex items-center gap-3">
                    <input type="text" name="search" placeholder="Cari nama siswa..." value="{{ request('search') }}"
                        class="w-full sm:w-72 rounded-lg border-gray-200 bg-gray-50 px-4 py-2 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg text-sm font-semibold text-white hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
                        Cari
                    </button>
                    @if(request('search'))
                        <a href="{{ route('admin.pendaftaran.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                            Reset
                        </a>
                    @endif
                </form>
            </div>

            <x-table :headers="['No', 'Nama Siswa', 'Jalur', 'Periode', 'Status', 'Tanggal Daftar', 'Aksi']">
                @forelse($data as $row)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $row->siswa->nama_lengkap ?? $row->siswa->user->name ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $row->jalurPendaftaran->nama ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $row->periodePpdb->nama ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $statusColor = match($row->status_pendaftaran) {
                                    'draft' => 'gray',
                                    'submitted' => 'yellow',
                                    'verifikasi' => 'blue',
                                    'diterima' => 'green',
                                    'ditolak' => 'red',
                                    'cadangan' => 'yellow',
                                    default => 'gray',
                                };
                            @endphp
                            <x-badge :color="$statusColor">{{ ucfirst($row->status_pendaftaran) }}</x-badge>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $row->created_at ? $row->created_at->format('d/m/Y') : '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                            <a href="{{ route('admin.pendaftaran.show', $row->id) }}"
                                class="inline-flex items-center px-3 py-1.5 bg-indigo-50 text-indigo-600 rounded-lg hover:bg-indigo-100 transition text-xs font-semibold">
                                Detail
                            </a>
                            <form action="{{ route('admin.pendaftaran.destroy', $row->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center px-3 py-1.5 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition text-xs font-semibold">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-0 py-0">
                            <x-empty-state title="Belum ada data pendaftaran" description="Belum ada pendaftar yang mendaftar melalui sistem." />
                        </td>
                    </tr>
                @endforelse
            </x-table>
        </x-card>
    </div>
</x-app-layout>
