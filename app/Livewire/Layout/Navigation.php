<?php

namespace App\Livewire\Layout;

use App\Livewire\Actions\Logout;
use App\Providers\RouteServiceProvider;
use Livewire\Attributes\On;
use Livewire\Component;

class Navigation extends Component
{
    #[On('avatar-updated')]
    public function updateNavbar(): void
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
