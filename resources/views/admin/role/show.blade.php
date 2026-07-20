<x-app-layout>
    <x-slot name="header">Detail Role</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Roles', 'url' => route('admin.role.index')],
            ['label' => 'Detail'],
        ]" />

        <div class="flex items-center justify-between">
            <x-icon-button :href="route('admin.role.index')" variant="default" title="Kembali">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </x-icon-button>
            <x-icon-button :href="route('admin.role.edit', $role)" variant="warning" title="Ubah">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            </x-icon-button>
        </div>

        <x-card>
            <div class="p-5 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <x-input-label value="Nama Role" />
                        <p class="mt-1 text-sm text-gray-900 dark:text-white bg-gray-50 dark:bg-slate-700 rounded-lg px-4 py-2.5 border border-gray-200 dark:border-slate-600 capitalize">{{ $role->name }}</p>
                    </div>
                    <div>
                        <x-input-label value="Guard Name" />
                        <p class="mt-1 text-sm text-gray-900 dark:text-white bg-gray-50 dark:bg-slate-700 rounded-lg px-4 py-2.5 border border-gray-200 dark:border-slate-600">{{ $role->guard_name }}</p>
                    </div>
                </div>

                <div>
                    <x-input-label value="Permissions ({{ $role->permissions->count() }})" />
                    @php
                        $groupedPerms = $role->permissions->groupBy(fn($p) => explode('.', $p->name)[0]);
                    @endphp
                    @if($groupedPerms->count() > 0)
                        <div class="mt-2 space-y-4">
                            @foreach($groupedPerms as $group => $perms)
                                <div>
                                    <h4 class="text-sm font-semibold text-gray-900 dark:text-white capitalize mb-2">{{ str_replace('-', ' ', $group) }}</h4>
                                    <div class="flex flex-wrap gap-1.5">
                                        @foreach($perms as $perm)
                                            <x-badge color="blue">{{ $perm->name }}</x-badge>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="mt-2 text-sm text-gray-400 dark:text-slate-500">Tidak ada permission</p>
                    @endif
                </div>
            </div>
        </x-card>
    </div>
</x-app-layout>
