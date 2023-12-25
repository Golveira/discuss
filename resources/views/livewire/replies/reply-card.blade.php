<x-content-card @class(['border-2 !border-blue-600' => $isAuthoredByUser])>
    {{-- Actions --}}
    <x-slot name="actions">
        @can('update', $reply)
            <x-replies.actions :reply="$reply" />
        @endcan
    </x-slot>

    <x-slot name="header">
        {{-- User --}}
        <x-links.secondary class="flex items-center gap-3" href="#" wire:navigate>
            <x-user-avatar :user="$reply->author" width="sm" />
            {{ $reply->author->username }}
        </x-links.secondary>

        {{-- Date --}}
        <p class="text-sm text-gray-600 dark:text-gray-400">
            {{ $reply->date_for_humans }}
        </p>
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
        @guest
            {{-- Likes count --}}
            <x-likes-count :count="$reply->likes_count" />
        @else
            {{-- Like button --}}
            {{-- <livewire:like-button :model="$discussion" /> --}}
        @endguest
    </x-slot>
</x-content-card>
