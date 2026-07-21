<x-app-layout>
    <x-slot name="header">Biodata Peserta</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Biodata Peserta'],
        ]" />

        <x-admin.module-header title="Biodata Peserta" description="Lihat dan cari data biodata lengkap peserta pendaftar. Akses informasi pribadi, orang tua, dan asal sekolah.">
            <x-slot name="icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </x-slot>
        </x-admin.module-header>

        <x-card>
            <div class="p-4 border-b border-gray-100 dark:border-slate-700">
                <form method="GET" action="{{ route('admin.biodata.index') }}" class="flex flex-col sm:flex-row items-start sm:items-center gap-3">
                    <div class="relative w-full sm:w-72">
                        <svg class="w-4 h-4 text-gray-400 dark:text-slate-500 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" name="search" placeholder="Cari nama, NISN, atau email..." value="{{ request('search') }}"
                            class="w-full pl-9 pr-3 py-2.5 text-sm border-0 rounded-xl bg-gray-50 dark:bg-slate-700/50 text-gray-700 dark:text-slate-200 placeholder-gray-400 dark:placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-slate-600 transition-all">
                    </div>
                    <div class="flex items-center gap-2">
                        <x-primary-button type="submit">Cari</x-primary-button>
                        @if(request('search'))
                            <x-secondary-button href="{{ route('admin.biodata.index') }}">Reset</x-secondary-button>
                        @endif
                    </div>
                </form>
            </div>

            <x-table :headers="['No', 'Nama', 'NISN', 'Jenis Kelamin', 'No HP', 'Aksi']">
                @forelse($data as $s)
                    <tr class="border-b border-gray-100 dark:border-slate-700/50 hover:bg-gray-50 dark:hover:bg-slate-700/50 transition">
                        <td class="px-5 py-3.5 text-sm text-gray-500">{{ $loop->iteration }}</td>
                        <td class="px-5 py-3.5 text-sm font-medium text-gray-900 dark:text-white">{{ $s->user->name ?? '-' }}</td>
                        <td class="px-5 py-3.5 text-sm text-gray-500 dark:text-slate-400">{{ $s->nisn ?? '-' }}</td>
                        <td class="px-5 py-3.5 text-sm text-gray-500 dark:text-slate-400">{{ $s->jenis_kelamin == 'L' ? 'Laki-laki' : ($s->jenis_kelamin == 'P' ? 'Perempuan' : '-') }}</td>
                        <td class="px-5 py-3.5 text-sm text-gray-500 dark:text-slate-400">{{ $s->no_hp ?? '-' }}</td>
                        <td class="px-5 py-3.5">
                            <div class="flex items-center gap-1">
                                <x-icon-button :href="route('admin.biodata.show', $s->id)" variant="primary" title="Lihat">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </x-icon-button>
                                <x-icon-button :href="route('admin.biodata.edit', $s->id)" variant="warning" title="Ubah">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </x-icon-button>
                                <x-icon-button :href="route('admin.biodata.destroy', $s->id)" variant="danger" title="Hapus" :delete="true" />
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-5 py-12">
                            <x-empty-state title="Belum ada data peserta" description="Data peserta akan muncul setelah pengguna melengkapi biodata." />
                        </td>
                    </tr>
                @endforelse
            </x-table>

            @if(method_exists($data, 'links'))
                <div class="px-5 py-4 border-t border-gray-100 dark:border-slate-700">
                    {{ $data->links() }}
                </div>
            @endif
        </x-card>
    </div>
</x-app-layout>
