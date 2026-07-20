<x-app-layout>
    <div class="space-y-6">

        <x-breadcrumb :items="[['label' => 'Dashboard', 'route' => 'admin.dashboard'], ['label' => 'Data Pendaftaran']]" />

        <x-admin.module-header title="Data Pendaftaran" description="Kelola seluruh data pendaftaran peserta baru." icon="<path stroke-linecap='round' stroke-linejoin='round' d='M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z' />">
            @slot('actions')
                <x-icon-button href="{{ route('admin.dashboard') }}" variant="default" title="Kembali ke Dashboard">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </x-icon-button>
            @endslot
        </x-admin.module-header>

        <x-card>
            <div class="p-4 border-b border-gray-100 dark:border-slate-700">
                <form method="GET" class="flex flex-col sm:flex-row items-start sm:items-center gap-3">
                    <input type="text" name="search" placeholder="Cari nama peserta..." value="{{ request('search') }}"
                        class="w-full sm:w-72 rounded-lg border-gray-200 dark:border-slate-600 bg-gray-50 dark:bg-slate-700 px-4 py-2.5 text-sm text-gray-900 dark:text-white focus:border-blue-600 focus:ring-blue-600">
                    <div class="flex items-center gap-2">
                        <x-primary-button type="submit">Cari</x-primary-button>
                        @if(request('search'))
                            <x-secondary-button href="{{ route('admin.pendaftaran.index') }}">Reset</x-secondary-button>
                        @endif
                    </div>
                </form>
            </div>

            @if($data->isEmpty())
                <x-empty-state title="Belum ada data pendaftaran" description="Belum ada pendaftar yang mendaftar melalui sistem.">
                    @slot('icon')
                        <svg class="w-7 h-7 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    @endslot
                </x-empty-state>
            @else
                <x-table :headers="['No', 'Nama Peserta', 'NISN', 'Jalur', 'Status', 'Aksi']">
                    @foreach($data as $row)
                        <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50 transition">
                            <td class="px-5 py-4 whitespace-nowrap text-sm text-gray-500">{{ $loop->iteration }}</td>
                            <td class="px-5 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">{{ $row->peserta->nama_lengkap ?? $row->peserta->user->name ?? '-' }}</td>
                            <td class="px-5 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-slate-400">{{ $row->peserta->nisn ?? '-' }}</td>
                            <td class="px-5 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-slate-400">{{ $row->jalurPendaftaran->nama ?? '-' }}</td>
                            <td class="px-5 py-4 whitespace-nowrap">
                                @php
                                    $statusColor = match($row->status_pendaftaran) {
                                        'draft' => 'gray',
                                        'submitted' => 'blue',
                                        'verifikasi' => 'yellow',
                                        'diterima' => 'green',
                                        'cadangan' => 'yellow',
                                        'ditolak' => 'red',
                                        default => 'gray',
                                    };
                                @endphp
                                <x-badge :color="$statusColor">{{ ucfirst($row->status_pendaftaran) }}</x-badge>
                            </td>
                            <td class="px-5 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-1">
                                    <x-icon-button href="{{ route('admin.pendaftaran.show', $row->id) }}" variant="primary" title="Lihat Detail">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </x-icon-button>
                                    <x-icon-button :delete="true" href="{{ route('admin.pendaftaran.destroy', $row->id) }}" title="Hapus" />
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </x-table>
            @endif
        </x-card>

    </div>
</x-app-layout>
