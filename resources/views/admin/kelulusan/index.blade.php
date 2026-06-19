<x-app-layout>
    <x-slot name="header">Seleksi / Kelulusan</x-slot>

    <x-breadcrumb :items="[['label'=>'Dashboard','url'=>route('admin.dashboard')],['label'=>'Kelulusan']]" />

    <div class="mt-6">
        <x-card>
            <x-table :headers="['No', 'Nama Siswa', 'Jalur', 'Nilai', 'Status', 'Aksi']">
                @forelse($data as $row)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $row->siswa->nama_lengkap ?? $row->siswa->user->name ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $row->jalurPendaftaran->nama ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            {{ $row->hasilSeleksi->nilai ?? '-' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($row->hasilSeleksi)
                                @php
                                    $hasilColor = match($row->hasilSeleksi->status) {
                                        'diterima' => 'green',
                                        'ditolak' => 'red',
                                        'cadangan' => 'yellow',
                                        default => 'gray',
                                    };
                                @endphp
                                <x-badge :color="$hasilColor">{{ ucfirst($row->hasilSeleksi->status) }}</x-badge>
                            @else
                                <x-badge color="blue">Menunggu</x-badge>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                <form action="{{ route('admin.kelulusan.store') }}" method="POST" class="inline" onsubmit="return confirm('Terima siswa ini?')">
                                    @csrf
                                    <input type="hidden" name="pendaftaran_id" value="{{ $row->id }}">
                                    <input type="hidden" name="status" value="diterima">
                                    <button type="submit"
                                        class="inline-flex items-center px-3 py-1.5 bg-green-600 text-white rounded-lg hover:bg-green-500 transition text-xs font-semibold">
                                        Terima
                                    </button>
                                </form>
                                <form action="{{ route('admin.kelulusan.store') }}" method="POST" class="inline" onsubmit="return confirm('Tolak siswa ini?')">
                                    @csrf
                                    <input type="hidden" name="pendaftaran_id" value="{{ $row->id }}">
                                    <input type="hidden" name="status" value="ditolak">
                                    <button type="submit"
                                        class="inline-flex items-center px-3 py-1.5 bg-red-600 text-white rounded-lg hover:bg-red-500 transition text-xs font-semibold">
                                        Tolak
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-0 py-0">
                            <x-empty-state title="Tidak ada data seleksi" description="Tidak ada pendaftaran yang perlu diseleksi." />
                        </td>
                    </tr>
                @endforelse
            </x-table>
        </x-card>
    </div>
</x-app-layout>
