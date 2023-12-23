<x-section class="space-y-8">
    <div class="grid gap-8 lg:grid-cols-4">
        <div class="grid grid-cols-2 gap-4 lg:col-span-3 lg:grid-cols-4 xl:grid-cols-6">
            {{-- Filter --}}
            <div class="col-span-1">
                <x-threads.filter wire:model.live="filter" />
            </div>

            {{-- Channel Select --}}
            <div class="col-span-1">
                <livewire:channel-filter />
            </div>

            {{-- Search --}}
            <div class="col-span-1 xl:col-span-3">
                <x-threads.search />
            </div>

            {{-- Create thread --}}
            <div class="col-span-1 flex items-center">
                <x-buttons.primary class="w-full text-center" href="{{ route('threads.create') }}" wire:navigate>
                    {{ __('Create Thread') }}
                </x-buttons.primary>
            </div>
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

        {{-- Top Users --}}
        <div class="space-y-8 lg:col-span-1">
            <x-top-users />
        </div>
    </div>
</x-section>
