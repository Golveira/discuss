<x-section class="space-y-6" maxWidth="lg">
    <div class="flex justify-between text-gray-900 dark:text-gray-200">
        <div class="flex items-center">
            <h2 class="text-2xl">
                {{ __('Notifications') }}
            </h2>

            <span
                class="ms-2 inline-flex h-5 w-5 items-center justify-center rounded-full bg-blue-200 text-xs font-semibold text-blue-800">
                {{ $this->notifications->count() }}
            </span>
        </div>

        <button
            class="text-sm font-semibold text-gray-600 hover:text-gray-800 dark:text-gray-300 dark:hover:text-gray-200"
            wire:click="markAllAsRead">
            {{ __('Mark all as read') }}
        </button>
    </div>

    @empty($this->notifications->count())
        <x-alert type="primary" message="You have no unread notifications" />
    @else
        <x-list>
            @foreach ($this->notifications as $notification)
                <x-list-item>
                    <x-slot name="avatar">
                        <x-avatar image="{{ $notification->data['avatar'] }}"
                            placeholder="{{ $notification->data['placeholder'] }}" />
                    </x-slot>

                    <x-slot name="value">
                        <x-links.default href="{{ $notification->data['link'] }}" wire:navigate>
                            {{ $notification->data['message'] }}
                        </x-links.default>
                    </x-slot>

                    <x-slot name="subvalue">
                        {{ $notification->created_at->diffForHumans() }}
                    </x-slot>
                </x-list-item>
            @endforeach
        </x-list>

        {{ $this->notifications->links() }}
    @endempty
</x-section>
