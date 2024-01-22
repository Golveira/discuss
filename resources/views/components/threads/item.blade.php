@props(['thread'])

<x-lists.list-item {{ $attributes }}>
    <x-slot name="avatar">
        <div class="flex items-center gap-6">
            {{-- Like Button --}}
            <livewire:like-button :likeable="$thread" wire:key="thread-like-{{ $thread->id }}" />

            {{-- Category emoji --}}
            <x-emoji-box :emoji="$thread->category->emoji" />
        </div>
    </x-slot>

    <x-slot name="value">
        {{-- Title --}}
        <x-links.default href="{{ route('threads.show', $thread) }}">
            {{ $thread->title }}
        </x-links.default>
    </x-slot>

    <x-slot name="subvalue">
        {{-- Username --}}
        <x-links.secondary class="underline" href="{{ route('profile.show', $thread->author->username) }}">
            {{ $thread->author->username }}
        </x-links.secondary>

        {{-- Date --}}
        <span>
            {{ __('asked') }} {{ $thread->date_for_humans }} {{ __('in') }}
        </span>

        {{-- Category name --}}
        <x-links.secondary class="underline" href="{{ route('categories', $thread->category) }}">
            {{ $thread->category->name }}
        </x-links.secondary>

        {{-- Answered --}}
        @if ($thread->hasBestReply())
            <span class="text-sm text-green-600 dark:text-green-500">
                Answered
            </span>
        @endif
    </x-slot>

    <x-slot name="actions">
        <div class="flex justify-between gap-8">
            {{-- Avatar --}}
            <x-tooltip :value="$thread->author->username">
                <x-avatar :image="$thread->author->avatarFullPath()" width="xs" />
            </x-tooltip>

            {{-- Comments Count --}}
            <x-comments-count :count="$thread->replies_count" />
        </div>
    </x-slot>
</x-lists.list-item>
