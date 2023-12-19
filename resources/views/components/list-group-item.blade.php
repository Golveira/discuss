@props(['active' => false, 'label' => ''])

@php
    $classes = $active ? 'block w-full cursor-pointer rounded-t-lg border-b border-gray-200 bg-blue-700 px-4 py-2 text-left font-medium text-white focus:outline-none rtl:text-right dark:border-gray-600 dark:bg-gray-800' : 'block w-full cursor-pointer border-b border-gray-200 px-4 py-2 text-left font-medium hover:bg-gray-100 hover:text-blue-700 focus:text-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-700 rtl:text-right dark:border-gray-600 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:text-white dark:focus:ring-gray-500';
@endphp

@if ($attributes->has('href'))
    <a {{ $attributes->merge(['class' => $classes]) }}>
        {{ $label }}
    </a>
@else
    <button type="button" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $label }}
    </button>
@endif
