<x-app-layout>
    <x-slot name="header">Manajemen User</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Users'],
        ]" />

        <x-admin.module-header title="Manajemen User" description="Kelola akun pengguna sistem. Buat, edit, atau nonaktifkan akun pengguna beserta perannya.">
            <x-slot name="icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
            </x-slot>
            <x-slot name="actions">
                <x-primary-button href="{{ route('admin.user.create') }}">
                    + Tambah User
                </x-primary-button>
            </x-slot>
        </x-admin.module-header>

        <x-card>
            <div class="p-4 border-b border-gray-100 dark:border-slate-700">
                <form action="{{ route('admin.user.index') }}" method="GET" class="flex flex-col sm:flex-row sm:items-center gap-3">
                    <x-text-input type="text" name="search" placeholder="Cari user..." :value="request('search')" class="sm:w-72" />
                    <x-primary-button type="submit">Cari</x-primary-button>
                </form>
            </div>

            @if($admin->count() > 0)
                <div class="px-5 py-3 border-b border-gray-100 dark:border-slate-700">
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Admin & Staf</h3>
                </div>
                <div class="overflow-x-auto">
                    <x-table :headers="['No', 'Nama', 'Email', 'Role', 'Status', 'Aksi']">
                        @foreach($admin as $row)
                            <tr class="border-b border-gray-100 dark:border-slate-700/50 hover:bg-gray-50 dark:hover:bg-slate-700/50 transition">
                                <td class="px-5 py-3.5 text-sm text-gray-500">{{ $loop->iteration }}</td>
                                <td class="px-5 py-3.5 text-sm font-medium text-gray-900 dark:text-white">{{ $row->name }}</td>
                                <td class="px-5 py-3.5 text-sm text-gray-500 dark:text-slate-400">{{ $row->email }}</td>
                                <td class="px-5 py-3.5">
                                    <div class="flex flex-wrap gap-1.5">
                                        @forelse($row->roles as $role)
                                            <x-badge color="blue">{{ $role->name }}</x-badge>
                                        @empty
                                            <span class="text-gray-400 text-xs">-</span>
                                        @endforelse
                                    </div>
                                </td>
                                <td class="px-5 py-3.5">
                                    @if($row->is_active ?? true)
                                        <x-badge color="green">Aktif</x-badge>
                                    @else
                                        <x-badge color="red">Nonaktif</x-badge>
                                    @endif
                                </td>
                                <td class="px-5 py-3.5">
                                    <div class="flex items-center gap-1">
                                        <x-icon-button :href="route('admin.user.show', $row->id)" variant="primary" title="Lihat">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        </x-icon-button>
                                        <x-icon-button :href="route('admin.user.edit', $row->id)" variant="warning" title="Ubah">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        </x-icon-button>
                                        <x-icon-button :href="route('admin.user.destroy', $row->id)" variant="danger" title="Hapus" :delete="true" />
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </x-table>
                </div>
            @endif

            @if($peserta->count() > 0)
                <div class="px-5 py-3 border-b border-gray-100 dark:border-slate-700">
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Peserta</h3>
                </div>
                <div class="overflow-x-auto">
                    <x-table :headers="['No', 'Nama', 'Email', 'Role', 'Status', 'Aksi']">
                        @foreach($peserta as $row)
                            <tr class="border-b border-gray-100 dark:border-slate-700/50 hover:bg-gray-50 dark:hover:bg-slate-700/50 transition">
                                <td class="px-5 py-3.5 text-sm text-gray-500">{{ $loop->iteration }}</td>
                                <td class="px-5 py-3.5 text-sm font-medium text-gray-900 dark:text-white">{{ $row->name }}</td>
                                <td class="px-5 py-3.5 text-sm text-gray-500 dark:text-slate-400">{{ $row->email }}</td>
                                <td class="px-5 py-3.5">
                                    <div class="flex flex-wrap gap-1.5">
                                        @forelse($row->roles as $role)
                                            <x-badge color="green">{{ $role->name }}</x-badge>
                                        @empty
                                            <span class="text-gray-400 text-xs">-</span>
                                        @endforelse
                                    </div>
                                </td>
                                <td class="px-5 py-3.5">
                                    @if($row->is_active ?? true)
                                        <x-badge color="green">Aktif</x-badge>
                                    @else
                                        <x-badge color="red">Nonaktif</x-badge>
                                    @endif
                                </td>
                                <td class="px-5 py-3.5">
                                    <div class="flex items-center gap-1">
                                        <x-icon-button :href="route('admin.user.show', $row->id)" variant="primary" title="Lihat">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        </x-icon-button>
                                        <x-icon-button :href="route('admin.user.edit', $row->id)" variant="warning" title="Ubah">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        </x-icon-button>
                                        <x-icon-button :href="route('admin.user.destroy', $row->id)" variant="danger" title="Hapus" :delete="true" />
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </x-table>
                </div>
            @endif
        </x-card>
    </div>
</x-app-layout>
