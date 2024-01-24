<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

#[Title('Notifications')]
class NotificationsIndex extends Component
{
    use WithPagination;

    #[Computed]
    public function notifications(): LengthAwarePaginator
    {
        return Auth::user()->unreadNotifications()->paginate(2);
    }

    public function markAllAsRead(): void
    {
        Auth::user()->unreadNotifications->each->markAsRead();

        $this->resetPage();

        $this->dispatch('notifications-read');
    }

    public function markAsRead(string $notificationId): void
    {
        Auth::user()->unreadNotifications
            ->where('id', $notificationId)
            ->markAsRead();

        $this->resetPage();

        $this->dispatch('notifications-read');
    }

    public function render(): View
    {
        return view('livewire.pages.notifications-index');
    }
}