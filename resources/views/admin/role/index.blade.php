<x-app-layout>
    <x-slot name="header">Manajemen Role</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Roles'],
        ]" />

        <x-admin.module-header title="Manajemen Role" description="Kelola peran dan hak akses pengguna. Tentukan role apa saja yang tersedia di sistem.">
            <x-slot name="icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
            </x-slot>
            <x-slot name="actions">
                <x-primary-button href="{{ route('admin.role.create') }}">
                    + Tambah Role
                </x-primary-button>
            </x-slot>
        </x-admin.module-header>

        <x-card>
            @if($data->count() > 0)
                <div class="overflow-x-auto">
                    <x-table :headers="['No', 'Nama Role', 'Permissions Count', 'Aksi']">
                        @foreach($data as $row)
                            <tr class="border-b border-gray-100 dark:border-slate-700/50 hover:bg-gray-50 dark:hover:bg-slate-700/50 transition">
                                <td class="px-5 py-3.5 text-sm text-gray-500">{{ $loop->iteration }}</td>
                                <td class="px-5 py-3.5 text-sm font-medium text-gray-900 dark:text-white capitalize">{{ $row->name }}</td>
                                <td class="px-5 py-3.5">
                                    <x-badge color="blue">{{ $row->permissions->count() }} permission</x-badge>
                                </td>
                                <td class="px-5 py-3.5">
                                    <div class="flex items-center gap-1">
                                        <x-icon-button :href="route('admin.role.show', $row->id)" variant="primary" title="Lihat">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        </x-icon-button>
                                        <x-icon-button :href="route('admin.role.edit', $row->id)" variant="warning" title="Ubah">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        </x-icon-button>
                                        <x-icon-button :href="route('admin.role.destroy', $row->id)" variant="danger" title="Hapus" :delete="true" />
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </x-table>
                </div>
            @else
                <div class="p-6">
                    <x-empty-state title="Belum ada role" description="Belum ada role yang tersedia. Tambah role baru untuk memberikan hak akses.">
                        <x-slot name="action">
                            <x-primary-button href="{{ route('admin.role.create') }}">+ Tambah Role</x-primary-button>
                        </x-slot>
                    </x-empty-state>
                </div>
            @endif
        </x-card>
    </div>
</x-app-layout>
