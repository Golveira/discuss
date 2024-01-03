@props(['image' => '', 'width' => 'md'])

@php
    $width = [
        'xs' => 'w-6 h-6',
        'sm' => 'w-8 h-8',
        'md' => 'w-10 h-10',
        'lg' => 'w-20 h-20',
        'xl' => 'w-28 h-28',
    ][$width];
@endphp

<img class="{{ $width }} rounded-full object-cover ring-2 ring-gray-300 dark:ring-gray-500"
    src="{{ $image }}">
