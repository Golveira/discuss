<x-section class="space-y-8">
    <div class="grid grid-cols-2 gap-4 lg:grid-cols-4 xl:grid-cols-6">
        <div class="col-span-1 xl:col-span-3">
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
                {{ __('Create Thread') }}
            </x-buttons.primary>
        </div>
    </div>

    <div class="grid gap-8 lg:grid-cols-4">
        <div class="space-y-8 lg:col-span-1">
            {{-- Channels --}}
            <x-channels-list />

            {{-- Leaderboard --}}
            <x-top-users />
        </div>

        <div class="lg:col-span-3">
            {{-- Thread List --}}
            <x-list>
                @foreach ($this->threads as $thread)
                    <x-threads.item :$thread />
                @endforeach
            </x-list>

            {{-- Pagination --}}
            <div class="mt-6">
                {{ $this->threads->links() }}
            </div>
        </div>
    </div>
</x-section>
