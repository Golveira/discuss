<div @class([
    "before:relative before:-left-8 before:top-12 before:block before:w-8 before:border-gray-300 before:border-t-2 before:dark:border-gray-700 before:content-['']" => !$reply->isParent(),
]) x-data="{ isEditing: $wire.entangle('isEditing') }">
    <x-card @class([
        'group space-y-6',
        'border !border-blue-500 !dark:border-blue-900 !dark:bg-gray-500 align' => $isAuthoredByUser,
        'border-2 !border-green-600' => $isBestReply,
    ]) x-cloak>
        <x-slot name="header">
            <div class="flex items-center gap-3">
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
            </div>

            {{-- Best Answer Badge --}}
            @if ($isBestReply)
                <x-badge value="Best Answer" color="success" size="md" />
            @endif
        </x-slot>

        <x-slot name="body">
            {{-- Body --}}
            <x-html-content x-show="!isEditing">
                {{ $reply->body }}
            </x-html-content>

            {{-- Edit Form --}}
            <div x-show="isEditing">
                <x-replies.form :$reply action="update" buttonText="Update" />
            </div>
        </x-slot>

        <x-slot name="footer" x-show="!isEditing">
            {{-- Like Button --}}
            <livewire:like-button :likeable="$reply" wire:key="reply-like-{{ $reply->id }}" />

            {{-- Reply Button --}}
            @if ($reply->isParent())
                <x-buttons.transparent wire:click="$dispatch('open-reply-creator', { parentId: {{ $reply->id }} })">
                    {{ __('Reply') }}
                </x-buttons.transparent>
            @endif
        </x-slot>

        <x-slot name="actions" x-show="!isEditing">
            {{-- Best Answer Button --}}
            @can('update', $thread)
                <x-replies.best-reply-button :$isBestReply />
            @endcan

            {{-- Reply Actions --}}
            @can('update', $reply)
                <x-replies.actions :$reply />
            @endcan
        </x-slot>
    </x-card>

    {{-- Reply Children --}}
    @if ($reply->hasChildren())
        <div
            class="relative space-y-6 pl-14 pt-6 before:absolute before:inset-0 before:mx-6 before:w-1 before:border-l-2 before:border-gray-300 before:content-[''] before:dark:border-gray-700">
            @foreach ($reply->children as $child)
                <livewire:replies.reply-card :$thread :reply="$child" :key="$child->id" />
            @endforeach
        </div>
    @endif
</div>
