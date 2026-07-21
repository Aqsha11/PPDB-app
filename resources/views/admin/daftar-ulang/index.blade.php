<x-app-layout>
    <div class="space-y-6">

        <x-breadcrumb :items="[['label' => 'Dashboard', 'route' => 'admin.dashboard'], ['label' => 'Daftar Ulang']]" />

        <x-admin.module-header title="Daftar Ulang" description="Kelola status daftar ulang peserta yang telah diterima." icon="<path stroke-linecap='round' stroke-linejoin='round' d='M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2m-6 9l2 2 4-4' />">
            @slot('actions')
                <x-icon-button href="{{ route('admin.dashboard') }}" variant="default" title="Kembali ke Dashboard">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </x-icon-button>
            @endslot
        </x-admin.module-header>

        @php
            $activeStatus = request('status', 'semua');
            $tabs = [
                'semua' => ['label' => 'Semua', 'color' => 'gray'],
                'sudah' => ['label' => 'Sudah Daftar Ulang', 'color' => 'green'],
                'belum' => ['label' => 'Belum Daftar Ulang', 'color' => 'red'],
            ];
        @endphp

        <div class="flex flex-wrap gap-2">
            @foreach($tabs as $key => $tab)
                @php
                    $isActive = $activeStatus === $key;
                    $activeClass = $isActive
                        ? 'bg-white dark:bg-slate-800 shadow-sm ring-2 ring-gray-200 dark:ring-slate-600 text-gray-900 dark:text-white font-bold'
                        : 'bg-white/60 dark:bg-slate-800/60 text-gray-500 dark:text-slate-400 hover:bg-white dark:hover:bg-slate-800';
                @endphp
                <a href="{{ route('admin.daftar-ulang.index', array_merge(request()->only('search'), ['status' => $key])) }}"
                   class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm transition-all duration-200 {{ $activeClass }}">
                    {{ $tab['label'] }}
                    <span class="text-xs px-1.5 py-0.5 rounded-lg {{ $isActive ? 'theme-bg-light theme-text' : 'bg-gray-100 dark:bg-slate-700 text-gray-500 dark:text-slate-400' }}">
                        {{ $counts[$key] ?? 0 }}
                    </span>
                </a>
            @endforeach
        </div>

        <x-card>
            <div class="p-4 border-b border-gray-100 dark:border-slate-700">
                <form method="GET" class="flex flex-col sm:flex-row items-start sm:items-center gap-3">
                    @if($activeStatus !== 'semua')
                        <input type="hidden" name="status" value="{{ $activeStatus }}">
                    @endif
                    <div class="relative w-full sm:w-72">
                        <svg class="w-4 h-4 text-gray-400 dark:text-slate-500 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" name="search" placeholder="Cari nama peserta atau NISN..." value="{{ request('search') }}"
                            class="w-full pl-9 pr-3 py-2.5 text-sm border-0 rounded-xl bg-gray-50 dark:bg-slate-700/50 text-gray-700 dark:text-slate-200 placeholder-gray-400 dark:placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-slate-600 transition-all">
                    </div>
                    <div class="flex items-center gap-2">
                        <x-primary-button type="submit">Cari</x-primary-button>
                        @if(request('search'))
                            <x-secondary-button href="{{ route('admin.daftar-ulang.index', ['status' => $activeStatus]) }}">Reset</x-secondary-button>
                        @endif
                    </div>
                </form>
            </div>

            @if($data->isEmpty())
                <x-empty-state title="Tidak ada data" description="Tidak ditemukan data daftar ulang yang sesuai filter.">
                    @slot('icon')
                        <svg class="w-7 h-7 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2m-6 9l2 2 4-4" />
                        </svg>
                    @endslot
                </x-empty-state>
            @else
                <x-table :headers="['No', 'Nama', 'NISN', 'Status', 'Tanggal', 'Aksi']">
                    @foreach($data as $row)
                        @php
                            $du = $row->daftarUlang;
                        @endphp
                        <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50 transition">
                            <td class="px-5 py-4 whitespace-nowrap text-sm text-gray-500">{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}</td>
                            <td class="px-5 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">{{ $row->peserta->nama_lengkap ?? $row->peserta->user->name ?? '-' }}</td>
                            <td class="px-5 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-slate-400">{{ $row->peserta->nisn ?? '-' }}</td>
                            <td class="px-5 py-4 whitespace-nowrap">
                                @if($du && $du->status === 'sudah')
                                    <x-badge color="green">Sudah</x-badge>
                                @else
                                    <x-badge color="red">Belum</x-badge>
                                @endif
                            </td>
                            <td class="px-5 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-slate-400">
                                {{ $du && $du->tanggal_daftar_ulang ? $du->tanggal_daftar_ulang->setTimezone('Asia/Makassar')->format('d/m/Y H:i') . ' WITA' : '-' }}
                            </td>
                            <td class="px-5 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-1">
                                    <x-icon-button href="{{ route('admin.daftar-ulang.show', $row->id) }}" variant="primary" title="Lihat Detail">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    </x-icon-button>
                                    @if(!$du || $du->status !== 'sudah')
                                        <form action="{{ route('admin.daftar-ulang.update', $row->id) }}" method="POST" class="inline" onsubmit="return confirm('Konfirmasi daftar ulang peserta ini?')">
                                            @csrf @method('PUT')
                                            <input type="hidden" name="status" value="sudah">
                                            <x-icon-button type="submit" variant="success" title="Konfirmasi">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                            </x-icon-button>
                                        </form>
                                    @endif
                                </div>
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
