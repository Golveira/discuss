<x-section class="space-y-4" maxWidth="lg">
    <div class="grid gap-6 md:grid-cols-3">
        <div class="space-y-3 md:col-span-1">
            {{-- Avatar --}}
            <x-avatar :image="$user->avatar_path" width="xl" />

            <div class="flex flex-col">
                {{-- Name --}}
                <div class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                    {{ $user->name }}
                </div>

                {{-- Username --}}
                <div class="mb-3 text-lg text-gray-700 dark:text-gray-400">
                    @<span>{{ $user->username }}</span>
                </div>

                {{-- Edit profile --}}
                @can('update', $user)
                    <x-buttons.secondary class="w-full text-center" href="{{ route('settings') }}">
                        Edit profile
                    </x-buttons.secondary>
                @endcan
            </div>

            {{-- Ban button --}}
            @can('ban', $user)
                <x-profile.ban-button :user="$user" />
            @endcan
        </div>

        <div class="md:col-span-2">
            {{-- Tabs --}}
            <div class="space-y-8">
                <x-profile.tabs :$selectedTab />

                <div class="space-y-8">
                    @if ($selectedTab === 'threads')
                        @forelse ($this->threads as $thread)
                            <x-profile.thread-card :$thread />
                        @empty
                            <x-alert type="primary" message="No threads yet." />
                        @endforelse

                        {{ $this->threads->links() }}
                    @endif

                    @if ($selectedTab === 'replies')
                        @forelse ($this->replies as $reply)
                            <x-profile.reply-card :$reply />
                        @empty
                            <x-alert type="primary" message="No replies yet." />
                        @endforelse

                        {{ $this->replies->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-section>
