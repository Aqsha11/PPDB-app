@props(['disabled' => false, 'icon' => null, 'href' => null])

@php
    $classes = 'inline-flex items-center justify-center gap-2 px-5 py-2.5 btn-theme text-sm font-semibold rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 theme-ring disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200 hover:shadow-md';
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if($icon)<span class="shrink-0">{!! $icon !!}</span>@endif
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['type' => 'submit', 'disabled' => $disabled, 'class' => $classes]) }}>
        @if($icon)<span class="shrink-0">{!! $icon !!}</span>@endif
        {{ $slot }}
    </button>
@endif
