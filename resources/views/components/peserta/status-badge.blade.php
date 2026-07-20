@props(['status' => 'draft'])

@php
    $map = [
        'draft' => ['label' => 'Draft', 'class' => 'bg-gray-100 dark:bg-slate-700 text-gray-600 dark:text-slate-300'],
        'submitted' => ['label' => 'Terkirim', 'class' => 'bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400 border border-blue-200 dark:border-blue-500/20'],
        'verifikasi' => ['label' => 'Verifikasi', 'class' => 'bg-amber-50 dark:bg-amber-500/10 text-amber-600 dark:text-amber-400 border border-amber-200 dark:border-amber-500/20'],
        'diterima' => ['label' => 'Diterima', 'class' => 'bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-500/20'],
        'ditolak' => ['label' => 'Ditolak', 'class' => 'bg-red-50 dark:bg-red-500/10 text-red-600 dark:text-red-400 border border-red-200 dark:border-red-500/20'],
        'cadangan' => ['label' => 'Cadangan', 'class' => 'bg-orange-50 dark:bg-orange-500/10 text-orange-600 dark:text-orange-400 border border-orange-200 dark:border-orange-500/20'],
    ];
    $s = $map[$status] ?? ['label' => ucfirst($status), 'class' => 'bg-gray-100 text-gray-700'];
@endphp

<span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold leading-none {{ $s['class'] }}" {{ $attributes }}>
    <span class="w-1.5 h-1.5 rounded-full bg-current animate-pulse"></span>
    {{ $s['label'] }}
</span>
