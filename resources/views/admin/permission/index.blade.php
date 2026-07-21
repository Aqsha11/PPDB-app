<x-app-layout>
    <x-slot name="header">Permission</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Permissions'],
        ]" />

        <x-admin.module-header title="Permission" description="Kelola permission (izin) dan pengaturan hak akses. Buat permission baru atau atur penugasannya ke role.">
            <x-slot name="icon">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
            </x-slot>
            <x-slot name="actions">
                <x-primary-button href="{{ route('admin.permission.create') }}">
                    + Tambah Permission
                </x-primary-button>
            </x-slot>
        </x-admin.module-header>

        <x-card>
            <div class="divide-y divide-gray-100 dark:divide-slate-700">
                @forelse($permissions as $group => $groupPermissions)
                    <div class="py-4 px-2">
                        <div class="flex items-center justify-between mb-3 px-3">
                            <h3 class="text-sm font-bold text-gray-900 dark:text-white uppercase tracking-wider">{{ $group }}</h3>
                            <span class="text-xs text-gray-400 dark:text-slate-500 bg-gray-100 dark:bg-slate-700 px-2 py-0.5 rounded-full">{{ $groupPermissions->count() }}</span>
                        </div>
                        <div class="flex flex-wrap gap-2">
                            @foreach($groupPermissions as $permission)
                                <div class="group relative flex items-center gap-2 px-3 py-2 bg-gray-50 dark:bg-slate-700/50 border border-gray-200 dark:border-slate-600 rounded-lg hover:bg-blue-50 hover:border-blue-200 dark:hover:bg-blue-900/20 dark:hover:border-blue-800 transition">
                                    <span class="text-sm text-gray-700 dark:text-slate-300">{{ $permission->name }}</span>
                                    @if(isset($permission->description) && $permission->description)
                                        <span class="text-xs text-gray-400 dark:text-slate-500">- {{ $permission->description }}</span>
                                    @endif
                                    @can('role.edit')
                                        <div class="hidden group-hover:flex items-center gap-1 ml-2">
                                        <a href="{{ route('admin.permission.edit', $permission->id) }}" class="text-yellow-500 hover:text-yellow-700 p-0.5" title="Edit">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        </a>
                                    </div>
                                    @endcan
                                </div>
                            @endforeach
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12">
                        <p class="text-gray-400 dark:text-slate-500 text-sm">Belum ada permission.</p>
                        @can('role.create')
                            <x-primary-button href="{{ route('admin.permission.create') }}" class="mt-3">+ Tambah Permission</x-primary-button>
                        @endif
                    </div>
                @endforelse
            </div>
        </x-card>
    </div>
</x-app-layout>
