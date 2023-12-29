@props(['thread'])

<x-list-item>
    <x-slot name="avatar">
        <x-user-avatar :user="$thread->author" />
    </x-slot>

    <x-slot name="value">
        <x-links.default href="{{ $thread->path }}" wire:navigate>
            {{ $thread->title }}
        </x-links.default>
    </x-slot>

    <x-slot name="subvalue">
        <x-links.secondary class="underline" href="{{ $thread->author->profile_path }}" wire:navigate>
            {{ $thread->author->username }}
        </x-links.secondary>

        <span>
            {{ __('asked') }} {{ $thread->date_for_humans }} {{ __('in') }}
        </span>

        <x-links.secondary class="underline" href="{{ $thread->channel->path }}" wire:navigate>
            {{ $thread->channel->name }}
        </x-links.secondary>
    </x-slot>

    <x-slot name="actions">
        <x-likes-count :count="$thread->likes_count" />
        <x-comments-count :count="$thread->replies_count" />
    </x-slot>
</x-list-item>
