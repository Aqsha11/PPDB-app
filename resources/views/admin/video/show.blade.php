<x-app-layout>
    <x-slot name="header">Detail Video</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Video', 'url' => route('admin.video.index')],
            ['label' => 'Detail'],
        ]" />

        <x-card>
            <div class="space-y-4">
                <div>
                    <span class="text-sm font-medium text-gray-500">Judul</span>
                    <p class="mt-1 text-sm text-gray-900">{{ $data->judul }}</p>
                </div>

                <div>
                    <span class="text-sm font-medium text-gray-500">URL YouTube</span>
                    <div class="mt-1">
                        <a href="{{ $data->youtube_url }}" target="_blank" class="text-sm text-indigo-600 hover:text-indigo-800 underline">{{ $data->youtube_url }}</a>
                    </div>
                </div>

                <div>
                    <span class="text-sm font-medium text-gray-500">Pratinjau</span>
                    <div class="mt-2">
                        @php
                            $videoId = null;
                            if (preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]+)/', $data->youtube_url, $matches)) {
                                $videoId = $matches[1];
                            }
                        @endphp
                        @if($videoId)
                            <iframe width="480" height="270" src="https://www.youtube.com/embed/{{ $videoId }}" frameborder="0" allowfullscreen class="rounded-lg border border-gray-200"></iframe>
                        @else
                            <p class="text-sm text-gray-400">URL tidak valid</p>
                        @endif
                    </div>
                </div>

                <div>
                    <span class="text-sm font-medium text-gray-500">Dibuat Pada</span>
                    <p class="mt-1 text-sm text-gray-900">{{ $data->created_at ? $data->created_at->format('d/m/Y H:i') : '-' }}</p>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-gray-100">
                <a href="{{ route('admin.video.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Kembali
                </a>
                <a href="{{ route('admin.video.edit', $data->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Edit
                </a>
            </div>
        </x-card>
    </div>
</x-app-layout>
