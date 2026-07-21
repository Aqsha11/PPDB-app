<x-app-layout>
    <x-slot name="header">Edit User</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Users', 'url' => route('admin.user.index')],
            ['label' => 'Edit'],
        ]" />

        <x-admin.module-header title="Edit User" description="Perbarui data akun pengguna beserta role dan hak aksesnya.">
            <x-slot name="icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </x-slot>
        </x-admin.module-header>

        <x-card>
            <form action="{{ route('admin.user.update', $user->id) }}" method="POST" x-data="formValidation()">
                @csrf
                @method('PUT')

                <div class="space-y-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <x-input-label for="name" value="* Nama" />
                            <x-text-input type="text" id="name" name="name" :value="old('name', $user->name)" class="mt-1" placeholder="Masukkan nama lengkap..." required maxlength="255" />
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Nama lengkap pengguna</p>
                            <x-input-error :messages="$errors->get('name')" class="mt-1.5" />
                        </div>
                        <div>
                            <x-input-label for="email" value="* Email" />
                            <x-text-input type="email" id="email" name="email" :value="old('email', $user->email)" class="mt-1" placeholder="Masukkan alamat email..." required readonly />
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Email tidak dapat diubah</p>
                            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
                        </div>
                        <div>
                            <x-input-label for="password" value="Password (kosongkan jika tidak diubah)" />
                            <x-text-input type="password" id="password" name="password" class="mt-1" placeholder="Masukkan password baru..." maxlength="255" />
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Kosongkan jika tidak ingin mengubah password</p>
                            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
                        </div>
                        <div>
                            <x-input-label for="password_confirmation" value="Konfirmasi Password" />
                            <x-text-input type="password" id="password_confirmation" name="password_confirmation" class="mt-1" placeholder="Ulangi password baru..." maxlength="255" />
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Masukkan ulang password yang sama</p>
                        </div>
                    </div>

                    <div>
                        <x-input-label value="Role" />
                        <div class="mt-1 space-y-2 bg-gray-50 dark:bg-slate-700 rounded-lg p-4 border border-gray-200 dark:border-slate-600">
                            @foreach($roles as $role)
                                <label class="flex items-center cursor-pointer">
                                    <input type="checkbox" name="roles[]" value="{{ $role->name }}" @checked(in_array($role->name, old('roles', $user->getRoleNames()->toArray()))) class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-700 dark:text-slate-300">{{ $role->name }}</span>
                                </label>
                            @endforeach
                        </div>
                        <x-input-error :messages="$errors->get('roles')" class="mt-1.5" />
                    </div>

                    <div>
                        <label class="inline-flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" {{ old('is_active', $user->is_active ?? true) ? 'checked' : '' }}>
                            <span class="text-sm font-medium text-gray-700 dark:text-slate-300">Status Aktif</span>
                        </label>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-gray-100 dark:border-slate-700">
                    <x-secondary-button href="{{ route('admin.user.index') }}">Batal</x-secondary-button>
                    <x-primary-button type="submit">Simpan</x-primary-button>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
