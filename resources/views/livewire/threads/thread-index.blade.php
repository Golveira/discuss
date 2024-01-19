<x-section class="space-y-8">
    {{-- Pinned threads --}}
    <x-threads.pinned-threads-list :threads="$this->pinnedThreads" />

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
            <x-categories.categories-list />

            {{-- Most helpful users --}}
            <x-users.most-helpful-users />
        </div>

        <div class="space-y-4 lg:col-span-3">
            {{-- Current category info --}}
            @if (isset($category))
                <x-categories.category-info :$category hasDescription />
            @endif

            {{-- Thread List --}}
            <x-lists.list>
                @foreach ($this->threads as $thread)
                    <x-threads.item :$thread wire:key="{{ $thread->id }}" />
                @endforeach
            </x-lists.list>

            {{-- Pagination --}}
            {{ $this->threads->links() }}
        </div>
    </div>
</x-section>
