<div class="flex cursor-pointer items-center gap-3 rounded-lg border border-gray-200 bg-white px-10 py-6 shadow hover:shadow-md dark:border-gray-700 dark:bg-gray-900 dark:hover:border-gray-600"
    wire:click="$dispatch('open-reply-creator')">
    <x-user-avatar :user="auth()->user()" width="md" />

    <span class="text-sm text-gray-700 dark:text-gray-400">
        {{ __('Write a reply.') }}
    </span>
</div>
