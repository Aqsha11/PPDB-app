<x-app-layout>
    <x-slot name="header">Verifikasi Dokumen</x-slot>

    <x-breadcrumb :items="[['label'=>'Dashboard','url'=>route('admin.dashboard')],['label'=>'Verifikasi']]" />

    <div class="mt-6">
        <x-card>
            <x-table :headers="['No', 'Nama Siswa', 'Jalur', 'Jumlah Dokumen', 'Status', 'Aksi']">
                @forelse($data as $row)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $row->siswa->nama_lengkap ?? $row->siswa->user->name ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $row->jalurPendaftaran->nama ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            <span class="font-semibold">{{ $row->dokumenPendaftarans->count() }}</span>
                            <span class="text-gray-400">dokumen</span>
                            @php $verified = $row->dokumenPendaftarans->whereNotNull('verified_at')->count(); @endphp
                            @if($verified > 0)
                                <span class="ml-2 text-xs text-green-600">({{ $verified }} terverifikasi)</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <x-badge color="yellow">Menunggu</x-badge>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <form action="{{ route('admin.verifikasi.update', $row->id) }}" method="POST" class="flex items-center gap-2">
                                @csrf @method('PUT')
                                <select name="status" required
                                    class="rounded-lg border-gray-200 bg-gray-50 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">-- Pilih --</option>
                                    <option value="terverifikasi">Setujui</option>
                                    <option value="ditolak">Tolak</option>
                                </select>
                                <button type="submit"
                                    class="inline-flex items-center px-3 py-1.5 bg-indigo-600 text-white rounded-lg hover:bg-indigo-500 transition text-xs font-semibold">
                                    Simpan
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-0 py-0">
                            <x-empty-state title="Tidak ada data verifikasi" description="Semua pendaftaran sudah terverifikasi." />
                        </td>
                    </tr>
                @endforelse
            </x-table>
        </x-card>
    </div>
</x-app-layout>
