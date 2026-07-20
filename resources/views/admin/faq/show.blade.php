<x-app-layout>
    <x-slot name="header">Detail FAQ</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'FAQ', 'url' => route('admin.faq.index')],
            ['label' => 'Detail'],
        ]" />

        <x-card>
            <div class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Pertanyaan</label>
                        <p class="text-sm text-gray-900 bg-gray-50 rounded-lg px-4 py-2.5 border border-gray-200">{{ $data->pertanyaan }}</p>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Jawaban</label>
                        <div class="text-sm text-gray-900 bg-gray-50 rounded-lg px-4 py-2.5 border border-gray-200 whitespace-pre-wrap">{{ $data->jawaban }}</div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Urutan</label>
                        <p class="text-sm text-gray-900 bg-gray-50 rounded-lg px-4 py-2.5 border border-gray-200">{{ $data->urutan ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Status</label>
                        <div class="mt-1.5">
                            @if($data->status)
                                <x-badge color="green">Aktif</x-badge>
                            @else
                                <x-badge color="red">Nonaktif</x-badge>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                    <a href="{{ route('admin.faq.edit', $data->id) }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">Edit FAQ</a>
                    <a href="{{ route('admin.faq.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">Kembali</a>
                </div>
            </div>
        </x-card>
    </div>
</x-app-layout>
