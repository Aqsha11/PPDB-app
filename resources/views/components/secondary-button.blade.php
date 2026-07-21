@props(['disabled' => false, 'icon' => null, 'href' => null])

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => 'inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-white dark:bg-slate-700 border border-gray-300 dark:border-slate-600 text-gray-700 dark:text-slate-200 text-sm font-semibold rounded-lg hover:bg-gray-50 dark:hover:bg-slate-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 disabled:opacity-50 disabled:cursor-not-allowed transition-colors']) }}>
        @if($icon)<span class="shrink-0">{!! $icon !!}</span>@endif
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['type' => 'button', 'disabled' => $disabled, 'class' => 'inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-white dark:bg-slate-700 border border-gray-300 dark:border-slate-600 text-gray-700 dark:text-slate-200 text-sm font-semibold rounded-lg hover:bg-gray-50 dark:hover:bg-slate-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 disabled:opacity-50 disabled:cursor-not-allowed transition-colors']) }}>
        @if($icon)<span class="shrink-0">{!! $icon !!}</span>@endif
        {{ $slot }}
    </button>
@endif
