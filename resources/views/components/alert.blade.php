@props(['type' => 'success', 'message' => ''])

@php
    $styles = [
        'success' => 'bg-emerald-50 border-emerald-500 text-emerald-800 dark:bg-emerald-500/10 dark:border-emerald-500/30 dark:text-emerald-300',
        'error' => 'bg-red-50 border-red-500 text-red-800 dark:bg-red-500/10 dark:border-red-500/30 dark:text-red-300',
        'warning' => 'bg-amber-50 border-amber-500 text-amber-800 dark:bg-amber-500/10 dark:border-amber-500/30 dark:text-amber-300',
        'info' => 'bg-sky-50 border-sky-500 text-sky-800 dark:bg-sky-500/10 dark:border-sky-500/30 dark:text-sky-300',
    ];
    $icons = [
        'success' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
        'error' => 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z',
        'warning' => 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z',
        'info' => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
    ];
    $style = $styles[$type] ?? $styles['success'];
    $icon = $icons[$type] ?? $icons['success'];
@endphp

<div x-data="{ show: true }" x-show="show" x-transition x-cloak class="border-l-4 p-4 rounded-r-lg mb-4 {{ $style }}" role="alert">
    <div class="flex items-center">
        <svg class="h-5 w-5 mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $icon }}"/></svg>
        <span class="text-sm font-medium flex-1">{{ $message ?? $slot }}</span>
        <button @click="show = false" class="ml-3 text-current opacity-40 hover:opacity-100 transition-opacity">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    </div>
</div>
