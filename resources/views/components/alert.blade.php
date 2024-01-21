@props(['type' => 'success', 'message' => ''])

@php
    $classes = [
        'primary' => 'border border-blue-300 p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-gray-100 dark:border-none',
        'success' => 'p-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-green-700 dark:text-white',
        'warning' => 'p-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300',
        'danger' => 'p-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-red-700 dark:text-white',
        'dark' => 'p-4 text-sm text-gray-800 rounded-lg bg-gray-50 dark:bg-gray-800 dark:text-gray-300',
    ][$type];
@endphp


<div role="alert" {{ $attributes->merge(['class' => $classes]) }}>
    <div class="font-medium">
        {{ $message ?? $slot }}
    </div>
</div>
