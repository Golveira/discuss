<?php

namespace App\Livewire\Pages;

use Illuminate\Contracts\View\View;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Notifications')]
class NotificationsIndex extends Component
{
    use WithPagination;

    #[Computed]
    public function notifications(): LengthAwarePaginator
    {
        return Auth::user()->unreadNotifications()->paginate();
    }

    public function markAllAsRead(): void
    {
        Auth::user()->unreadNotifications->each->markAsRead();

        $this->resetPage();

        $this->dispatch('notifications-read');
    }

    public function markAsRead(string $notificationId): void
    {
        $notification = DatabaseNotification::findOrFail($notificationId);

        $this->authorize('markAsRead', $notification);

        $notification->markAsRead();

        $this->resetPage();

        $this->dispatch('notifications-read');
    }

    public function render(): View
    {
        return view('livewire.pages.notifications-index');
    }
}
