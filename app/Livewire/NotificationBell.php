<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class NotificationBell extends Component
{
    #[On('notifications-read')]
    public function updateNotificationsCount(): void
    {
    }

    #[Computed()]
    public function notificationsCount(): int
    {
        return Auth::user()->unreadNotifications()->count();
    }

    public function render()
    {
        return view('livewire.notification-bell');
    }
}
