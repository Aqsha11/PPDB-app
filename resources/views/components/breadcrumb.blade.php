@props(['items' => [], 'homeRoute' => 'admin.dashboard'])

@php
    $getUrl = fn($item) => $item['url'] ?? (isset($item['route']) ? route($item['route']) : null);
@endphp

<nav {{ $attributes->merge(['class' => 'flex items-center space-x-1 text-sm text-gray-500 dark:text-slate-400']) }} aria-label="Breadcrumb">
    <a href="{{ route($homeRoute) }}" class="hover:text-gray-700 dark:hover:text-slate-200 transition-colors p-1 rounded hover:bg-gray-100 dark:hover:bg-slate-700">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
    </a>
    @foreach($items as $item)
        <svg class="w-4 h-4 text-gray-300 dark:text-slate-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        @php $url = $getUrl($item); @endphp
        @if($url && !$loop->last)
            <a href="{{ $url }}" class="hover:text-gray-700 dark:hover:text-slate-200 font-medium transition-colors">{{ $item['label'] }}</a>
        @else
            <span class="text-gray-900 dark:text-white font-medium">{{ $item['label'] }}</span>
        @endif
    @endforeach
</nav>
