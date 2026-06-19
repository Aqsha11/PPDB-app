<x-app-layout>
    <x-slot name="header">SEO Settings</x-slot>

    <div class="space-y-6">
        <x-breadcrumb :items="[['label' => 'Dashboard', 'route' => 'admin.dashboard'], ['label' => 'SEO']]" />

        <x-card>
            <form action="{{ route('admin.seo.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Meta Title</label>
                        <input type="text" name="meta_title" value="{{ old('meta_title', $data->meta_title ?? '') }}" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @error('meta_title') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Meta Keywords</label>
                        <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $data->meta_keywords ?? '') }}" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="keyword1, keyword2, keyword3">
                        @error('meta_keywords') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Google Analytics ID</label>
                        <input type="text" name="google_analytics_id" value="{{ old('google_analytics_id', $data->google_analytics_id ?? '') }}" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="G-XXXXXXXXXX">
                        @error('google_analytics_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Google Site Verification</label>
                        <input type="text" name="google_site_verification" value="{{ old('google_site_verification', $data->google_site_verification ?? '') }}" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="xxxxxxxxxxx">
                        @error('google_site_verification') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Meta Description</label>
                    <textarea name="meta_description" rows="3" class="w-full rounded-lg border-gray-200 bg-white px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('meta_description', $data->meta_description ?? '') }}</textarea>
                    @error('meta_description') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">OG Image</label>
                    @if($data->og_image ?? null)
                        <div class="mb-3">
                            <img src="{{ Storage::url($data->og_image) }}" class="w-40 h-24 object-cover rounded-lg border border-gray-200">
                        </div>
                    @endif
                    <input type="file" name="og_image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    @error('og_image') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div class="flex justify-end pt-4 border-t border-gray-100">
                    <x-primary-button type="submit">Simpan</x-primary-button>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
