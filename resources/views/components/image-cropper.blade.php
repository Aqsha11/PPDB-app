@props(['name', 'id' => null, 'label' => null, 'preview' => null, 'aspectRatio' => 'null', 'required' => false, 'accept' => 'image/*'])

@php
    $inputId = $id ?? $name;
    $previewId = $inputId . '-preview';
@endphp

<div x-data="imageCrop({ inputId: '{{ $inputId }}', previewId: '{{ $previewId }}', aspectRatio: {{ $aspectRatio }} })" class="space-y-2">
    @if($label)
        <label class="block text-sm font-medium text-gray-700 dark:text-slate-300">{{ $label }}</label>
    @endif

    @if($preview)
        <div class="rounded-xl overflow-hidden border border-gray-200 dark:border-slate-600 bg-gray-50 dark:bg-slate-700">
            <img id="{{ $previewId }}" src="{{ $preview }}" alt="Preview" class="w-full h-48 object-cover">
        </div>
    @else
        <div class="rounded-xl overflow-hidden border border-dashed border-gray-300 dark:border-slate-600 bg-gray-50 dark:bg-slate-700">
            <img id="{{ $previewId }}" src="" alt="Preview" class="w-full h-48 object-cover hidden">
            <div class="flex flex-col items-center justify-center py-8 text-gray-400 dark:text-slate-500">
                <svg class="w-10 h-10 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <p class="text-xs">Pilih gambar untuk preview</p>
            </div>
        </div>
    @endif

    <input type="file" id="{{ $inputId }}" name="{{ $name }}" accept="{{ $accept }}" @if($required) required @endif
        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-theme-light file:text-theme dark:file:bg-slate-600 dark:file:text-slate-200 hover:file:opacity-80 transition-all">

    {{-- Cropper Modal --}}
    <template x-if="open">
        <div class="fixed inset-0 z-[999] flex items-center justify-center bg-black/60 backdrop-blur-sm p-4" @keydown.escape.window="closeCrop()">
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] flex flex-col">
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 dark:border-slate-700">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">Potong Gambar</h3>
                    <button @click="closeCrop()" class="p-1.5 rounded-lg hover:bg-gray-100 dark:hover:bg-slate-700 text-gray-400 hover:text-gray-600 dark:hover:text-white transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                <div class="flex-1 overflow-auto p-6">
                    <div class="bg-gray-900 rounded-xl overflow-hidden">
                        <img x-ref="cropImage" :src="src" class="max-h-[50vh] w-full">
                    </div>
                </div>
                <div class="flex items-center justify-end gap-3 px-6 py-4 border-t border-gray-100 dark:border-slate-700">
                    <button @click="closeCrop()" type="button" class="px-4 py-2.5 rounded-xl text-sm font-semibold text-gray-700 dark:text-slate-300 hover:bg-gray-100 dark:hover:bg-slate-700 transition">Batal</button>
                    <button @click="crop()" type="button" class="px-5 py-2.5 rounded-xl text-sm font-semibold text-white btn-theme shadow-sm transition hover:shadow-md">Potong &amp; Gunakan</button>
                </div>
            </div>
        </div>
    </template>
</div>
