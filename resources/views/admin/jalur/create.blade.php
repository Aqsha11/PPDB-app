<x-app-layout>
    <x-slot name="header">Tambah Jalur Pendaftaran</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Jalur Pendaftaran', 'url' => route('admin.jalur.index')],
            ['label' => 'Tambah'],
        ]" />

        <x-card>
            <form action="{{ route('admin.jalur.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-input-label for="nama_jalur" value="Nama Jalur" />
                        <input type="text" id="nama_jalur" name="nama_jalur" value="{{ old('nama_jalur') }}" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="Contoh: Jalur Prestasi" required />
                        <x-input-error :messages="$errors->get('nama_jalur')" class="mt-1" />
                    </div>

                    <div>
                        <x-input-label for="kuota" value="Kuota" />
                        <input type="number" id="kuota" name="kuota" value="{{ old('kuota') }}" min="0" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="Jumlah kuota" required />
                        <x-input-error :messages="$errors->get('kuota')" class="mt-1" />
                    </div>

                    <div class="md:col-span-2">
                        <x-input-label for="deskripsi" value="Deskripsi" />
                        <textarea id="deskripsi" name="deskripsi" rows="4" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="Deskripsi jalur pendaftaran...">{{ old('deskripsi') }}</textarea>
                        <x-input-error :messages="$errors->get('deskripsi')" class="mt-1" />
                    </div>

                    <div class="md:col-span-2">
                        <label class="inline-flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="is_aktif" value="1" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" {{ old('is_aktif', true) ? 'checked' : '' }}>
                            <span class="text-sm font-medium text-gray-700">Aktifkan jalur pendaftaran</span>
                        </label>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-gray-100">
                    <a href="{{ route('admin.jalur.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Simpan
                    </button>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
