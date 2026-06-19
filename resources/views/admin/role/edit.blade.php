<x-app-layout>
    <x-slot name="header">Edit Role</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Roles', 'url' => route('admin.role.index')],
            ['label' => 'Edit']
        ]" />

        <x-card>
            <form action="{{ route('admin.role.update', $role->id) }}" method="POST" class="space-y-6">
                @csrf @method('PUT')

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Role</label>
                    <input type="text" name="name" value="{{ old('name', $role->name) }}" required
                        class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <input type="hidden" name="guard_name" value="web">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">Permissions</label>
                    <div class="space-y-6">
                        @foreach($permissions as $group => $perms)
                            <fieldset class="border border-gray-200 rounded-lg p-4">
                                <legend class="text-sm font-semibold text-gray-900 capitalize px-2">{{ str_replace('-', ' ', $group) }}</legend>
                                <div class="grid grid-cols-2 md:grid-cols-3 gap-2 mt-3">
                                    @foreach($perms as $perm)
                                        <label class="flex items-center cursor-pointer">
                                            <input type="checkbox" name="permissions[]" value="{{ $perm->name }}"
                                                @checked(in_array($perm->name, old('permissions', $role->permissions->pluck('name')->toArray())))
                                                class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                            <span class="ml-2 text-sm text-gray-700">{{ $perm->name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </fieldset>
                        @endforeach
                    </div>
                    @error('permissions')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                    <a href="{{ route('admin.role.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">Batal</a>
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">Update</button>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
