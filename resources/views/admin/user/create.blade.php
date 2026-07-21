<x-app-layout>
    <x-slot name="header">Tambah User</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Users', 'url' => route('admin.user.index')],
            ['label' => 'Tambah'],
        ]" />

        <x-admin.module-header title="Tambah User" description="Buat akun pengguna baru beserta role dan hak aksesnya.">
            <x-slot name="icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </x-slot>
        </x-admin.module-header>

        <x-card>
            <form action="{{ route('admin.user.store') }}" method="POST" x-data="formValidation()">
                @csrf

                <div class="space-y-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <x-input-label for="name" value="* Nama" />
                            <x-text-input type="text" id="name" name="name" :value="old('name')" class="mt-1" placeholder="Masukkan nama lengkap..." required maxlength="255" />
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Nama lengkap pengguna</p>
                            <x-input-error :messages="$errors->get('name')" class="mt-1.5" />
                        </div>
                        <div>
                            <x-input-label for="email" value="* Email" />
                            <x-text-input type="email" id="email" name="email" :value="old('email')" class="mt-1" placeholder="Masukkan alamat email..." required maxlength="255" />
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Contoh: nama@domain.com</p>
                            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
                        </div>
                        <div>
                            <x-input-label for="password" value="* Password" />
                            <x-text-input type="password" id="password" name="password" class="mt-1" placeholder="Masukkan password..." required minlength="8" maxlength="255" />
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Minimal 8 karakter</p>
                            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
                        </div>
                        <div>
                            <x-input-label for="password_confirmation" value="* Konfirmasi Password" />
                            <x-text-input type="password" id="password_confirmation" name="password_confirmation" class="mt-1" placeholder="Ulangi password..." required maxlength="255" />
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Masukkan ulang password yang sama</p>
                        </div>
                    </div>

                    <div>
                        <x-input-label value="Role" />
                        <div class="mt-1 space-y-2 bg-gray-50 dark:bg-slate-700 rounded-lg p-4 border border-gray-200 dark:border-slate-600">
                            @foreach($roles as $role)
                                <label class="flex items-center cursor-pointer">
                                    <input type="checkbox" name="roles[]" value="{{ $role->name }}" @checked(in_array($role->name, old('roles', []))) class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-700 dark:text-slate-300">{{ $role->name }}</span>
                                </label>
                            @endforeach
                        </div>
                        <x-input-error :messages="$errors->get('roles')" class="mt-1.5" />
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
