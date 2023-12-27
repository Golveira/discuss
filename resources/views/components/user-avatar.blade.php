@props(['user' => '', 'width' => 'md'])

@php
    $width = [
        'sm' => 'w-8 h-8',
        'md' => 'w-10 h-10',
        'lg' => 'w-20 h-20',
        'xl' => 'w-28 h-28',
    ][$width];
@endphp

@if ($user->avatar_path)
    <img class="{{ $width }} rounded-full border-2 border-gray-500" src="{{ $user->avatar_path }}">
@else
    <div
        class="{{ $width }} relative inline-flex h-10 w-10 items-center justify-center overflow-hidden rounded-full border-2 border-gray-500 bg-gray-100 dark:bg-gray-600">
        <span class="font-medium text-gray-600 dark:text-gray-300">
            {{ $user->username_initials }}
        </span>
    </div>
@endif
