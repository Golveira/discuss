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
        {{-- Thread title --}}
        <x-links.default href="{{ route('threads.show', $thread->id) }}" wire:navigate>
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
        <x-links.secondary class="underline" href="{{ $thread->category->path }}" wire:navigate>
            {{ $thread->category->name }}
        </x-links.secondary>

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
                <x-avatar :image="$thread->author->avatar_path" width="xs" />
            </x-tooltip>

            {{-- Comments Count --}}
            <x-comments-count :count="$thread->replies_count" />
        </div>
    </x-slot>
</x-lists.list-item>
