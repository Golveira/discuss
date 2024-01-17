<x-section class="space-y-8">
    <div class="grid grid-cols-2 gap-4 lg:grid-cols-4 xl:grid-cols-7">
        <div class="col-span-1 xl:col-span-4">
            {{-- Search --}}
            <x-threads.search />
        </div>

        <div class="col-span-1">
            {{-- Sort --}}
            <x-threads.sort wire:model.live="sort" />
        </div>

        <div class="col-span-1">
            {{-- Filter --}}
            <x-threads.filter wire:model.live="filter" />
        </div>

        <div class="col-span-1 flex items-center">
            {{-- Create Thread --}}
            <x-buttons.primary class="w-full text-center" href="{{ route('threads.create') }}" wire:navigate>
                {{ __('New Discussion') }}
            </x-buttons.primary>
        </div>
    </div>

    <div class="grid gap-8 lg:grid-cols-4">
        <div class="space-y-6 lg:col-span-1">
            {{-- Categories List --}}
            <x-channels-list />

            {{-- Most Helpful --}}
            <x-top-users />
        </div>

        <div class="space-y-4 lg:col-span-3">
            {{-- Current channel --}}
            <div class="font-bold text-gray-900 dark:text-white">
                {{ $channel->emoji }} {{ $channel->name }}
            </div>

            <span class="text-sm text-gray-600 dark:text-gray-400">
                {{ $channel->description }}
            </span>

            {{-- Thread List --}}
            <x-list>
                @foreach ($this->threads as $thread)
                    <x-threads.item :$thread wire:key="{{ $thread->id }}" />
                @endforeach
            </x-list>

            {{-- Pagination --}}
            {{ $this->threads->links() }}
        </div>
    </div>
</x-section>
