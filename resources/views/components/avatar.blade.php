@props(['image' => '', 'placeholder' => '', 'width' => 'md'])

@php
    $width = [
        'sm' => 'w-8 h-8',
        'md' => 'w-10 h-10',
        'lg' => 'w-20 h-20',
    ][$width];
@endphp

@if ($image)
    <img class="{{ $width }} rounded-full" src="{{ $image }}">
@else
    <div
        class="{{ $width }} relative inline-flex h-10 w-10 items-center justify-center overflow-hidden rounded-full border-2 border-gray-500 bg-gray-100 dark:bg-gray-600">
        <span class="font-medium text-gray-600 dark:text-gray-300">
            {{ $placeholder }}
        </span>
    </div>
@endif
