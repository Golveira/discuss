@props(['image' => '', 'width' => 'md'])

@php
    $width = [
        'xs' => 'w-6 h-6',
        'sm' => 'w-8 h-8',
        'md' => 'w-10 h-10',
        'lg' => 'w-28 h-28 lg:w-40 lg:h-40',
        'xl' => 'w-32 h-32 lg:w-64 lg:h-64',
    ][$width];
@endphp

<img src="{{ $image }}" {{ $attributes->merge(['class' => 'rounded-full object-cover ' . $width]) }} />
