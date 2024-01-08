<div x-data="{ isEditing: $wire.entangle('isEditing') }" x-cloak>
    <x-card @class([
        'group',
        'border-2 !border-blue-500 !dark:border-blue-900' => $isAuthoredByUser,
        'border-2 !border-green-600' => $isBestReply,
    ])>
        <x-slot name="header">
            {{-- User --}}
            <x-links.secondary class="flex items-center gap-3"
                href="{{ route('profile.show', $reply->author->username) }}" wire:navigate>
                <x-user-avatar :user="$reply->author" width="sm" />
                {{ $reply->author->username }}
            </x-links.secondary>

            {{-- Date --}}
            <p class="text-sm text-gray-600 dark:text-gray-400">
                {{ $reply->date_for_humans }}
            </p>

            {{-- Best Reply Badge --}}
            @if ($isBestReply)
                <x-badge value="Best Answer" color="success" size="md" />
            @endif
        </x-slot>

        <x-slot name="body">
            {{-- Body --}}
            <x-content x-show="!isEditing">
                {!! $reply->body_html !!}
            </x-content>

            {{-- Edit Form --}}
            <div x-show="isEditing">
                <x-replies.edit-form />
            </div>
        </x-slot>

        <x-slot name="footer">
            <div class="flex items-center justify-between">
                @guest
                    {{-- Likes Count --}}
                    <x-likes-count :count="$reply->likes_count" />
                @else
                    {{-- Like Button --}}
                    <livewire:like-button :likeable="$reply" wire:key="like-{{ $reply->id }}" />
                @endguest

                {{-- Actions --}}
                <x-replies.actions :$thread :$reply :$isBestReply />
            </div>
        </x-slot>
    </x-card>
</div>
