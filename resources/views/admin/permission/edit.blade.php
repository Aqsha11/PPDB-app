<x-app-layout>
    <x-slot name="header">Edit Permission</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Permissions', 'url' => route('admin.permission.index')],
            ['label' => 'Edit Permission'],
        ]" />

        <x-admin.module-header title="Edit Permission" description="Ubah nama permission atau atur penugasan permission ke role." />

        <x-card>
            <form action="{{ route('admin.permission.update', $permission->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="space-y-5">
                    <div>
                        <x-input-label for="name" value="Nama Permission *" />
                        <x-text-input type="text" id="name" name="name" :value="old('name', $permission->name)" class="mt-1 w-full" required />
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Gunakan dot notation: <code>module.action</code></p>
                        <x-input-error :messages="$errors->get('name')" class="mt-1.5" />
                    </div>

                    <div>
                        <x-input-label for="display_name" value="Nama Tampilan (opsional)" />
                        <x-text-input type="text" id="display_name" name="display_name" :value="old('display_name', $permission->description??'')" class="mt-1 w-full" />
                        <x-input-error :messages="$errors->get('display_name')" class="mt-1.5" />
                    </div>

                    <div>
                        <x-input-label value="Berikan ke Role" />
                        <div class="mt-1 space-y-2 bg-gray-50 dark:bg-slate-700 rounded-lg p-4 border border-gray-200 dark:border-slate-600">
                            @foreach($roles as $role)
                                <label class="flex items-center cursor-pointer">
                                    <input type="checkbox" name="roles[]" value="{{ $role->name }}"
                                           class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                                           @checked(in_array($role->name, old('roles', $roleNames)))>
                                    <span class="ml-2 text-sm text-gray-700 dark:text-slate-300">{{ $role->name }}</span>
                                </label>
                            @endforeach
                        </div>
                        <x-input-error :messages="$errors->get('roles')" class="mt-1.5" />
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-100 dark:border-slate-700">
                        <x-secondary-button href="{{ route('admin.permission.index') }}">Batal</x-secondary-button>
                        <x-primary-button type="submit">Simpan</x-primary-button>
                    </div>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
