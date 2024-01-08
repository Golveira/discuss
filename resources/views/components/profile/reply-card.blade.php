@props(['reply'])

<x-card>
    <x-slot name="header">
        {{-- User --}}
        <x-links.secondary class="flex items-center gap-3" :href="$reply->author->profile_path" wire:navigate>
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
        <a class="flex items-center gap-1 text-lg font-medium text-gray-900 hover:underline dark:text-white lg:text-2xl"
            href="{{ $reply->thread->path }}" wire:navigate>
            <x-icons.arrow-turn-down-right />
            {{ $reply->thread->title }}
        </a>

        {{-- Body --}}
        <p class="text-base leading-relaxed text-gray-900 dark:text-gray-300">
            {!! nl2br($reply->body_excerpt) !!}
        </p>
    </x-slot>

    <x-slot name="footer">
        {{-- Likes count --}}
        <x-likes-count :count="$reply->likes_count" />
    </x-slot>
</x-card>
