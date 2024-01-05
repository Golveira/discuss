@props(['thread', 'reply'])

<x-content-card class="relative mb-8">
    {{-- Actions --}}
    <x-slot name="actions">
        @can('update', $reply)
            <x-replies.actions :reply="$reply" />
        @endcan
    </x-slot>

    <x-slot name="header">
        {{-- Username --}}
        <x-links.secondary class="flex items-center gap-3" href="#" wire:navigate>
            <x-user-avatar :user="$reply->author" width="sm" />
            {{ $reply->author->username }}
        </x-links.secondary>

        {{-- Date --}}
        <p class="text-sm text-gray-600 dark:text-gray-400">
            {{ $reply->date_for_humans }}
        </p>
    </x-slot>

    <x-slot name="body">
        {{-- Title --}}
        <h1 class="mb-6 text-3xl font-bold text-gray-900 dark:text-white">
            {{ $reply->title }}
        </h1>

        {{-- Body --}}
        <p class="text-base leading-relaxed text-gray-900 dark:text-gray-300">
            {!! nl2br($reply->body) !!}
        </p>
    </x-slot>

    <x-slot name="footer">
        @guest
            {{-- Likes count --}}
            <x-likes-count :count="$reply->likes_count" />
        @else
            {{-- Like button --}}
            {{-- <livewire:like-button :model="$discussion" /> --}}
        @endguest
    </x-slot>
</x-content-card>
