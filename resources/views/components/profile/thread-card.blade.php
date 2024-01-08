@props(['thread'])

<x-card class="relative">
    <x-slot name="header">
        {{-- User --}}
        <x-links.secondary class="flex items-center gap-3" :href="$thread->author->profile_path" wire:navigate>
            <x-user-avatar :user="$thread->author" width="sm" />
            {{ $thread->author->username }}
        </x-links.secondary>

        {{-- Date --}}
        <p class="text-sm text-gray-600 dark:text-gray-400">
            {{ $thread->date_for_humans }}
        </p>

        {{-- Channel --}}
        <x-links.secondary :href="$thread->channel->path" wire:navigate>
            {{ $thread->channel->name }}
        </x-links.secondary>
    </x-slot>

    <x-slot name="body">
        {{-- Title --}}
        <a class="text-lg font-medium text-gray-900 hover:underline dark:text-white lg:text-2xl"
            href="{{ $thread->path }}" wire:navigate>
            {{ $thread->title }}
        </a>

        {{-- Body --}}
        <p class="text-base leading-relaxed text-gray-900 dark:text-gray-300">
            {!! nl2br($thread->body_excerpt) !!}
        </p>
    </x-slot>

    <x-slot name="footer">
        {{-- Likes count --}}
        <x-likes-count :count="$thread->likes_count" />
    </x-slot>
</x-card>
