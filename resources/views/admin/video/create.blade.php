<x-app-layout>
    <x-slot name="header">Tambah Video</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Video', 'url' => route('admin.video.index')],
            ['label' => 'Tambah'],
        ]" />

        <x-admin.module-header title="Tambah Video" description="Tambahkan video YouTube baru untuk ditampilkan di halaman publik.">
            <x-slot name="icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </x-slot>
        </x-admin.module-header>

        <x-card>
            <form action="{{ route('admin.video.store') }}" method="POST">
                @csrf

                <div class="space-y-5">
                    <div>
                        <x-input-label for="judul" value="* Judul Video" />
                        <x-text-input type="text" id="judul" name="judul" :value="old('judul')" class="mt-1" placeholder="Masukkan judul video..." required />
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Judul video yang ditampilkan di halaman publik</p>
                        <x-input-error :messages="$errors->get('judul')" class="mt-1.5" />
                    </div>

                    <div>
                        <x-input-label for="url_embed" value="* URL Embed YouTube" />
                        <x-text-input type="url" id="url_embed" name="url_embed" :value="old('url_embed')" class="mt-1" placeholder="https://www.youtube.com/watch?v=..." required />
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Format: https://www.youtube.com/watch?v=...</p>
                        <x-input-error :messages="$errors->get('url_embed')" class="mt-1.5" />
                    </div>

                    <div>
                        <label class="inline-flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="status" value="1" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" {{ old('status', true) ? 'checked' : '' }}>
                            <span class="text-sm font-medium text-gray-700 dark:text-slate-300">Status Aktif</span>
                        </label>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-gray-100 dark:border-slate-700">
                    <x-secondary-button href="{{ route('admin.video.index') }}">Batal</x-secondary-button>
                    <x-primary-button type="submit">Simpan</x-primary-button>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
