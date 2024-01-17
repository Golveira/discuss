<div x-data="{
    isEditing: $wire.entangle('isEditing'),
    isReplying: $wire.entangle('isReplying')
}">
    <div class="rounded-lg border border-gray-300 bg-white dark:border-gray-700 dark:bg-gray-900">
        <div class="mx-4 my-3 flex items-center justify-between" x-show="!isEditing">
            <div class="flex items-center gap-2">
                {{-- Reply author --}}
                <x-links.secondary class="flex items-center gap-3"
                    href="{{ route('profile.show', $reply->author->username) }}" wire:navigate>
                    <x-avatar :image="$reply->author->avatar_path" width="sm" />
                    <span>{{ $reply->author->username }}</span>
                </x-links.secondary>

                {{-- Reply date --}}
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    {{ $reply->date_for_humans }}
                </p>
            </div>

            {{-- Reply actions --}}
            @can('update', $reply)
                <x-replies.actions :$reply />
            @endcan
        </div>

        <div class="mx-4 my-3 space-y-3" x-show="!isEditing">
            {{-- Reply body --}}
            <x-html-content>
                {{ $reply->body }}
            </x-html-content>

            {{-- Like button --}}
            <livewire:like-button :likeable="$reply" wire:key="reply-like-{{ $reply->id }}" />
        </div>

        {{-- Edit reply form --}}
        <div class="m-3" x-show="isEditing">
            <x-replies.edit-form :reply="$reply" />
        </div>


        @if ($reply->isParent())
            {{-- Nested replies --}}
            @if ($reply->hasChildren())
                <div class="space-y-3 bg-black p-3">
                    @foreach ($reply->children as $child)
                        <livewire:replies.reply-child :$reply :key="$child->id" />
                    @endforeach
                </div>
            @endif

            {{-- Create nested reply --}}
            <x-replies.create-nested :reply="$reply" />
        @endif
    </div>
</div>
