<x-app-layout>
    <x-slot name="header">Sekolah Asal</x-slot>

    <x-card title="Form Sekolah Asal">
        @if($errors->any())
            <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                <ul class="list-disc list-inside text-sm text-red-600 space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('siswa.sekolah-asal.update') }}">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    <x-input-label for="nama_sekolah" value="Nama Sekolah Asal" />
                    <x-text-input id="nama_sekolah" name="nama_sekolah" type="text" class="mt-1 block w-full" :value="old('nama_sekolah', $sekolah->nama_sekolah)" required />
                    <x-input-error :messages="$errors->get('nama_sekolah')" class="mt-1" />
                </div>
                <div>
                    <x-input-label for="tahun_lulus" value="Tahun Lulus" />
                    <x-text-input id="tahun_lulus" name="tahun_lulus" type="number" min="2000" max="{{ date('Y') }}" class="mt-1 block w-full" :value="old('tahun_lulus', $sekolah->tahun_lulus)" />
                    <x-input-error :messages="$errors->get('tahun_lulus')" class="mt-1" />
                </div>
                <div class="md:col-span-2">
                    <x-input-label for="alamat_sekolah" value="Alamat Sekolah" />
                    <textarea id="alamat_sekolah" name="alamat_sekolah" rows="3" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('alamat_sekolah', $sekolah->alamat_sekolah) }}</textarea>
                    <x-input-error :messages="$errors->get('alamat_sekolah')" class="mt-1" />
                </div>
            </div>

            <div class="mt-6 flex items-center gap-3">
                <x-primary-button>Simpan Sekolah Asal</x-primary-button>
                <a href="{{ route('siswa.dashboard') }}" class="text-sm text-gray-600 hover:underline">Batal</a>
            </div>
        </form>
    </x-card>
</x-app-layout>
