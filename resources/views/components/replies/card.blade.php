@props(['reply', 'thread'])

<div x-data="{ isEditing: false }" x-cloak>
    <x-card x-bind:class="{ 'border-2 !border-blue-600': isAuthoredByUser, 'border-2 !border-green-600': isBestReply }">
        {{-- Actions --}}
        <x-slot name="actions">
            @can('update', $reply)
                <x-replies.actions :reply="$reply" />
            @endcan
        </x-slot>

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

            {{-- Best Reply Badge --}}
            <x-badge value="Answer" color="success" size="md" x-show="isBestReply" />
        </x-slot>

        <x-slot name="body">
            {{-- Edit Form --}}
            <x-replies.edit />

            {{-- Body --}}
            <p class="text-base leading-relaxed text-gray-900 dark:text-gray-300" x-show="!$wire.isEditing">
                {!! nl2br($reply->body) !!}
            </p>
        </x-slot>

        <x-slot name="footer">
            <div class="flex items-center justify-between">
                @guest
                    {{-- Likes count --}}
                    <x-likes-count :count="$reply->likes_count" />
                @else
                    {{-- Like button --}}
                    <livewire:like-button :likeable="$reply" wire:key="like-{{ $reply->id }}" />
                @endguest

                @can('update', $thread)
                    <x-buttons.transparent class="flex gap-1" x-show="isBestReply" wire:click="removeBestReply">
                        <x-icons.xmark />
                        {{ __(' Unmark as Answer') }}
                    </x-buttons.transparent>

                    <x-buttons.transparent class="flex gap-1" x-show="!bestReplyId" wire:click="markAsBestReply">
                        <x-icons.check />
                        {{ __(' Mark as Answer') }}
                    </x-buttons.transparent>
                @endcan
            </div>
        </x-slot>
    </x-card>
</div>
