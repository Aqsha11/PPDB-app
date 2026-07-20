<x-app-layout>
    <x-slot name="header">Tambah Tahun Ajaran</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Tahun Ajaran', 'url' => route('admin.tahun-ajaran.index')],
            ['label' => 'Tambah'],
        ]" />

        <x-admin.module-header title="Tambah Tahun Ajaran" description="Buat tahun ajaran baru untuk pendaftaran PPDB.">
            <x-slot name="icon">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </x-slot>
        </x-admin.module-header>

        <x-card>
            <form action="{{ route('admin.tahun-ajaran.store') }}" method="POST" class="space-y-5">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <x-input-label for="tahun_awal" value="* Tahun Awal" />
                        <input type="number" id="tahun_awal" name="tahun_awal" value="{{ old('tahun_awal') }}" min="2000" max="2099" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" placeholder="Contoh: 2025" required />
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Tahun awal jangka waktu ajaran (misal: 2025)</p>
                        <x-input-error :messages="$errors->get('tahun_awal')" class="mt-1" />
                    </div>

                    <div>
                        <x-input-label for="tahun_akhir" value="* Tahun Akhir" />
                        <input type="number" id="tahun_akhir" name="tahun_akhir" value="{{ old('tahun_akhir') }}" min="2000" max="2099" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" placeholder="Contoh: 2026" required />
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Tahun akhir jangka waktu ajaran (misal: 2026)</p>
                        <x-input-error :messages="$errors->get('tahun_akhir')" class="mt-1" />
                    </div>

                    <div class="md:col-span-2">
                        <label class="inline-flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="is_aktif" value="1" class="rounded border-gray-300 text-blue-600 focus:ring-2 focus:ring-blue-500/20" {{ old('is_aktif', true) ? 'checked' : '' }}>
                            <span class="text-sm font-medium text-gray-700">Aktifkan sebagai tahun ajaran aktif</span>
                        </label>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-5 border-t border-gray-200">
                    <x-secondary-button type="button" onclick="window.location='{{ route('admin.tahun-ajaran.index') }}'">Batal</x-secondary-button>
                    <x-primary-button type="submit">Simpan</x-primary-button>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
