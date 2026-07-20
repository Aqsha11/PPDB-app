<x-app-layout>
    <x-slot name="header">SEO Settings</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'SEO'],
        ]" />

        <x-admin.module-header title="SEO (Search Engine Optimization)" description="Atur meta title, meta description, keywords, dan favicon untuk meningkatkan visibilitas website di mesin pencari.">
            <x-slot name="icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </x-slot>
        </x-admin.module-header>

        <x-card>
            <form action="{{ route('admin.seo.update') }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <x-input-label for="meta_title" value="Meta Title" />
                        <x-text-input type="text" id="meta_title" name="meta_title" :value="old('meta_title', $data->meta_title ?? '')" class="mt-1" />
                        <x-input-error :messages="$errors->get('meta_title')" class="mt-1.5" />
                    </div>
                    <div>
                        <x-input-label for="meta_keywords" value="Meta Keywords" />
                        <x-text-input type="text" id="meta_keywords" name="meta_keywords" :value="old('meta_keywords', $data->meta_keywords ?? '')" class="mt-1" placeholder="keyword1, keyword2, keyword3" />
                        <x-input-error :messages="$errors->get('meta_keywords')" class="mt-1.5" />
                    </div>
                </div>

                <div>
                    <x-input-label for="meta_description" value="Meta Description" />
                    <textarea id="meta_description" name="meta_description" rows="3" class="mt-1 block w-full rounded-lg border-gray-300 dark:border-slate-600 dark:bg-slate-700 dark:text-white focus:border-blue-500 focus:ring-blue-500 text-sm transition-colors">{{ old('meta_description', $data->meta_description ?? '') }}</textarea>
                    <x-input-error :messages="$errors->get('meta_description')" class="mt-1.5" />
                </div>

                <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-gray-100 dark:border-slate-700">
                    <x-primary-button type="submit">Simpan</x-primary-button>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
