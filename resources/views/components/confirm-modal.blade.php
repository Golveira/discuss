@props([
    'id' => 'modal',
    'title' => '',
    'message' => '',
    'action' => '',
    'buttonText' => 'Delete',
])

<div class="relative h-auto w-auto" x-data="{ modalOpen: false }" @keydown.escape.window="modalOpen = false"
    @open-modal.window="$event.detail == '{{ $id }}' ? modalOpen = true : false"
    :class="{ 'z-40': modalOpen }">
    <template x-teleport="body">
        <div class="fixed left-0 top-0 z-[99] flex h-screen w-screen items-center justify-center" x-show="modalOpen"
            x-cloak>
            <div class="absolute inset-0 h-full w-full bg-gray-700 bg-opacity-80" x-show="modalOpen"
                x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-300"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="modalOpen=false">
            </div>

            <div class="relative w-full border bg-white bg-opacity-90 px-7 py-6 backdrop-blur-sm dark:border-gray-600 dark:bg-gray-900 sm:max-w-lg sm:rounded-lg"
                x-show="modalOpen" x-trap.inert.noscroll="modalOpen" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-90">
                <div class="flex items-center justify-between pb-3">
                    <h3 class="font-semibold dark:text-gray-100">
                        {{ $title }}
                    </h3>

                    <button
                        class="absolute right-0 top-0 mr-5 mt-5 flex h-8 w-8 items-center justify-center rounded-full text-gray-500 hover:bg-gray-50 hover:text-gray-800 dark:hover:bg-gray-600 dark:hover:text-white"
                        @click="modalOpen=false">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="relative w-auto pb-8 dark:text-gray-100">
                    <p>{{ $message }}</p>
                </div>

                <form wire:submit={{ $action }} @submit.prevent="modalOpen = false">
                    <div class="flex flex-col-reverse gap-2 sm:flex-row sm:justify-end sm:space-x-2">
                        <x-buttons.secondary type="button" @click="modalOpen=false">
                            Cancel
                        </x-buttons.secondary>

                        <x-buttons.danger type="submit">
                            {{ $buttonText }}
                        </x-buttons.danger>
                    </div>
                </form>
            </div>
        </div>
    </template>
</div>
