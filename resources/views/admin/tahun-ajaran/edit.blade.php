<x-app-layout>
    <x-slot name="header">Edit Tahun Ajaran</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Tahun Ajaran', 'url' => route('admin.tahun-ajaran.index')],
            ['label' => 'Edit'],
        ]" />

        <x-card>
            <form action="{{ route('admin.tahun-ajaran.update', $data->id) }}" method="POST">
                @csrf @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-input-label for="tahun_awal" value="Tahun Awal" />
                        <input type="number" id="tahun_awal" name="tahun_awal" value="{{ old('tahun_awal', $data->tahun_awal) }}" min="2000" max="2099" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="Contoh: 2025" required />
                        <x-input-error :messages="$errors->get('tahun_awal')" class="mt-1" />
                    </div>

                    <div>
                        <x-input-label for="tahun_akhir" value="Tahun Akhir" />
                        <input type="number" id="tahun_akhir" name="tahun_akhir" value="{{ old('tahun_akhir', $data->tahun_akhir) }}" min="2000" max="2099" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="Contoh: 2026" required />
                        <x-input-error :messages="$errors->get('tahun_akhir')" class="mt-1" />
                    </div>

                    <div class="md:col-span-2">
                        <label class="inline-flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="is_aktif" value="1" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" @checked(old('is_aktif', $data->is_aktif))>
                            <span class="text-sm font-medium text-gray-700">Aktifkan sebagai tahun ajaran aktif</span>
                        </label>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-gray-100">
                    <a href="{{ route('admin.tahun-ajaran.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Update
                    </button>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
