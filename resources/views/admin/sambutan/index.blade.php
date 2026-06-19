<x-app-layout>
    <x-slot name="header">Sambutan Kepala Sekolah</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[['label' => 'Dashboard', 'route' => 'admin.dashboard'], ['label' => 'Sambutan']]" />

        <x-card>
            <form action="{{ route('admin.sambutan.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Kepala Sekolah</label>
                        <input type="text" name="nama_kepala_sekolah" value="{{ old('nama_kepala_sekolah', $data->nama_kepala_sekolah ?? $data->nama ?? '') }}" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                        @error('nama_kepala_sekolah') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Foto</label>
                        @if($data->foto ?? null)
                            <div class="mb-3">
                                <img src="{{ Storage::url($data->foto) }}" class="w-32 h-32 object-cover rounded-lg border border-gray-200">
                            </div>
                        @endif
                        <input type="file" name="foto" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        @error('foto') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Sambutan</label>
                    <textarea name="sambutan" rows="10" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>{{ old('sambutan', $data->sambutan ?? $data->isi ?? '') }}</textarea>
                    @error('sambutan') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div class="flex justify-end pt-4 border-t border-gray-100">
                    <x-primary-button type="submit">Simpan</x-primary-button>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
