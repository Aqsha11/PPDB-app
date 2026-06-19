<x-layouts.public title="Kontak">
    <div class="bg-gray-50 border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <h1 class="text-3xl font-bold text-gray-900">Hubungi Kami</h1>
            <p class="text-gray-500 mt-2">Silakan hubungi kami melalui form atau informasi kontak di bawah</p>
        </div>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid lg:grid-cols-2 gap-12">
            <div>
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Kirim Pesan</h2>
                    <form method="POST" action="{{ route('public.kontak.store') }}">
                        @csrf
                        <div class="space-y-5">
                            <div>
                                <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                <input type="text" id="nama" name="nama" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" id="email" name="email" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                            </div>
                            <div>
                                <label for="telepon" class="block text-sm font-medium text-gray-700 mb-1">Telepon (opsional)</label>
                                <input type="text" id="telepon" name="telepon" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                            <div>
                                <label for="pesan" class="block text-sm font-medium text-gray-700 mb-1">Pesan</label>
                                <textarea id="pesan" name="pesan" rows="5" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required></textarea>
                            </div>
                            <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 font-medium transition shadow-sm">
                                Kirim Pesan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="space-y-6">
                @if($data)
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 space-y-6">
                        <h2 class="text-xl font-bold text-gray-900">Informasi Kontak</h2>
                        @if($data->alamat)
                            <div class="flex items-start gap-4">
                                <div class="w-11 h-11 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center shrink-0">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">Alamat</p>
                                    <p class="text-gray-600 text-sm mt-1">{{ $data->alamat }}</p>
                                </div>
                            </div>
                        @endif
                        @if($data->email)
                            <div class="flex items-start gap-4">
                                <div class="w-11 h-11 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center shrink-0">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">Email</p>
                                    <a href="mailto:{{ $data->email }}" class="text-blue-600 text-sm mt-1 hover:text-blue-700 block">{{ $data->email }}</a>
                                </div>
                            </div>
                        @endif
                        @if($data->telepon)
                            <div class="flex items-start gap-4">
                                <div class="w-11 h-11 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center shrink-0">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">Telepon</p>
                                    <a href="tel:{{ $data->telepon }}" class="text-blue-600 text-sm mt-1 hover:text-blue-700 block">{{ $data->telepon }}</a>
                                </div>
                            </div>
                        @endif
                        @if($data->whatsapp)
                            <div class="flex items-start gap-4">
                                <div class="w-11 h-11 bg-green-100 text-green-600 rounded-xl flex items-center justify-center shrink-0">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">WhatsApp</p>
                                    <a href="https://wa.me/{{ $data->whatsapp }}" target="_blank" class="text-blue-600 text-sm mt-1 hover:text-blue-700 block">{{ $data->whatsapp }}</a>
                                </div>
                            </div>
                        @endif
                        @if($data->google_maps)
                            <div>
                                <p class="font-medium text-gray-900 mb-3">Lokasi</p>
                                <div class="rounded-xl overflow-hidden shadow-sm">
                                    {!! $data->google_maps !!}
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
                @if($mediaSosial->isNotEmpty())
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Ikuti Kami</h2>
                        <div class="flex flex-wrap gap-3">
                            @foreach($mediaSosial as $item)
                                <a href="{{ $item->url }}" target="_blank" rel="noopener noreferrer" class="w-11 h-11 bg-gray-100 text-gray-600 rounded-xl flex items-center justify-center hover:bg-blue-100 hover:text-blue-600 transition" title="{{ $item->platform }}">
                                    @if($item->icon)
                                        <i class="{{ $item->icon }}"></i>
                                    @else
                                        <span class="text-xs font-bold">{{ substr($item->platform, 0, 2) }}</span>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.public>
