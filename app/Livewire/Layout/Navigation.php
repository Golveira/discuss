<?php

namespace App\Livewire\Layout;

use Livewire\Component;
use App\Livewire\Actions\Logout;
use App\Providers\RouteServiceProvider;

class Navigation extends Component
{
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
