<x-app-layout>
    <x-slot name="header">Tambah Periode PPDB</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Periode PPDB', 'url' => route('admin.periode.index')],
            ['label' => 'Tambah'],
        ]" />

        <x-admin.module-header title="Tambah Periode PPDB" description="Buat periode pendaftaran baru untuk tahun ajaran tertentu.">
            <x-slot name="icon">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </x-slot>
        </x-admin.module-header>

        <x-card>
            <form action="{{ route('admin.periode.store') }}" method="POST" class="space-y-5" x-data="formValidation()">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="md:col-span-2">
                        <x-input-label for="nama" value="* Nama Periode" />
                        <input type="text" id="nama" name="nama" value="{{ old('nama') }}" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" placeholder="Contoh: Gelombang 1" required />
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Masukkan nama atau gelombang periode pendaftaran</p>
                        <x-input-error :messages="$errors->get('nama')" class="mt-1" />
                    </div>

                    <div>
                        <x-input-label for="tahun_ajaran_id" value="* Tahun Ajaran" />
                        <select id="tahun_ajaran_id" name="tahun_ajaran_id" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" required>
                            <option value="">Pilih Tahun Ajaran...</option>
                            @foreach(\App\Models\TahunAjaran::all() as $ta)
                                <option value="{{ $ta->id }}" {{ old('tahun_ajaran_id') == $ta->id ? 'selected' : '' }}>
                                    {{ $ta->tahun_awal }}/{{ $ta->tahun_akhir }} {{ $ta->is_aktif ? '(Aktif)' : '' }}
                                </option>
                            @endforeach
                        </select>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Pilih tahun ajaran untuk periode ini</p>
                        <x-input-error :messages="$errors->get('tahun_ajaran_id')" class="mt-1" />
                    </div>

                    <div>
                        <x-input-label for="tanggal_mulai" value="* Tanggal Mulai" />
                        <input type="date" id="tanggal_mulai" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" required />
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Tanggal dibukanya pendaftaran</p>
                        <x-input-error :messages="$errors->get('tanggal_mulai')" class="mt-1" />
                    </div>

                    <div>
                        <x-input-label for="tanggal_selesai" value="* Tanggal Selesai" />
                        <input type="date" id="tanggal_selesai" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" required />
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Tanggal ditutupnya pendaftaran</p>
                        <x-input-error :messages="$errors->get('tanggal_selesai')" class="mt-1" />
                    </div>

                    <div class="md:col-span-2">
                        <label class="inline-flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="status_aktif" value="1" class="rounded border-gray-300 text-blue-600 focus:ring-2 focus:ring-blue-500/20" {{ old('status_aktif', true) ? 'checked' : '' }}>
                            <span class="text-sm font-medium text-gray-700">Aktifkan sebagai periode aktif</span>
                        </label>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-5 border-t border-gray-200">
                    <x-secondary-button type="button" onclick="window.location='{{ route('admin.periode.index') }}'">Batal</x-secondary-button>
                    <x-primary-button type="submit">Simpan</x-primary-button>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
