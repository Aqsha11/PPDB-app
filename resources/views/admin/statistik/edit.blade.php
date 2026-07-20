<x-app-layout>
    <x-slot name="header">Edit Statistik</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Statistik', 'url' => route('admin.statistik.index')],
            ['label' => 'Edit'],
        ]" />

        <x-admin.module-header title="Edit Statistik" description="Perbarui angka statistik sekolah.">
            <x-slot name="icon">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </x-slot>
        </x-admin.module-header>

        <x-card>
            <form action="{{ route('admin.statistik.update', $data->id) }}" method="POST" class="space-y-5">
                @csrf @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <x-input-label for="judul" value="* Label" />
                        <input type="text" id="judul" name="judul" value="{{ old('judul', $data->judul) }}" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" placeholder="Masukkan label statistik..." required />
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Contoh: Guru, Peserta Didik, Kelas</p>
                        <x-input-error :messages="$errors->get('judul')" class="mt-1" />
                    </div>

                    <div>
                        <x-input-label for="jumlah" value="* Nilai" />
                        <input type="number" id="jumlah" name="jumlah" value="{{ old('jumlah', $data->jumlah) }}" min="0" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" placeholder="Masukkan jumlah angka..." required />
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Angka yang akan ditampilkan sebagai statistik</p>
                        <x-input-error :messages="$errors->get('jumlah')" class="mt-1" />
                    </div>

                    <div>
                        <x-input-label for="icon" value="Icon" />
                        <input type="text" id="icon" name="icon" value="{{ old('icon', $data->icon) }}" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" placeholder="Masukkan nama icon..." />
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Format: fas fa-nama-icon (contoh: fas fa-users)</p>
                        <x-input-error :messages="$errors->get('icon')" class="mt-1" />
                    </div>

                    <div>
                        <x-input-label value="Status" />
                        <label class="inline-flex items-center gap-2 cursor-pointer mt-2">
                            <input type="checkbox" name="is_aktif" value="1" class="rounded border-gray-300 text-blue-600 focus:ring-2 focus:ring-blue-500/20" @checked(old('is_aktif', $data->is_aktif ?? true))>
                            <span class="text-sm font-medium text-gray-700">Aktif</span>
                        </label>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-5 border-t border-gray-200">
                    <x-secondary-button type="button" onclick="window.location='{{ route('admin.statistik.index') }}'">Batal</x-secondary-button>
                    <x-primary-button type="submit">Update</x-primary-button>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
