@props(['maxWidth' => 'xl'])

@php
    $maxWidth = [
        'sm' => 'max-w-screen-sm',
        'md' => 'max-w-screen-md',
        'lg' => 'max-w-screen-lg',
        'xl' => 'max-w-screen-xl',
    ][$maxWidth];
@endphp

<div {{ $attributes->merge(['class' => 'px-2 mx-auto lg:px-4 lg:py-2 ' . $maxWidth]) }}>
    {{ $slot }}
</div>
