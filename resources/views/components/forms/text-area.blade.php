@props(['label' => '', 'value' => ''])

@php
    $classes = $errors->has($attributes->get('name')) ? 'bg-red-50 border border-red-500 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 dark:bg-gray-800 focus:border-red-500 block w-full p-2.5 dark:text-white dark:placeholder-red-500 dark:border-red-500' : 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500';
@endphp

@if ($label)
    <x-forms.label class="mb-2" :value="$label" :for="$attributes->get('id')" />
@endif

<textarea {{ $attributes->merge(['class' => $classes]) }}>{{ $value ?? $slot }}</textarea>

<x-forms.input-error :name="$attributes->get('name')" />
