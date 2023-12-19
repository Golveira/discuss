@props(['sortBy'])

@php
    $classes = 'inline-block rounded-t-lg border-b-2 border-transparent p-1 hover:border-gray-300';
    $activeClass = 'active inline-block rounded-t-lg border-b-2 border-blue-600 p-1 text-blue-600 dark:border-blue-500 dark:text-blue-500';
@endphp

<div class="text-center text-sm font-medium text-gray-500 dark:text-gray-400">
    <ul class="-mb-px flex flex-wrap">
        <li class="me-2">
            <button class="{{ $sortBy === 'latest' ? $activeClass : $classes }}"
                aria-current="{{ $sortBy === 'latest' ? 'page' : 'false' }}" wire:click="$set('sortBy', 'latest')">
                {{ __('Latest') }}
            </button>
        </li>

        <li class="me-2">
            <button class="{{ $sortBy === 'popular' ? $activeClass : $classes }}"
                aria-current="{{ $sortBy === 'popular' ? 'page' : 'false' }}" wire:click="$set('sortBy', 'popular')">
                {{ __('Popular') }}
            </button>
        </li>
    </ul>
</div>
