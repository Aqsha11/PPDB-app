<x-app-layout>
    <x-slot name="header">Kontak</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[['label' => 'Dashboard', 'route' => 'admin.dashboard'], ['label' => 'Kontak']]" />

        <x-card>
            <form action="{{ route('admin.kontak.update') }}" method="POST" class="space-y-6">
                @csrf @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Alamat</label>
                        <textarea name="alamat" rows="3" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>{{ old('alamat', $data->alamat ?? '') }}</textarea>
                        @error('alamat') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Google Maps Embed</label>
                        <textarea name="maps_embed" rows="3" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="<iframe src=...>{{ old('maps_embed', $data->maps_embed ?? $data->google_maps ?? '') }}</textarea>
                        @error('maps_embed') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Telepon</label>
                        <input type="text" name="telepon" value="{{ old('telepon', $data->telepon ?? '') }}" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @error('telepon') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
                        <input type="email" name="email" value="{{ old('email', $data->email ?? '') }}" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Jam Operasional</label>
                        <input type="text" name="jam_operasional" value="{{ old('jam_operasional', $data->jam_operasional ?? '') }}" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Sen - Jum: 07:00 - 16:00">
                        @error('jam_operasional') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="flex justify-end pt-4 border-t border-gray-100">
                    <x-primary-button type="submit">Simpan</x-primary-button>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
