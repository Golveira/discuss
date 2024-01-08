@props(['value' => '', 'width' => 'md'])

@php
    $width = [
        'xs' => 'w-6 h-6',
        'sm' => 'w-8 h-8',
        'md' => 'w-10 h-10',
        'lg' => 'w-20 h-20 text-3xl',
        'xl' => 'w-28 h-28 text-4xl',
    ][$width];
@endphp

<div
    class="{{ $width }} relative inline-flex items-center justify-center overflow-hidden rounded-full border border-gray-500 bg-gray-100 dark:bg-gray-600">
    <span class="font-medium text-gray-600 dark:text-gray-300">
        {{ $value }}
    </span>
</div>
