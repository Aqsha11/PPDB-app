<x-app-layout>
    <x-slot name="header">Tambah Pengumuman</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Pengumuman', 'url' => route('admin.pengumuman.index')],
            ['label' => 'Tambah'],
        ]" />

        <x-admin.module-header title="Tambah Pengumuman" description="Buat pengumuman baru untuk ditampilkan di halaman publik.">
            <x-slot name="icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </x-slot>
        </x-admin.module-header>

        <x-card>
            <form action="{{ route('admin.pengumuman.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="space-y-5">
                    <div>
                        <x-input-label for="judul" value="* Judul" />
                        <x-text-input type="text" id="judul" name="judul" :value="old('judul')" class="mt-1" placeholder="Masukkan judul pengumuman..." required />
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Maksimal 255 karakter</p>
                        <x-input-error :messages="$errors->get('judul')" class="mt-1.5" />
                    </div>

                    <div>
                        <x-input-label for="isi" value="* Isi Pengumuman" />
                        <textarea id="isi" name="isi" rows="6" class="mt-1 block w-full rounded-lg border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white focus:border-blue-500 focus:ring-blue-500 text-sm transition-colors" placeholder="Masukkan isi pengumuman..." required>{{ old('isi') }}</textarea>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Tulis isi pengumuman secara lengkap</p>
                        <x-input-error :messages="$errors->get('isi')" class="mt-1.5" />
                    </div>

                    <div>
                        <x-input-label for="lampiran" value="Lampiran (opsional)" />
                        <input type="file" id="lampiran" name="lampiran" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-slate-600 dark:file:text-slate-200 dark:hover:file:bg-slate-500">
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Format: PDF, DOC, JPG, PNG. Maks 10MB.</p>
                        <x-input-error :messages="$errors->get('lampiran')" class="mt-1.5" />
                    </div>

                    <div>
                        <label class="inline-flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="status" value="1" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" {{ old('status', true) ? 'checked' : '' }}>
                            <span class="text-sm font-medium text-gray-700 dark:text-slate-300">Status Aktif</span>
                        </label>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-gray-100 dark:border-slate-700">
                    <x-secondary-button href="{{ route('admin.pengumuman.index') }}">Batal</x-secondary-button>
                    <x-primary-button type="submit">Simpan</x-primary-button>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
