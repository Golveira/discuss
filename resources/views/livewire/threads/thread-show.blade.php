<x-section class="space-y-6">
    {{-- Thread header --}}
    <x-threads.header :$thread />

    <div class="grid gap-8 lg:grid-cols-4">
        <div class="space-y-6 lg:col-span-3">
            {{-- Thread content --}}
            <x-threads.content :$thread />

            {{-- Replies list --}}
            <livewire:replies.replies-list :$thread />
        </div>

        <div class="space-y-4 pt-4 lg:col-span-1">
            {{-- Thread category --}}
            <x-threads.category :$thread />

            {{-- Thread participants --}}
            <x-threads.participants :$thread />

            {{-- Subscribe button --}}
            <x-threads.subscribe :$thread />

            {{-- Admin actions --}}
            <x-threads.admin-actions :$thread />
        </div>
    </div>
</x-section>
