@props(['thread'])

<x-card class="relative">
    <x-slot name="actions">
        @can('update', $thread)
            {{-- Actions --}}
            <x-threads.actions :thread="$thread" />
        @endcan
    </x-slot>

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

        @if ($thread->hasBestReply())
            <x-badge value="Answered" color="success" size="md" />
        @endif
    </x-slot>

    <x-slot name="body">
        {{-- Title --}}
        <h1 class="mb-6 text-3xl font-bold text-gray-900 dark:text-white">
            {{ $thread->title }}
        </h1>

        {{-- Body --}}
        <x-content>
            {!! $thread->body_html !!}
        </x-content>
    </x-slot>

    <x-slot name="footer">
        @guest
            {{-- Likes count --}}
            <x-likes-count :count="$thread->likes_count" />
        @else
            {{-- Like button --}}
            <livewire:like-button :likeable="$thread" wire:key="thread-likes-{{ $thread->id }}" />
        @endguest
    </x-slot>
</x-card>
