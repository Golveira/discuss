@props(['image' => '', 'placeholder' => '', 'width' => 'md'])

@php
    $width = [
        'sm' => 'w-8 h-8',
        'md' => 'w-10 h-10',
        'lg' => 'w-20 h-20',
        'xl' => 'w-28 h-28',
    ][$width];
@endphp

@if ($image)
    <img class="{{ $width }} rounded-full ring-2 ring-gray-300 dark:ring-gray-500" src="{{ $image }}">
@else
    <div
        class="{{ $width }} relative inline-flex items-center justify-center overflow-hidden rounded-full bg-gray-100 dark:bg-gray-600">
        <span class="font-medium text-gray-600 dark:text-gray-300">
            {{ $placeholder }}
        </span>
    </div>
@endif
