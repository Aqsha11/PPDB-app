<x-app-layout>
    <x-slot name="header">Detail Testimoni</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Testimoni', 'url' => route('admin.testimoni.index')],
            ['label' => 'Detail'],
        ]" />

        <x-card>
            <div class="space-y-4">
                <div>
                    <span class="text-sm font-medium text-gray-500">Nama</span>
                    <p class="mt-1 text-sm text-gray-900">{{ $data->nama }}</p>
                </div>

                <div>
                    <span class="text-sm font-medium text-gray-500">Testimoni</span>
                    <p class="mt-1 text-sm text-gray-900">{{ $data->isi }}</p>
                </div>

                <div>
                    <span class="text-sm font-medium text-gray-500">Foto</span>
                    <div class="mt-1">
                        @if($data->foto)
                            <img src="{{ Storage::url($data->foto) }}" class="w-20 h-20 object-cover rounded-full border border-gray-200">
                        @else
                            <p class="text-sm text-gray-400">Tidak ada foto</p>
                        @endif
                    </div>
                </div>

                <div>
                    <span class="text-sm font-medium text-gray-500">Dibuat Pada</span>
                    <p class="mt-1 text-sm text-gray-900">{{ $data->created_at ? $data->created_at->format('d/m/Y H:i') : '-' }}</p>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-gray-100">
                <a href="{{ route('admin.testimoni.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Kembali
                </a>
                <a href="{{ route('admin.testimoni.edit', $data->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Edit
                </a>
            </div>
        </x-card>
    </div>
</x-app-layout>
