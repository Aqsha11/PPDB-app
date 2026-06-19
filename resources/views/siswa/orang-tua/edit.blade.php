<x-app-layout>
    <x-slot name="header">Data Orang Tua</x-slot>

    <x-card title="Form Data Orang Tua">
        @if($errors->any())
            <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                <ul class="list-disc list-inside text-sm text-red-600 space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('siswa.orang-tua.update') }}">
            @csrf
            @method('PUT')

            <h3 class="text-base font-semibold text-gray-900 mb-3 pb-2 border-b">Data Ayah</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <x-input-label for="nama_ayah" value="Nama Ayah" />
                    <x-text-input id="nama_ayah" name="nama_ayah" type="text" class="mt-1 block w-full" :value="old('nama_ayah', $ortu->nama_ayah)" required />
                    <x-input-error :messages="$errors->get('nama_ayah')" class="mt-1" />
                </div>
                <div>
                    <x-input-label for="pekerjaan_ayah" value="Pekerjaan Ayah" />
                    <x-text-input id="pekerjaan_ayah" name="pekerjaan_ayah" type="text" class="mt-1 block w-full" :value="old('pekerjaan_ayah', $ortu->pekerjaan_ayah)" />
                    <x-input-error :messages="$errors->get('pekerjaan_ayah')" class="mt-1" />
                </div>
            </div>

            <h3 class="text-base font-semibold text-gray-900 mb-3 pb-2 border-b">Data Ibu</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <x-input-label for="nama_ibu" value="Nama Ibu" />
                    <x-text-input id="nama_ibu" name="nama_ibu" type="text" class="mt-1 block w-full" :value="old('nama_ibu', $ortu->nama_ibu)" required />
                    <x-input-error :messages="$errors->get('nama_ibu')" class="mt-1" />
                </div>
                <div>
                    <x-input-label for="pekerjaan_ibu" value="Pekerjaan Ibu" />
                    <x-text-input id="pekerjaan_ibu" name="pekerjaan_ibu" type="text" class="mt-1 block w-full" :value="old('pekerjaan_ibu', $ortu->pekerjaan_ibu)" />
                    <x-input-error :messages="$errors->get('pekerjaan_ibu')" class="mt-1" />
                </div>
            </div>

            <h3 class="text-base font-semibold text-gray-900 mb-3 pb-2 border-b">Data Umum</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <x-input-label for="penghasilan_ortu" value="Penghasilan Orang Tua" />
                    <select id="penghasilan_ortu" name="penghasilan_ortu" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        <option value="">Pilih Range Penghasilan</option>
                        @foreach(['< Rp1.000.000', 'Rp1.000.000 - Rp2.000.000', 'Rp2.000.001 - Rp3.000.000', 'Rp3.000.001 - Rp5.000.000', 'Rp5.000.001 - Rp10.000.000', '> Rp10.000.000'] as $range)
                            <option value="{{ $range }}" {{ old('penghasilan_ortu', $ortu->penghasilan_ortu) === $range ? 'selected' : '' }}>{{ $range }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('penghasilan_ortu')" class="mt-1" />
                </div>
                <div>
                    <x-input-label for="no_hp_ortu" value="No. HP Orang Tua" />
                    <x-text-input id="no_hp_ortu" name="no_hp_ortu" type="text" class="mt-1 block w-full" :value="old('no_hp_ortu', $ortu->no_hp_ortu)" required />
                    <x-input-error :messages="$errors->get('no_hp_ortu')" class="mt-1" />
                </div>
                <div class="md:col-span-2">
                    <x-input-label for="alamat_ortu" value="Alamat Orang Tua" />
                    <textarea id="alamat_ortu" name="alamat_ortu" rows="3" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('alamat_ortu', $ortu->alamat_ortu) }}</textarea>
                    <x-input-error :messages="$errors->get('alamat_ortu')" class="mt-1" />
                </div>
            </div>

            <div class="flex items-center gap-3">
                <x-primary-button>Simpan Data Orang Tua</x-primary-button>
                <a href="{{ route('siswa.dashboard') }}" class="text-sm text-gray-600 hover:underline">Batal</a>
            </div>
        </form>
    </x-card>
</x-app-layout>
