<x-app-layout>
    <x-slot name="header">Tambah Permission</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Permissions', 'url' => route('admin.permission.index')],
            ['label' => 'Tambah Permission'],
        ]" />

        <x-admin.module-header title="Tambah Permission" description="Buat permission baru. Gunakan format dot notation, contoh: module.action (misal: laporan.print)." />

        <x-card>
            <form action="{{ route('admin.permission.store') }}" method="POST">
                @csrf

                <div class="space-y-5">
                    <div>
                        <x-input-label for="name" value="Nama Permission *" />
                        <x-text-input type="text" id="name" name="name" :value="old('name')" class="mt-1 w-full" placeholder="contoh: laporan.print" required />
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Gunakan <strong>dot notation</strong>, misal: <code>module.action</code> (laporan.print). Hanya huruf, angka, titik, strip, dan underscore.</p>
                        <x-input-error :messages="$errors->get('name')" class="mt-1.5" />
                    </div>

                    <div>
                        <x-input-label for="display_name" value="Nama Tampilan (opsional)" />
                        <x-text-input type="text" id="display_name" name="display_name" :value="old('display_name')" class="mt-1 w-full" placeholder="Contoh: Cetak Laporan" />
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Nama yang lebih mudah dibaca untuk ditampilkan di UI.</p>
                        <x-input-error :messages="$errors->get('display_name')" class="mt-1.5" />
                    </div>

                    <div>
                        <x-input-label value="Berikan ke Role (opsional)" />
                        <div class="mt-1 space-y-2 bg-gray-50 dark:bg-slate-700 rounded-lg p-4 border border-gray-200 dark:border-slate-600">
                            @foreach($roles as $role)
                                <label class="flex items-center cursor-pointer">
                                    <input type="checkbox" name="roles[]" value="{{ $role->name }}" @checked(in_array($role->name, old('roles', [])))
                                           class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
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
