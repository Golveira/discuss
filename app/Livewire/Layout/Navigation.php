<?php

namespace App\Livewire\Layout;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Livewire\Actions\Logout;
use App\Providers\RouteServiceProvider;

class Navigation extends Component
{
    #[On('avatar-updated')]
    public function updatedAvatar(): void
    {
    }

    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect(RouteServiceProvider::HOME, navigate: true);
    }

    public function render()
    {
        return view('livewire.layout.navigation');
    }
}
