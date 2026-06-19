<x-app-layout>
    <x-slot name="header">Detail Role</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Roles', 'url' => route('admin.role.index')],
            ['label' => 'Detail']
        ]" />

        <x-card>
            <div class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Role</label>
                        <p class="text-sm text-gray-900 bg-gray-50 rounded-lg px-4 py-2.5 border border-gray-200 capitalize">{{ $role->name }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Guard Name</label>
                        <p class="text-sm text-gray-900 bg-gray-50 rounded-lg px-4 py-2.5 border border-gray-200">{{ $role->guard_name }}</p>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">Permissions ({{ $role->permissions->count() }})</label>
                    @php
                        $groupedPerms = $role->permissions->groupBy(fn($p) => explode('.', $p->name)[0]);
                    @endphp
                    @if($groupedPerms->count() > 0)
                        <div class="space-y-4">
                            @foreach($groupedPerms as $group => $perms)
                                <div>
                                    <h4 class="text-sm font-semibold text-gray-900 capitalize mb-2">{{ str_replace('-', ' ', $group) }}</h4>
                                    <div class="flex flex-wrap gap-1.5">
                                        @foreach($perms as $perm)
                                            <x-badge color="blue">{{ $perm->name }}</x-badge>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-sm text-gray-400">Tidak ada permission</p>
                    @endif
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                    <a href="{{ route('admin.role.edit', $role->id) }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">Edit Role</a>
                    <a href="{{ route('admin.role.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">Kembali</a>
                </div>
            </div>
        </x-card>
    </div>
</x-app-layout>
