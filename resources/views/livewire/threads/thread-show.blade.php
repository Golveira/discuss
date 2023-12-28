<x-section>
    <div class="grid gap-8 lg:grid-cols-4">
        <div class="space-y-8 lg:col-span-3">
            {{-- Thread Content --}}
            <x-threads.card :$thread />

            {{-- Replies List --}}
            <livewire:replies.replies-list :$thread />
        </div>

        <div class="space-y-8 lg:col-span-1">
            {{-- User --}}
            <x-user.user-card :user="$thread->author" />

            @auth
                {{-- Subscribe --}}
                <x-threads.subscribe :$thread />
            @endauth
        </div>
    </div>
</x-section>
