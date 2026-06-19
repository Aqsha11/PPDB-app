<x-app-layout>
    <x-slot name="header">Dokumen Siswa</x-slot>

    <div class="mb-6">
        <x-breadcrumb :items="[
            ['label' => 'Home', 'url' => route('admin.dashboard')],
            ['label' => 'Dokumen Siswa'],
        ]" />
    </div>

    <x-card>
        <x-table :headers="['Nama Siswa', 'Nama Dokumen', 'File', 'Status Verifikasi', 'Aksi']">
            @forelse($data as $d)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $d->pendaftaran->siswa->user->name ?? $d->pendaftaran->siswa->nama_lengkap ?? '-' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $d->persyaratanDokumen->nama ?? '-' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        @if($d->file)
                            <a href="{{ Storage::url($d->file) }}" target="_blank" class="text-blue-600 hover:text-blue-900 underline">Lihat File</a>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($d->status === 'terverifikasi')
                            <x-badge color="green">Terverifikasi</x-badge>
                        @elseif($d->status === 'ditolak')
                            <x-badge color="red">Ditolak</x-badge>
                        @else
                            <x-badge color="yellow">Pending</x-badge>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                        <a href="{{ route('admin.dokumen-siswa.show', $d->id) }}" class="text-blue-600 hover:text-blue-900">Detail</a>
                        <form action="{{ route('admin.dokumen-siswa.destroy', $d->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus dokumen ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-10 text-center">
                        <x-empty-state title="Belum ada dokumen" description="Dokumen siswa akan muncul setelah pengguna mengunggah persyaratan." />
                    </td>
                </tr>
            @endforelse
        </x-table>
        @if(method_exists($data, 'links'))
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $data->links() }}
            </div>
        @endif
    </x-card>
</x-app-layout>
