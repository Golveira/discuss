@props(['title'])

<div class="relative z-50 h-auto w-auto" x-data="{ modalOpen: false }" @keydown.escape.window="modalOpen = false">
    <div @click="modalOpen=true">
        {{ $trigger }}
    </div>

    @teleport('body')
        <div class="fixed left-0 top-0 z-[99] flex h-screen w-screen items-center justify-center" x-show="modalOpen" x-cloak>
            <div class="absolute inset-0 h-full w-full bg-black bg-opacity-40" x-show="modalOpen"
                x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-300"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="modalOpen=false">
            </div>

            <div class="relative w-full bg-white px-7 py-6 shadow dark:bg-gray-700 sm:max-w-lg sm:rounded-lg"
                x-show="modalOpen" x-trap.inert.noscroll="modalOpen" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                <button
                    class="absolute end-2.5 top-3 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white"
                    type="button" @click="modalOpen=false">
                    <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>

                <div class="p-4 text-center md:p-5">
                    <svg class="mx-auto mb-4 h-12 w-12 text-gray-400 dark:text-gray-200" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>

                    <h3 class="mb-5 text-lg font-normal text-gray-600 dark:text-gray-300">
                        {{ $title ?? $slot }}
                    </h3>

                    <div class="flex justify-center gap-3">
                        {{ $actions }}
                    </div>
                </div>
            </div>
        </div>
    @endteleport
</div>
