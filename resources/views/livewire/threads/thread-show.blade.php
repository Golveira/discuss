<x-section class="space-y-6">
    <x-threads.header :$thread />

    <div class="grid gap-8 lg:grid-cols-4">
        <div class="space-y-6 lg:col-span-3">
            <x-threads.content :$thread />

            <livewire:replies.replies-list :$thread />
        </div>

        <div class="space-y-4 pt-4 lg:col-span-1">
            <x-threads.category :$thread />

            <x-threads.participants :$thread />

            <x-threads.subscribe :$thread />

            <x-threads.admin-actions :$thread />
        </div>
    </div>
</x-section>
