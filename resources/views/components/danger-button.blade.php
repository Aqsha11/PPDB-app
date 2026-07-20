@props(['disabled' => false, 'icon' => null])

<button {{ $attributes->merge(['type' => 'submit', 'disabled' => $disabled, 'class' => 'inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-red-600 hover:bg-red-700 active:bg-red-800 text-white text-sm font-semibold rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 disabled:opacity-50 disabled:cursor-not-allowed transition-colors']) }}>
    @if($icon)<span class="shrink-0">{!! $icon !!}</span>@endif
    {{ $slot }}
</button>
