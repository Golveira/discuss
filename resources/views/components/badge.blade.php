@props(['color' => 'success', 'size' => 'sm', 'value' => ''])

@php
    $size = [
        'sm' => 'px-1.5 py-0.5 text-xs',
        'md' => 'px-3 py-0.5 text-sm',
        'lg' => 'px-4 py-1 text-base',
    ][$size];

    $classes = [
        'success' => 'bg-green-100 text-green-800 font-medium me-2 rounded dark:bg-green-900 dark:text-green-300',
    ][$color];
@endphp


<span {{ $attributes->merge(['class' => $classes . ' ' . $size]) }}>
    {{ $value ?? $slot }}
</span>
