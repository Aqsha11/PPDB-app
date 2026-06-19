@php
    $role = auth()->user()->roles->first()->name ?? 'siswa';
@endphp
<header class="sticky top-0 z-40 bg-white border-b border-gray-200 shadow-sm">
    <div class="flex items-center justify-between h-16 px-4 sm:px-6">
        <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden text-gray-500 hover:text-gray-700">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
        <div class="hidden lg:block">
            <span class="text-sm text-gray-500">{{ now()->format('l, d F Y') }}</span>
        </div>
        <div class="flex items-center space-x-4">
            <div class="hidden sm:flex items-center space-x-2 text-sm text-gray-600">
                <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center">
                    <span class="text-blue-600 font-semibold text-sm">{{ substr(auth()->user()->name, 0, 1) }}</span>
                </div>
                <div class="text-right">
                    <p class="font-medium text-gray-900">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-gray-500 capitalize">{{ $role }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center text-gray-500 hover:text-red-600 transition text-sm">
                    <svg class="h-5 w-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Keluar
                </button>
            </form>
        </div>
    </div>
</header>
