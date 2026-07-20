<x-app-layout>
    <x-slot name="header">Tambah Role</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Roles', 'url' => route('admin.role.index')],
            ['label' => 'Tambah'],
        ]" />

        <x-admin.module-header title="Tambah Role" description="Buat role baru dan tentukan hak akses yang dimilikinya.">
            <x-slot name="icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </x-slot>
        </x-admin.module-header>

        <x-card>
            <form action="{{ route('admin.role.store') }}" method="POST">
                @csrf

                <div class="space-y-5">
                    <div>
                        <x-input-label for="name" value="* Nama Role" />
                        <x-text-input type="text" id="name" name="name" :value="old('name')" class="mt-1" placeholder="Masukkan nama role..." required />
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Contoh: Admin, Operator, Verifikator</p>
                        <input type="hidden" name="guard_name" value="web">
                        <x-input-error :messages="$errors->get('name')" class="mt-1.5" />
                    </div>

                    <div>
                        <x-input-label value="Permissions" />
                        <div class="mt-1 space-y-4">
                            @foreach($permissions as $group => $perms)
                                <fieldset class="border border-gray-200 dark:border-slate-600 rounded-lg p-4">
                                    <legend class="text-sm font-semibold text-gray-900 dark:text-white capitalize px-2">{{ str_replace('-', ' ', $group) }}</legend>
                                    <div class="grid grid-cols-2 md:grid-cols-3 gap-2 mt-3">
                                        @foreach($perms as $perm)
                                            <label class="flex items-center cursor-pointer">
                                                <input type="checkbox" name="permissions[]" value="{{ $perm->name }}" @checked(in_array($perm->name, old('permissions', []))) class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                                <span class="ml-2 text-sm text-gray-700 dark:text-slate-300">{{ $perm->name }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </fieldset>
                            @endforeach
                        </div>
                        <x-input-error :messages="$errors->get('permissions')" class="mt-1.5" />
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-gray-100 dark:border-slate-700">
                    <x-secondary-button href="{{ route('admin.role.index') }}">Batal</x-secondary-button>
                    <x-primary-button type="submit">Simpan</x-primary-button>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
