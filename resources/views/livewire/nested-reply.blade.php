<div class="relative flex items-start gap-3 before:absolute before:left-3 before:top-3 before:z-0 before:block before:h-full before:border-l-2 before:border-gray-300 before:dark:border-gray-700"
    id="comment-{{ $reply->id }}" x-data="{ isEditing: $wire.entangle('isEditing') }">
    <div class="z-10 flex-shrink-0">
        {{-- Author avatar --}}
        <x-avatar :image="$reply->author->avatar_path" width="xs" />
    </div>

    <div class="flex-1 space-y-3">
        <div x-show="!isEditing">
            <div class="flex items-center justify-between gap-1">
                <div class="flex items-center gap-3">
                    {{-- Author username --}}
                    <x-links.default class="flex items-center gap-3"
                        href="{{ route('profile.show', $reply->author->username) }}" wire:navigate>
                        <span>{{ $reply->author->username }}</span>
                    </x-links.default>

                    {{-- Date --}}
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        {{ $reply->date_for_humans }}
                    </p>

                    {{-- Thread author badge --}}
                    @if ($reply->isFromSameAuthor($thread->user_id))
                        <x-users.author-badge value="Author" />
                    @endif
                </div>

                {{-- Actions --}}
                @can('update', $reply)
                    <x-replies.actions-dropdown :$reply />
                @endcan
            </div>

            {{-- Body --}}
            <x-html-content>
                {{ $reply->body }}
            </x-html-content>

            <div class="mt-2 flex items-center gap-1">
                {{-- Best answer badge --}}
                @if ($isAnswer)
                    <x-replies.best-answer-badge value="Marked as answer" />
                @endif

                {{-- Mark as answer button --}}
                @can('markAsAnswer', $reply)
                    <x-replies.mark-answer-button :$isAnswer />
                @endcan
            </div>
        </div>

        {{-- Edit form --}}
        <div class="m-3" x-show="isEditing">
            <x-replies.edit-form />
        </div>
    </div>
</div>
