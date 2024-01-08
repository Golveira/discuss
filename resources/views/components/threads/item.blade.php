@props(['thread'])

<x-list-item>
    <x-slot name="avatar">
        {{-- Avatar --}}
        <x-user-avatar :user="$thread->author" />
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
            <x-badge value="Answered" color="success" size="sm" />
        @endif
    </x-slot>

    <x-slot name="actions">
        <x-likes-count :count="$thread->likes_count" />
        <x-comments-count :count="$thread->replies_count" />
    </x-slot>
</x-list-item>
