@props(['href' => null, 'type' => 'button', 'variant' => 'default', 'size' => 'md', 'title' => '', 'delete' => false])

@php
    $sizes = ['xs' => 'w-7 h-7', 'sm' => 'w-8 h-8', 'md' => 'w-9 h-9', 'lg' => 'w-10 h-10'];
    $iconSizes = ['xs' => 'w-3.5 h-3.5', 'sm' => 'w-4 h-4', 'md' => 'w-[18px] h-[18px]', 'lg' => 'w-5 h-5'];
    $variants = [
        'default' => 'text-gray-500 hover:text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-slate-700',
        'primary' => 'theme-text hover:opacity-80 hover:bg-gray-100 dark:hover:bg-slate-700',
        'success' => 'text-emerald-600 hover:text-emerald-700 hover:bg-emerald-50 dark:text-emerald-400 dark:hover:bg-emerald-500/10',
        'danger' => 'text-red-500 hover:text-red-700 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-500/10',
        'warning' => 'text-amber-500 hover:text-amber-700 hover:bg-amber-50 dark:text-amber-400 dark:hover:bg-amber-500/10',
        'info' => 'text-sky-600 hover:text-sky-700 hover:bg-sky-50 dark:text-sky-400 dark:hover:bg-sky-500/10',
    ];
    $class = ($sizes[$size] ?? $sizes['md']) . ' ' . ($variants[$variant] ?? $variants['default']);
@endphp

@if($delete)
    <form method="POST" action="{{ $href }}" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus item ini?')">
        @csrf @method('DELETE')
        <button type="submit" title="{{ $title }}" {{ $attributes->merge(['class' => "inline-flex items-center justify-center rounded-lg transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500/20 $class"]) }}>
            <svg class="{{ $iconSizes[$size] ?? $iconSizes['md'] }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
        </button>
    </form>
@elseif($href)
    <a href="{{ $href }}" title="{{ $title }}" {{ $attributes->merge(['class' => "inline-flex items-center justify-center rounded-lg transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[var(--color-primary)]/20 $class"]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" title="{{ $title }}" {{ $attributes->merge(['class' => "inline-flex items-center justify-center rounded-lg transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[var(--color-primary)]/20 $class"]) }}>
        {{ $slot }}
    </button>
@endif
