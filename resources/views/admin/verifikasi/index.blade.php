<x-app-layout>
    <div class="space-y-6">

        <x-breadcrumb :items="[['label' => 'Dashboard', 'route' => 'admin.dashboard'], ['label' => 'Verifikasi Pendaftaran']]" />

        <x-admin.module-header title="Verifikasi Pendaftaran" description="Periksa dan verifikasi dokumen pendaftaran peserta." icon="<path stroke-linecap='round' stroke-linejoin='round' d='M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z' />">
            @slot('actions')
                <x-icon-button href="{{ route('admin.dashboard') }}" variant="default" title="Kembali ke Dashboard">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </x-icon-button>
            @endslot
        </x-admin.module-header>

        <div class="flex items-center gap-2">
            <a href="{{ route('admin.verifikasi.index') }}" class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-semibold transition-colors {{ !request('filter') ? 'theme-bg text-white' : 'bg-gray-100 dark:bg-slate-700 text-gray-700 dark:text-slate-300 hover:bg-gray-200 dark:hover:bg-slate-600' }}">
                Semua
            </a>
            <a href="{{ route('admin.verifikasi.index', ['filter' => 'pending']) }}" class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-semibold transition-colors {{ request('filter') === 'pending' ? 'theme-bg text-white' : 'bg-gray-100 dark:bg-slate-700 text-gray-700 dark:text-slate-300 hover:bg-gray-200 dark:hover:bg-slate-600' }}">
                Pending
            </a>
            <a href="{{ route('admin.verifikasi.index', ['filter' => 'terverifikasi']) }}" class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-semibold transition-colors {{ request('filter') === 'terverifikasi' ? 'theme-bg text-white' : 'bg-gray-100 dark:bg-slate-700 text-gray-700 dark:text-slate-300 hover:bg-gray-200 dark:hover:bg-slate-600' }}">
                Terverifikasi
            </a>
        </div>

        <x-card>
            @if($data->isEmpty())
                <x-empty-state title="Tidak ada data verifikasi" description="Semua pendaftaran sudah terverifikasi.">
                    @slot('icon')
                        <svg class="w-7 h-7 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    @endslot
                </x-empty-state>
            @else
                <x-table :headers="['No', 'Nama Peserta', 'Jalur', 'Tanggal Submit', 'Status', 'Aksi']">
                    @foreach($data as $row)
                        <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50 transition">
                            <td class="px-5 py-4 whitespace-nowrap text-sm text-gray-500">{{ $loop->iteration }}</td>
                            <td class="px-5 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">{{ $row->peserta->nama_lengkap ?? $row->peserta->user->name ?? '-' }}</td>
                            <td class="px-5 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-slate-400">{{ $row->jalurPendaftaran->nama ?? '-' }}</td>
                            <td class="px-5 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-slate-400">{{ $row->created_at ? $row->created_at->format('d/m/Y') : '-' }}</td>
                            <td class="px-5 py-4 whitespace-nowrap">
                                <x-badge color="blue">Menunggu</x-badge>
                            </td>
                            <td class="px-5 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-1">
                                    <x-icon-button href="{{ route('admin.pendaftaran.show', $row->id) }}" variant="primary" title="Lihat Detail">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </x-icon-button>
                                    <form action="{{ route('admin.verifikasi.update', $row->id) }}" method="POST" class="inline" onsubmit="return confirm('Verifikasi pendaftaran ini?')">
                                        @csrf @method('PUT')
                                        <input type="hidden" name="status" value="terverifikasi">
                                        <x-icon-button type="submit" variant="success" title="Verifikasi">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                            </svg>
                                        </x-icon-button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </x-table>
            @endif
        </x-card>

    </div>
</x-app-layout>
