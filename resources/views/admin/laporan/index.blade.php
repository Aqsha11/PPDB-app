<x-app-layout>
    <div class="space-y-6">

        <x-breadcrumb :items="[['label' => 'Dashboard', 'route' => 'admin.dashboard'], ['label' => 'Laporan']]" />

        <x-admin.module-header title="Laporan Pendaftaran" description="Lihat ringkasan dan ekspor data pendaftaran PPDB." icon="<path stroke-linecap='round' stroke-linejoin='round' d='M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z' />">
            @slot('actions')
                <form method="GET" action="{{ route('admin.laporan.export') }}" class="inline">
                    <input type="hidden" name="status" value="{{ $status }}">
                    <input type="hidden" name="periode" value="{{ $periodeId }}">
                    <x-primary-button type="submit">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Ekspor Excel
                    </x-primary-button>
                </form>
            @endslot
        </x-admin.module-header>

        {{-- Filter --}}
        <x-card>
            <form method="GET" class="flex flex-col sm:flex-row items-start sm:items-center gap-3">
                <div class="w-full sm:w-56">
                    <label class="block text-xs font-bold text-gray-500 dark:text-slate-400 mb-1">Periode PPDB</label>
                    <select name="periode" onchange="this.form.submit()"
                        class="w-full rounded-xl border-gray-200 dark:border-slate-600 bg-gray-50 dark:bg-slate-700 px-3 py-2.5 text-sm text-gray-900 dark:text-white focus:border-blue-500 focus:ring-blue-500">
                        <option value="0">Semua Periode</option>
                        @foreach($periodes as $p)
                            <option value="{{ $p->id }}" {{ $periodeId == $p->id ? 'selected' : '' }}>
                                {{ $p->tahunAjaran?->nama ?? '-' }} — {{ $p->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>
        </x-card>

        {{-- Stats --}}
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-7 gap-3">
            @php
                $statItems = [
                    ['key' => 'semua', 'label' => 'Semua', 'color' => 'gray'],
                    ['key' => 'draft', 'label' => 'Draft', 'color' => 'gray'],
                    ['key' => 'submitted', 'label' => 'Submitted', 'color' => 'blue'],
                    ['key' => 'verifikasi', 'label' => 'Verifikasi', 'color' => 'yellow'],
                    ['key' => 'diterima', 'label' => 'Diterima', 'color' => 'green'],
                    ['key' => 'cadangan', 'label' => 'Cadangan', 'color' => 'purple'],
                    ['key' => 'ditolak', 'label' => 'Ditolak', 'color' => 'red'],
                ];
                $colorClasses = [
                    'gray' => 'bg-gray-50 dark:bg-slate-800 border-gray-200 dark:border-slate-700',
                    'blue' => 'bg-blue-50 dark:bg-blue-500/10 border-blue-200 dark:border-blue-500/20',
                    'yellow' => 'bg-amber-50 dark:bg-amber-500/10 border-amber-200 dark:border-amber-500/20',
                    'green' => 'bg-emerald-50 dark:bg-emerald-500/10 border-emerald-200 dark:border-emerald-500/20',
                    'purple' => 'bg-purple-50 dark:bg-purple-500/10 border-purple-200 dark:border-purple-500/20',
                    'red' => 'bg-red-50 dark:bg-red-500/10 border-red-200 dark:border-red-500/20',
                ];
            @endphp
            @foreach($statItems as $item)
                @php
                    $isActive = ($item['key'] === 'semua' && $status === 'all') || $status === $item['key'];
                    $filterUrl = $item['key'] === 'semua'
                        ? route('admin.laporan.index', array_merge(request()->only('periode'), ['status' => 'all']))
                        : route('admin.laporan.index', array_merge(request()->only('periode'), ['status' => $item['key']]));
                @endphp
                <a href="{{ $filterUrl }}"
                   class="block p-4 rounded-xl border-2 transition-all duration-200 {{ $isActive ? $colorClasses[$item['color']] . ' border-current ring-1 ring-gray-300 dark:ring-slate-600' : 'bg-white dark:bg-slate-800 border-transparent hover:border-gray-200 dark:hover:border-slate-600' }}">
                    <p class="text-[10px] font-bold text-gray-400 dark:text-slate-500 uppercase tracking-widest">{{ $item['label'] }}</p>
                    <p class="mt-1 text-xl font-extrabold text-gray-900 dark:text-white">{{ $stats[$item['key']] }}</p>
                </a>
            @endforeach
        </div>

        {{-- Table --}}
        <x-card>
            @if($data->isEmpty())
                <x-empty-state title="Tidak ada data" description="Tidak ditemukan data pendaftaran untuk filter yang dipilih.">
                    @slot('icon')
                        <svg class="w-7 h-7 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    @endslot
                </x-empty-state>
            @else
                <x-table :headers="['No', 'Nama', 'NISN', 'Jalur', 'Status', 'Tanggal']">
                    @foreach($data as $row)
                        <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50 transition">
                            <td class="px-5 py-4 whitespace-nowrap text-sm text-gray-500">{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}</td>
                            <td class="px-5 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">{{ $row->peserta->nama_lengkap ?? '-' }}</td>
                            <td class="px-5 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-slate-400">{{ $row->peserta->nisn ?? '-' }}</td>
                            <td class="px-5 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-slate-400">{{ $row->jalurPendaftaran?->nama ?? '-' }}</td>
                            <td class="px-5 py-4 whitespace-nowrap">
                                @php
                                    $badgeColor = match($row->status_pendaftaran) {
                                        'diterima' => 'green',
                                        'cadangan' => 'purple',
                                        'ditolak' => 'red',
                                        'verifikasi' => 'yellow',
                                        'submitted' => 'blue',
                                        default => 'gray',
                                    };
                                @endphp
                                <x-badge :color="$badgeColor">{{ ucfirst($row->status_pendaftaran) }}</x-badge>
                            </td>
                            <td class="px-5 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-slate-400">
                                {{ $row->created_at?->format('d/m/Y') ?? '-' }}
                            </td>
                        </tr>
                    @endforeach
                </x-table>

                @if(method_exists($data, 'links'))
                    <div class="px-5 py-4 border-t border-gray-100 dark:border-slate-700">
                        {{ $data->links() }}
                    </div>
                @endif
            @endif
        </x-card>

    </div>
</x-app-layout>
