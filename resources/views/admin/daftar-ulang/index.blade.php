<x-app-layout>
    <div class="space-y-6">

        <x-breadcrumb :items="[['label' => 'Dashboard', 'route' => 'admin.dashboard'], ['label' => 'Daftar Ulang']]" />

        <x-admin.module-header title="Daftar Ulang" description="Kelola status daftar ulang peserta yang telah diterima." icon="<path stroke-linecap='round' stroke-linejoin='round' d='M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4' />">
            @slot('actions')
                <x-icon-button href="{{ route('admin.dashboard') }}" variant="default" title="Kembali ke Dashboard">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </x-icon-button>
            @endslot
        </x-admin.module-header>

        <x-card>
            @if($data->isEmpty())
                <x-empty-state title="Tidak ada data daftar ulang" description="Tidak ada peserta yang diterima untuk ditampilkan.">
                    @slot('icon')
                        <svg class="w-7 h-7 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                    @endslot
                </x-empty-state>
            @else
                <x-table :headers="['No', 'Nama', 'Status Daftar Ulang', 'Tanggal', 'Aksi']">
                    @foreach($data as $row)
                        <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50 transition">
                            <td class="px-5 py-4 whitespace-nowrap text-sm text-gray-500">{{ $loop->iteration }}</td>
                            <td class="px-5 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">{{ $row->peserta->nama_lengkap ?? $row->peserta->user->name ?? '-' }}</td>
                            <td class="px-5 py-4 whitespace-nowrap">
                                @if($row->daftarUlang && $row->daftarUlang->status === 'sudah')
                                    <x-badge color="green">Sudah Daftar Ulang</x-badge>
                                @else
                                    <x-badge color="red">Belum</x-badge>
                                @endif
                            </td>
                            <td class="px-5 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-slate-400">
                                @if($row->daftarUlang && $row->daftarUlang->tanggal_daftar_ulang)
                                    {{ $row->daftarUlang->tanggal_daftar_ulang->format('d/m/Y') }}
                                @else
                                    <span class="text-gray-400 dark:text-slate-500">-</span>
                                @endif
                            </td>
                            <td class="px-5 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-1">
                                    <x-icon-button href="{{ route('admin.pendaftaran.show', $row->id) }}" variant="primary" title="Lihat Detail">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </x-icon-button>
                                    @if(!$row->daftarUlang || $row->daftarUlang->status !== 'sudah')
                                        <form action="{{ route('admin.daftar-ulang.update', $row->id) }}" method="POST" class="inline" onsubmit="return confirm('Konfirmasi daftar ulang peserta ini?')">
                                            @csrf @method('PUT')
                                            <input type="hidden" name="status" value="sudah">
                                            <x-icon-button type="submit" variant="success" title="Konfirmasi Daftar Ulang">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                                </svg>
                                            </x-icon-button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </x-table>
            @endif
        </x-card>

    </div>
</x-app-layout>
