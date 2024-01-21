@auth
    @if (!$thread->isClosed())
        <div class="space-y-3 rounded-b-lg border-t border-gray-300 bg-gray-100 p-3 dark:border-gray-700 dark:bg-gray-800">
            <button
                class="block w-full cursor-text rounded-lg border border-gray-300 bg-gray-50 p-2 text-left text-sm text-gray-600 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-400"
                x-show="!isReplying" @click="isReplying = true">
                Write a reply
            </button>

            <div x-show="isReplying">
                <form class="space-y-3" id="create-child-form" wire:submit="postReply">
                    <x-markdown-editor height="h-32" placeholder="Write a reply" wire:model="replyForm.body" />

                    <div class="flex justify-between gap-4 px-4 py-2">
                        <div class="mt-2 text-sm text-red-600 dark:text-red-400">
                            @error('replyForm.body')
                                {{ $message }}
                            @enderror
                        </div>

                        <div class="flex gap-3">
                            <x-buttons.secondary type="button" @click="isReplying = false">
                                Cancel
                            </x-buttons.secondary>

                            <x-buttons.primary type="submit">
                                Reply
                            </x-buttons.primary>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif
@endauth
