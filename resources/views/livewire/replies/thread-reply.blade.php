@props(['reply', 'thread'])

<div @class([
    'rounded-lg border border-gray-300 bg-white dark:border-gray-700 dark:bg-gray-900',
    '!border-blue-500 dark:!border-blue-800' => $reply->isAuthoredByUser(),
]) x-data="{
    isEditing: $wire.entangle('isEditing'),
    isReplying: $wire.entangle('isReplying'),
}" x-cloak>
    <div class="mx-4 my-3 flex items-center justify-between" x-show="!isEditing">
        <div class="flex items-center gap-2">
            {{-- Author --}}
            <x-user-avatar :user="$reply->author" />

            {{-- Date --}}
            <p class="text-sm text-gray-600 dark:text-gray-400">
                {{ $reply->date_for_humans }}
            </p>

            {{-- Thread author badge --}}
            @if ($reply->isFromSameAuthor($thread->user_id))
                <x-author-badge value="Author" />
            @endif
        </div>

        {{-- Actions --}}
        @can('update', $reply)
            <x-replies.actions :$reply />
        @endcan
    </div>

    <div class="mx-4 my-3 space-y-3" x-show="!isEditing">
        {{-- Body --}}
        <x-html-content>
            {{ $reply->body }}
        </x-html-content>

        <div class="flex items-center justify-between">
            {{-- Like button --}}
            <livewire:like-button :likeable="$reply" wire:key="like-reply-{{ $reply->id }}" />

            {{-- Nested replies count --}}
            @if ($reply->hasChildren())
                <span class="text-sm text-gray-600 dark:text-gray-400">
                    {{ $reply->children->count() }} {{ Str::plural('reply', $reply->children->count()) }}
                </span>
            @endif
        </div>
    </div>

    {{-- Edit form --}}
    <div class="m-3" x-show="isEditing">
        <x-replies.edit-form />
    </div>

    {{-- Nested replies --}}
    @if ($reply->hasChildren())
        <div class="space-y-3 rounded-b-lg border-t border-gray-200 bg-gray-100 p-3 dark:border-gray-700 dark:bg-black">
            @foreach ($reply->children as $child)
                <livewire:replies.nested-reply :$thread :reply="$child" wire:key="{{ $child->id }}" />
            @endforeach
        </div>
    @endif

    {{-- Create nested reply --}}
    <x-replies.create-nested-reply :$thread :$reply />
</div>
