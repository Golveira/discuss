<x-section class="space-y-4" maxWidth="lg">
    <x-card>
        <div class="relative flex items-center gap-3">
            {{-- Avatar --}}
            <x-avatar :image="$user->avatar_path" width="xl" />

            <div class="flex flex-col gap-2">
                {{-- Username --}}
                <span class="text-3xl font-bold text-gray-900 dark:text-gray-400">
                    {{ $user->username }}
                </span>

                {{-- Joined Date --}}
                <span class="text-sm font-medium text-gray-900 dark:text-gray-400">
                    {{ __('Joined') }} {{ $user->joined_date }}
                </span>
            </div>

            {{-- Actions --}}
            @can('ban', $user)
                <div class="absolute right-0 top-0">
                    <livewire:ban-button :user="$user" />
                </div>
            @endcan
        </div>
    </x-card>

    {{-- Tabs --}}
    <div class="space-y-8">
        <x-profile.tabs :$selectedTab />

        <div class="space-y-8">
            @if ($selectedTab === 'threads')
                @forelse ($this->threads as $thread)
                    <x-profile.thread-card :$thread />
                @empty
                    <x-alert type="primary" message="No threads found." />
                @endforelse

                {{ $this->threads->links() }}
            @endif

            @if ($selectedTab === 'replies')
                @forelse ($this->replies as $reply)
                    <x-profile.reply-card :$reply />
                @empty
                    <x-alert type="primary" message="No replies found." />
                @endforelse

                {{ $this->replies->links() }}
            @endif
        </div>
    </div>
</x-section>
