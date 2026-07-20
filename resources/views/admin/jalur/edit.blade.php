<x-app-layout>
    <x-slot name="header">Edit Jalur Pendaftaran</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Jalur Pendaftaran', 'url' => route('admin.jalur.index')],
            ['label' => 'Edit'],
        ]" />

        <x-admin.module-header title="Edit Jalur Pendaftaran" description="Perbarui informasi jalur pendaftaran.">
            <x-slot name="icon">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </x-slot>
        </x-admin.module-header>

        <x-card>
            <form action="{{ route('admin.jalur.update', $data->id) }}" method="POST" class="space-y-5">
                @csrf @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <x-input-label for="nama_jalur" value="* Nama Jalur" />
                        <input type="text" id="nama_jalur" name="nama_jalur" value="{{ old('nama_jalur', $data->nama) }}" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" placeholder="Contoh: Jalur Prestasi" required />
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Nama jalur pendaftaran (misal: Jalur Prestasi, Jalur Reguler)</p>
                        <x-input-error :messages="$errors->get('nama_jalur')" class="mt-1" />
                    </div>

                    <div>
                        <x-input-label for="kuota" value="* Kuota" />
                        <input type="number" id="kuota" name="kuota" value="{{ old('kuota', $data->kuota) }}" min="0" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" placeholder="Masukkan jumlah kuota..." required />
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Jumlah maksimal peserta yang dapat mendaftar</p>
                        <x-input-error :messages="$errors->get('kuota')" class="mt-1" />
                    </div>

                    <div class="md:col-span-2">
                        <x-input-label for="deskripsi" value="Deskripsi" />
                        <textarea id="deskripsi" name="deskripsi" rows="4" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" placeholder="Masukkan deskripsi jalur pendaftaran...">{{ old('deskripsi', $data->deskripsi) }}</textarea>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Jelaskan detail jalur pendaftaran (opsional)</p>
                        <x-input-error :messages="$errors->get('deskripsi')" class="mt-1" />
                    </div>

                    <div>
                        <x-input-label for="periode_id" value="Periode" />
                        <select id="periode_id" name="periode_id" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20">
                            <option value="">Pilih Periode...</option>
                            @foreach(\App\Models\PeriodePpdb::with('tahunAjaran')->get() as $periode)
                                <option value="{{ $periode->id }}" {{ old('periode_id', $data->periode_id ?? null) == $periode->id ? 'selected' : '' }}>
                                    {{ $periode->nama }} ({{ $periode->tahunAjaran->tahun_awal ?? '-' }}/{{ $periode->tahunAjaran->tahun_akhir ?? '' }})
                                </option>
                            @endforeach
                        </select>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Pilih periode pendaftaran untuk jalur ini (opsional)</p>
                        <x-input-error :messages="$errors->get('periode_id')" class="mt-1" />
                    </div>

                    <div class="md:col-span-2">
                        <label class="inline-flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="is_aktif" value="1" class="rounded border-gray-300 text-blue-600 focus:ring-2 focus:ring-blue-500/20" {{ old('is_aktif', $data->is_aktif) ? 'checked' : '' }}>
                            <span class="text-sm font-medium text-gray-700">Aktifkan jalur pendaftaran</span>
                        </label>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-5 border-t border-gray-200">
                    <x-secondary-button type="button" onclick="window.location='{{ route('admin.jalur.index') }}'">Batal</x-secondary-button>
                    <x-primary-button type="submit">Update</x-primary-button>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
