<x-section class="space-y-6" maxWidth="lg">
    <div class="flex justify-between text-gray-900 dark:text-gray-200">
        <div class="flex items-center">
            <h2 class="text-2xl">
                Notifications
            </h2>

            <span
                class="ms-2 inline-flex h-5 w-5 items-center justify-center rounded-full bg-blue-200 text-xs font-semibold text-blue-800">
                {{ $this->notifications->count() }}
            </span>
        </div>

        <x-buttons.transparent class="font-bold" wire:click="markAllAsRead">
            Mark all as read
        </x-buttons.transparent>
    </div>

    @empty($this->notifications->count())
        <x-alert type="primary" message="You have no unread notifications" />
    @else
        <x-lists.list>
            @foreach ($this->notifications as $notification)
                <x-lists.list-item>
                    <x-slot name="value">
                        {{ $notification->data['message'] }}

                        <x-links.primary href="{{ $notification->data['link'] }}">
                            "{{ $notification->data['title'] }}"
                        </x-links.primary>
                    </x-slot>

                    <x-slot name="subvalue">
                        {{ $notification->created_at->diffForHumans() }}
                    </x-slot>

                    <x-slot name="actions">
                        <x-buttons.transparent wire:click="markAsRead('{{ $notification->id }}')">
                            <x-icons.check />
                        </x-buttons.transparent>
                    </x-slot>
                </x-lists.list-item>
            @endforeach
        </x-lists.list>

        {{ $this->notifications->links() }}
    @endempty
</x-section>
