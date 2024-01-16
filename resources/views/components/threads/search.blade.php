<div class="w-full">
    <label class="sr-only mb-2 text-sm font-medium text-gray-900 dark:text-white" for="default-search">
        {{ __('Search') }}
    </label>

    <div class="relative">
        <div class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3">
            <x-icons.search />
        </div>

        <form wire:submit="search">
            <x-forms.input class="block w-full ps-10" for="default-search" type="search"
                placeholder="Search all discussions" wire:model="query" />
        </form>
    </div>
</div>
