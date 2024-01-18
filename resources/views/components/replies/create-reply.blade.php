@auth
    @if ($thread->isClosed())
        <div class="flex flex-col items-center gap-3 text-gray-700 dark:text-gray-300">
            <x-icons.lock-closed class="h-6 w-6" />

            <p>This thread is closed and can no longer receive new replies.</p>
        </div>
    @else
        <form class="space-y-3" id="create-reply-form" wire:submit="create">
            <x-markdown-editor height="h-32" placeholder="Add your comment here..." wire:model="body" />

            <div class="flex justify-between gap-3">
                @error('body')
                    <p class="text-sm text-red-600 dark:text-red-400">
                        {{ $message }}
                    </p>
                @enderror

                <x-buttons.primary type="submit">
                    Comment
                </x-buttons.primary>
            </div>
        </form>
    @endif
@else
    <div
        class="flex items-center gap-2 rounded-lg border border-gray-300 bg-gray-100 px-3 py-4 text-gray-700 dark:border-gray-700 dark:bg-gray-800">
        <x-buttons.primary href="{{ route('login') }}" wire:navigate>
            Sign up for free
        </x-buttons.primary>

        <span class="text-sm dark:text-white">
            to join this conversation. Already have an account?
        </span>

        <x-links.primary class="text-sm" href="{{ route('login') }}" wire:navigate>
            Sign in to comment
        </x-links.primary>
    </div>
@endauth
