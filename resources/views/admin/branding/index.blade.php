<x-app-layout>
    <x-slot name="header">Logo & Favicon</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Logo & Favicon'],
        ]" />

        <x-admin.module-header title="Logo & Favicon" description="Kelola logo sekolah dan favicon yang ditampilkan di browser. Logo muncul di sidebar dan halaman publik.">
            <x-slot name="icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </x-slot>
        </x-admin.module-header>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <x-card>
                <form action="{{ route('admin.branding.update') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-1">Logo Sekolah</h3>
                        <p class="text-xs text-gray-500 dark:text-slate-400 mb-4">Logo ditampilkan di sidebar admin, header halaman publik, dan email. Format: PNG, JPG, atau SVG. Maks 2MB.</p>

                        @if($data->logo ?? null)
                            <div class="mb-4 p-4 bg-gray-50 dark:bg-slate-700 rounded-lg border border-gray-200 dark:border-slate-600 flex items-center gap-4">
                                <img src="{{ Storage::url($data->logo) }}" alt="Logo" class="h-20 w-auto object-contain">
                                <div class="text-xs text-gray-500 dark:text-slate-400">
                                    <p class="font-medium text-gray-700 dark:text-white">Logo saat ini</p>
                                    <p>{{ basename($data->logo) }}</p>
                                </div>
                            </div>
                        @else
                            <div class="mb-4 p-8 bg-gray-50 dark:bg-slate-700 rounded-lg border-2 border-dashed border-gray-300 dark:border-slate-600 text-center">
                                <svg class="w-12 h-12 mx-auto text-gray-400 dark:text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <p class="mt-2 text-sm text-gray-500 dark:text-slate-400">Belum ada logo</p>
                            </div>
                        @endif

                        <input type="file" name="logo" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-slate-600 dark:file:text-slate-200 dark:hover:file:bg-slate-500">
                        <x-input-error :messages="$errors->get('logo')" class="mt-1.5" />

                        <div class="flex justify-end mt-4">
                            <x-primary-button type="submit">Simpan Logo</x-primary-button>
                        </div>
                    </div>
                </form>
            </x-card>

            <x-card>
                <form action="{{ route('admin.branding.update') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-1">Favicon</h3>
                        <p class="text-xs text-gray-500 dark:text-slate-400 mb-4">Favicon ditampilkan di tab browser. Format: ICO, PNG, atau SVG. Ukuran ideal 32x32 atau 64x64 px. Maks 512KB.</p>

                        @if($data->favicon ?? null)
                            <div class="mb-4 p-4 bg-gray-50 dark:bg-slate-700 rounded-lg border border-gray-200 dark:border-slate-600 flex items-center gap-4">
                                <img src="{{ Storage::url($data->favicon) }}" alt="Favicon" class="h-10 w-10 object-contain">
                                <div class="text-xs text-gray-500 dark:text-slate-400">
                                    <p class="font-medium text-gray-700 dark:text-white">Favicon saat ini</p>
                                    <p>{{ basename($data->favicon) }}</p>
                                </div>
                            </div>
                        @else
                            <div class="mb-4 p-8 bg-gray-50 dark:bg-slate-700 rounded-lg border-2 border-dashed border-gray-300 dark:border-slate-600 text-center">
                                <svg class="w-10 h-10 mx-auto text-gray-400 dark:text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
                                <p class="mt-2 text-sm text-gray-500 dark:text-slate-400">Belum ada favicon</p>
                            </div>
                        @endif

                        <input type="file" name="favicon" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-slate-600 dark:file:text-slate-200 dark:hover:file:bg-slate-500">
                        <x-input-error :messages="$errors->get('favicon')" class="mt-1.5" />

                        <div class="flex justify-end mt-4">
                            <x-primary-button type="submit">Simpan Favicon</x-primary-button>
                        </div>
                    </div>
                </form>
            </x-card>
        </div>
    </div>
</x-app-layout>
