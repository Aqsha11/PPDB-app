<x-app-layout>
    <div class="space-y-6">

        <x-breadcrumb :items="[['label' => 'Dashboard', 'route' => 'admin.dashboard'], ['label' => 'Seleksi Pendaftaran']]" />

        <x-admin.module-header title="Seleksi Pendaftaran" description="Tentukan hasil seleksi pendaftaran: diterima, cadangan, atau tidak diterima." icon="<path stroke-linecap='round' stroke-linejoin='round' d='M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4' />">
            @slot('actions')
                <x-icon-button href="{{ route('admin.dashboard') }}" variant="default" title="Kembali ke Dashboard">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </x-icon-button>
            @endslot
        </x-admin.module-header>

        <div class="flex items-center gap-2">
            <a href="{{ route('admin.kelulusan.index') }}" class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-semibold transition-colors {{ !request('filter') ? 'theme-bg text-white' : 'bg-gray-100 dark:bg-slate-700 text-gray-700 dark:text-slate-300 hover:bg-gray-200 dark:hover:bg-slate-600' }}">
                Semua
            </a>
            <a href="{{ route('admin.kelulusan.index', ['filter' => 'menunggu']) }}" class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-semibold transition-colors {{ request('filter') === 'menunggu' ? 'theme-bg text-white' : 'bg-gray-100 dark:bg-slate-700 text-gray-700 dark:text-slate-300 hover:bg-gray-200 dark:hover:bg-slate-600' }}">
                Menunggu
            </a>
            <a href="{{ route('admin.kelulusan.index', ['filter' => 'diterima']) }}" class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-semibold transition-colors {{ request('filter') === 'diterima' ? 'bg-emerald-600 text-white' : 'bg-gray-100 dark:bg-slate-700 text-gray-700 dark:text-slate-300 hover:bg-gray-200 dark:hover:bg-slate-600' }}">
                Diterima
            </a>
            <a href="{{ route('admin.kelulusan.index', ['filter' => 'cadangan']) }}" class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-semibold transition-colors {{ request('filter') === 'cadangan' ? 'bg-amber-500 text-white' : 'bg-gray-100 dark:bg-slate-700 text-gray-700 dark:text-slate-300 hover:bg-gray-200 dark:hover:bg-slate-600' }}">
                Cadangan
            </a>
            <a href="{{ route('admin.kelulusan.index', ['filter' => 'ditolak']) }}" class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-semibold transition-colors {{ request('filter') === 'ditolak' ? 'bg-red-500 text-white' : 'bg-gray-100 dark:bg-slate-700 text-gray-700 dark:text-slate-300 hover:bg-gray-200 dark:hover:bg-slate-600' }}">
                Ditolak
            </a>
        </div>

        <x-card>
            @if($data->isEmpty())
                <x-empty-state title="Tidak ada data seleksi" description="Tidak ada pendaftaran yang perlu diseleksi.">
                    @slot('icon')
                        <svg class="w-7 h-7 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                    @endslot
                </x-empty-state>
            @else
                <x-table :headers="['No', 'Nama', 'Jalur', 'Nilai / Ranking', 'Status Kelulusan', 'Aksi']">
                    @foreach($data as $row)
                        <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50 transition">
                            <td class="px-5 py-4 whitespace-nowrap text-sm text-gray-500">{{ $loop->iteration }}</td>
                            <td class="px-5 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">{{ $row->peserta->nama_lengkap ?? $row->peserta->user->name ?? '-' }}</td>
                            <td class="px-5 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-slate-400">{{ $row->jalurPendaftaran->nama ?? '-' }}</td>
                            <td class="px-5 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-slate-400">
                                {{ $row->hasilSeleksi->nilai ?? '-' }}
                            </td>
                            <td class="px-5 py-4 whitespace-nowrap">
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
                                    <x-badge color="gray">Menunggu</x-badge>
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
                                    <form action="{{ route('admin.kelulusan.store') }}" method="POST" class="inline" onsubmit="return confirm('Terima peserta ini?')">
                                        @csrf
                                        <input type="hidden" name="pendaftaran_id" value="{{ $row->id }}">
                                        <input type="hidden" name="status" value="diterima">
                                        <x-icon-button type="submit" variant="success" title="Terima">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                            </svg>
                                        </x-icon-button>
                                    </form>
                                    <form action="{{ route('admin.kelulusan.store') }}" method="POST" class="inline" onsubmit="return confirm('Tolak peserta ini?')">
                                        @csrf
                                        <input type="hidden" name="pendaftaran_id" value="{{ $row->id }}">
                                        <input type="hidden" name="status" value="ditolak">
                                        <x-icon-button type="submit" variant="danger" title="Tolak">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
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
