<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Livewire\Attributes\Computed;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

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

        $this->dispatch('notifications-read');
    }

    public function render(): View
    {
        return view('livewire.pages.notifications-index');
    }
}
