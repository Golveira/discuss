<div class="border-b border-gray-200 dark:border-gray-700" x-data="{ selected: $wire.entangle('selectedTab') }">
    <ul class="-mb-px flex flex-wrap text-center text-sm font-medium text-gray-500 dark:text-gray-400">
        <li class="me-2">
            <button
                class="group inline-flex items-center justify-center gap-1 rounded-t-lg p-4 hover:border-gray-300 hover:text-gray-600 dark:hover:text-gray-300"
                :class="{ 'border-b-2 border-gray-300 text-gray-600 dark:text-gray-300': selected == 'threads' }"
                wire:click="$set('selectedTab', 'threads')">
                <x-icons.chat class="group-hover:text-gray-500 dark:group-hover:text-gray-300" />
                {{ __('Threads') }}
            </button>
        </li>

        <li class="me-2">
            <button
                class="group inline-flex items-center justify-center gap-1 rounded-t-lg p-4 hover:border-gray-300 hover:text-gray-600 dark:hover:text-gray-300"
                :class="{ 'border-b-2 border-gray-300 text-gray-600 dark:text-gray-300': selected == 'replies' }"
                wire:click="$set('selectedTab', 'replies')">
                <x-icons.paper-airplane class="group-hover:text-gray-500 dark:group-hover:text-gray-300" />
                {{ __('Replies') }}
            </button>
        </li>
    </ul>
</div>
