<x-app-layout>
    <x-slot name="header">Edit Periode PPDB</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Periode PPDB', 'url' => route('admin.periode.index')],
            ['label' => 'Edit'],
        ]" />

        <x-card>
            <form action="{{ route('admin.periode.update', $data->id) }}" method="POST">
                @csrf @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <x-input-label for="nama_periode" value="Nama Periode" />
                        <input type="text" id="nama_periode" name="nama_periode" value="{{ old('nama_periode', $data->nama_periode) }}" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="Contoh: Gelombang 1" required />
                        <x-input-error :messages="$errors->get('nama_periode')" class="mt-1" />
                    </div>

                    <div>
                        <x-input-label for="tahun_ajaran_id" value="Tahun Ajaran" />
                        <select id="tahun_ajaran_id" name="tahun_ajaran_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                            <option value="">-- Pilih Tahun Ajaran --</option>
                            @foreach(\App\Models\TahunAjaran::all() as $ta)
                                <option value="{{ $ta->id }}" {{ old('tahun_ajaran_id', $data->tahun_ajaran_id) == $ta->id ? 'selected' : '' }}>
                                    {{ $ta->tahun_awal }}/{{ $ta->tahun_akhir }} {{ $ta->is_aktif ? '(Aktif)' : '' }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('tahun_ajaran_id')" class="mt-1" />
                    </div>

                    <div>
                        <x-input-label for="tanggal_mulai" value="Tanggal Mulai" />
                        <input type="date" id="tanggal_mulai" name="tanggal_mulai" value="{{ old('tanggal_mulai', $data->tanggal_mulai?->format('Y-m-d')) }}" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required />
                        <x-input-error :messages="$errors->get('tanggal_mulai')" class="mt-1" />
                    </div>

                    <div>
                        <x-input-label for="tanggal_selesai" value="Tanggal Selesai" />
                        <input type="date" id="tanggal_selesai" name="tanggal_selesai" value="{{ old('tanggal_selesai', $data->tanggal_selesai?->format('Y-m-d')) }}" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required />
                        <x-input-error :messages="$errors->get('tanggal_selesai')" class="mt-1" />
                    </div>

                    <div class="md:col-span-2">
                        <label class="inline-flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="is_aktif" value="1" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" @checked(old('is_aktif', $data->is_aktif))>
                            <span class="text-sm font-medium text-gray-700">Aktifkan sebagai periode aktif</span>
                        </label>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-gray-100">
                    <a href="{{ route('admin.periode.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
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
