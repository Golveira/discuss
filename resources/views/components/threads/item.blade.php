@props(['thread'])

<x-list-item {{ $attributes }}>
    <x-slot name="avatar">
        <div class="flex items-center gap-6">
            {{-- Like Button --}}
            <livewire:like-button :likeable="$thread" wire:key="thread-like-{{ $thread->id }}" />

            {{-- Category emoji --}}
            <x-emoji-box :emoji="$thread->channel->emoji" />
        </div>
    </x-slot>

    <x-slot name="value">
        {{-- Thread title --}}
        <x-links.default href="{{ $thread->path }}" wire:navigate>
            {{ $thread->title }}
        </x-links.default>
    </x-slot>

    <x-slot name="subvalue">
        {{-- Username --}}
        <x-links.secondary class="underline" href="{{ $thread->author->profile_path }}" wire:navigate>
            {{ $thread->author->username }}
        </x-links.secondary>

        {{-- Thread date --}}
        <span>
            {{ __('asked') }} {{ $thread->date_for_humans }} {{ __('in') }}
        </span>

        {{-- Category name --}}
        <x-links.secondary class="underline" href="{{ $thread->channel->path }}" wire:navigate>
            {{ $thread->channel->name }}
        </x-links.secondary>

        @if ($thread->hasBestReply())
            <span class="text-sm text-green-600 dark:text-green-500">
                Answered
            </span>
        @endif
    </x-slot>

    <x-slot name="actions">
        <div class="flex justify-between gap-3">
            {{-- Avatar --}}
            <x-avatar :image="$thread->author->avatar_path" width="xs" />

            {{-- Comments Count --}}
            <x-comments-count :count="$thread->replies_count" />
        </div>
    </x-slot>
</x-list-item>
