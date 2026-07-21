<x-app-layout>
    <x-slot name="header">Edit Pengumuman</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Pengumuman', 'url' => route('admin.pengumuman.index')],
            ['label' => 'Edit'],
        ]" />

        <x-admin.module-header title="Edit Pengumuman" description="Perbarui informasi pengumuman sekolah.">
            <x-slot name="icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </x-slot>
        </x-admin.module-header>

        <x-card>
            <form action="{{ route('admin.pengumuman.update', $data->id) }}" method="POST" enctype="multipart/form-data" x-data="formValidation()">
                @csrf
                @method('PUT')

                <div class="space-y-5">
                    <div>
                        <x-input-label for="judul" value="* Judul" />
                        <x-text-input type="text" id="judul" name="judul" :value="old('judul', $data->judul)" class="mt-1" placeholder="Masukkan judul pengumuman..." required maxlength="255" />
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Maksimal 255 karakter</p>
                        <x-input-error :messages="$errors->get('judul')" class="mt-1.5" />
                    </div>

                    <div>
                        <x-input-label for="isi" value="* Isi Pengumuman" />
                        <textarea id="isi" name="isi" rows="6" class="mt-1 block w-full rounded-lg border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white focus:border-blue-500 focus:ring-blue-500 text-sm transition-colors" placeholder="Masukkan isi pengumuman..." required>{{ old('isi', $data->isi) }}</textarea>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Tulis isi pengumuman secara lengkap</p>
                        <x-input-error :messages="$errors->get('isi')" class="mt-1.5" />
                    </div>

                    <div>
                        <x-input-label for="lampiran" value="Lampiran (opsional)" />
                        @if($data->lampiran)
                            <div class="mt-2 mb-3 flex items-center gap-2 text-sm text-gray-600 dark:text-slate-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/></svg>
                                <span>Saat ini: {{ basename($data->lampiran) }}</span>
                            </div>
                        @endif
                        <input type="file" id="lampiran" name="lampiran" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-slate-600 dark:file:text-slate-200 dark:hover:file:bg-slate-500">
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Biarkan kosong jika tidak ingin mengubah lampiran.</p>
                        <x-input-error :messages="$errors->get('lampiran')" class="mt-1.5" />
                    </div>

                    <div>
                        <label class="inline-flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="status" value="1" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" {{ old('status', $data->status) ? 'checked' : '' }}>
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
