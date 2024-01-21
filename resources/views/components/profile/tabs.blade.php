<div class="border-b border-gray-200 dark:border-gray-700" x-data="{ tab: $wire.entangle('selectedTab') }">
    <ul class="-mb-px flex flex-wrap text-center text-sm font-medium text-gray-500 dark:text-gray-400">
        <li class="me-2">
            <button
                class="group inline-flex items-center justify-center gap-1 rounded-t-lg p-4 hover:text-gray-600 dark:hover:text-gray-300"
                :class="{
                    'border-b-2 border-gray-700 dark:border-gray-100 text-gray-700 dark:text-gray-100': tab == 'threads'
                }"
                wire:click="$set('selectedTab', 'threads')">
                {{ __('Threads') }}
            </button>
        </li>

        <li class="me-2">
            <button
                class="group inline-flex items-center justify-center gap-1 rounded-t-lg p-4 hover:text-gray-600 dark:hover:text-gray-300"
                :class="{
                    'border-b-2 border-gray-700 dark:border-gray-100 text-gray-700 dark:text-gray-100': tab == 'replies'
                }"
                wire:click="$set('selectedTab', 'replies')">
                {{ __('Replies') }}
            </button>
        </li>
    </ul>
</div>
