<x-app-layout>
    <x-slot name="header">Edit Tahapan PPDB</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Tahapan PPDB', 'url' => route('admin.tahapan.index')],
            ['label' => 'Edit'],
        ]" />

        <x-admin.module-header title="Edit Tahapan PPDB" description="Perbarui informasi tahapan pendaftaran.">
            <x-slot name="icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </x-slot>
        </x-admin.module-header>

        <x-card>
            <form action="{{ route('admin.tahapan.update', $data->id) }}" method="POST" x-data="formValidation()">
                @csrf
                @method('PUT')

                <div class="space-y-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <x-input-label for="judul" value="Nama Tahapan" />
                            <x-text-input type="text" id="judul" name="judul" :value="old('judul', $data->judul)" class="mt-1" placeholder="Nama tahapan" required />
                            <x-input-error :messages="$errors->get('judul')" class="mt-1.5" />
                        </div>

                        <div>
                            <x-input-label for="urutan" value="Urutan" />
                            <x-text-input type="number" id="urutan" name="urutan" :value="old('urutan', $data->urutan)" class="mt-1" min="1" placeholder="Nomor urut" required />
                            <x-input-error :messages="$errors->get('urutan')" class="mt-1.5" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="deskripsi" value="Deskripsi" />
                        <textarea id="deskripsi" name="deskripsi" rows="4" class="mt-1 block w-full rounded-lg border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white focus:border-blue-500 focus:ring-blue-500 text-sm transition-colors" placeholder="Deskripsi tahapan">{{ old('deskripsi', $data->deskripsi) }}</textarea>
                        <x-input-error :messages="$errors->get('deskripsi')" class="mt-1.5" />
                    </div>

                    <div>
                        <label class="inline-flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="status" value="1" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" {{ old('status', $data->status ?? true) ? 'checked' : '' }}>
                            <span class="text-sm font-medium text-gray-700 dark:text-slate-300">Status Aktif</span>
                        </label>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-gray-100 dark:border-slate-700">
                    <x-secondary-button href="{{ route('admin.tahapan.index') }}">Batal</x-secondary-button>
                    <x-primary-button type="submit">Simpan</x-primary-button>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
