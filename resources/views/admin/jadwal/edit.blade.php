<x-app-layout>
    <x-slot name="header">Edit Jadwal PPDB</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Jadwal PPDB', 'url' => route('admin.jadwal.index')],
            ['label' => 'Edit'],
        ]" />

        <x-admin.module-header title="Edit Jadwal PPDB" description="Perbarui informasi jadwal kegiatan PPDB.">
            <x-slot name="icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </x-slot>
        </x-admin.module-header>

        <x-card>
            <form action="{{ route('admin.jadwal.update', $data->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="space-y-5">
                    <div>
                        <x-input-label for="kegiatan" value="* Kegiatan" />
                        <x-text-input type="text" id="kegiatan" name="kegiatan" :value="old('kegiatan', $data->kegiatan)" class="mt-1" placeholder="Masukkan nama kegiatan..." required />
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Masukkan nama kegiatan yang akan dilaksanakan</p>
                        <x-input-error :messages="$errors->get('kegiatan')" class="mt-1.5" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <x-input-label for="tanggal_mulai" value="* Tanggal Mulai" />
                            <x-text-input type="date" id="tanggal_mulai" name="tanggal_mulai" :value="old('tanggal_mulai', $data->tanggal_mulai ? $data->tanggal_mulai->format('Y-m-d') : '')" class="mt-1" required />
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Pilih tanggal mulai kegiatan</p>
                            <x-input-error :messages="$errors->get('tanggal_mulai')" class="mt-1.5" />
                        </div>

                        <div>
                            <x-input-label for="tanggal_selesai" value="* Tanggal Selesai" />
                            <x-text-input type="date" id="tanggal_selesai" name="tanggal_selesai" :value="old('tanggal_selesai', $data->tanggal_selesai ? $data->tanggal_selesai->format('Y-m-d') : '')" class="mt-1" required />
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Pilih tanggal berakhirnya kegiatan</p>
                            <x-input-error :messages="$errors->get('tanggal_selesai')" class="mt-1.5" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="deskripsi" value="Deskripsi" />
                        <textarea id="deskripsi" name="deskripsi" rows="4" class="mt-1 block w-full rounded-lg border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white focus:border-blue-500 focus:ring-blue-500 text-sm transition-colors" placeholder="Masukkan deskripsi kegiatan...">{{ old('deskripsi', $data->deskripsi) }}</textarea>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Deskripsikan detail kegiatan (opsional)</p>
                        <x-input-error :messages="$errors->get('deskripsi')" class="mt-1.5" />
                    </div>

                    <div>
                        <x-input-label for="urutan" value="Urutan" />
                        <x-text-input type="number" id="urutan" name="urutan" :value="old('urutan', $data->urutan)" class="mt-1" min="0" placeholder="Masukkan urutan tampilan..." />
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Angka menentukan posisi tampilan (0 = paling atas)</p>
                        <x-input-error :messages="$errors->get('urutan')" class="mt-1.5" />
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-gray-100 dark:border-slate-700">
                    <x-secondary-button href="{{ route('admin.jadwal.index') }}">Batal</x-secondary-button>
                    <x-primary-button type="submit">Simpan</x-primary-button>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
