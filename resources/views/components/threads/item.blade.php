@props(['thread'])

<x-list-item {{ $attributes }}>
    <x-slot name="avatar">
        <div class="flex gap-6">
            {{-- Like Button --}}
            <livewire:like-button :likeable="$thread" wire:key="thread-like-{{ $thread->id }}" />

            {{-- Avatar --}}
            <x-avatar :image="$thread->author->avatar_path" />
        </div>
    </x-slot>

    <x-slot name="value">
        {{-- Title --}}
        <x-links.default href="{{ $thread->path }}" wire:navigate>
            {{ $thread->title }}
        </x-links.default>
    </x-slot>

    <x-slot name="subvalue">
        {{-- Username --}}
        <x-links.secondary class="underline" href="{{ $thread->author->profile_path }}" wire:navigate>
            {{ $thread->author->username }}
        </x-links.secondary>

        {{-- Date --}}
        <span>
            {{ __('asked') }} {{ $thread->date_for_humans }} {{ __('in') }}
        </span>

        {{-- Channel --}}
        <x-links.secondary class="underline" href="{{ $thread->channel->path }}" wire:navigate>
            {{ $thread->channel->name }}
        </x-links.secondary>

        @if ($thread->hasBestReply())
            <span class="text-sm text-green-500">Answered</span>
        @endif
    </x-slot>

    <x-slot name="actions">
        {{-- Comments Count --}}
        <x-comments-count :count="$thread->replies_count" />
    </x-slot>
</x-list-item>
