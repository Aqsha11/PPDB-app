<x-app-layout>
    <x-slot name="header">Tambah Statistik</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Statistik', 'url' => route('admin.statistik.index')],
            ['label' => 'Tambah'],
        ]" />

        <x-admin.module-header title="Tambah Statistik" description="Tambahkan angka statistik baru untuk ditampilkan di halaman depan.">
            <x-slot name="icon">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </x-slot>
        </x-admin.module-header>

        <x-card>
            <form action="{{ route('admin.statistik.store') }}" method="POST" class="space-y-5">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <x-input-label for="judul" value="* Label" />
                        <input type="text" id="judul" name="judul" value="{{ old('judul') }}" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" placeholder="Masukkan label statistik..." required />
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Contoh: Guru, Peserta Didik, Kelas</p>
                        <x-input-error :messages="$errors->get('judul')" class="mt-1" />
                    </div>

                    <div>
                        <x-input-label for="jumlah" value="* Nilai" />
                        <input type="number" id="jumlah" name="jumlah" value="{{ old('jumlah') }}" min="0" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" placeholder="Masukkan jumlah angka..." required />
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Angka yang akan ditampilkan sebagai statistik</p>
                        <x-input-error :messages="$errors->get('jumlah')" class="mt-1" />
                    </div>

                    <div>
                        <x-input-label for="icon" value="Icon" />
                        <input type="text" id="icon" name="icon" value="{{ old('icon') }}" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" placeholder="Masukkan nama icon..." />
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Format: fas fa-nama-icon (contoh: fas fa-users)</p>
                        <x-input-error :messages="$errors->get('icon')" class="mt-1" />
                    </div>

                    <div>
                        <x-input-label value="Status" />
                        <label class="inline-flex items-center gap-2 cursor-pointer mt-2">
                            <input type="checkbox" name="is_aktif" value="1" class="rounded border-gray-300 text-blue-600 focus:ring-2 focus:ring-blue-500/20" {{ old('is_aktif', true) ? 'checked' : '' }}>
                            <span class="text-sm font-medium text-gray-700">Aktif</span>
                        </label>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-5 border-t border-gray-200">
                    <x-secondary-button type="button" onclick="window.location='{{ route('admin.statistik.index') }}'">Batal</x-secondary-button>
                    <x-primary-button type="submit">Simpan</x-primary-button>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
