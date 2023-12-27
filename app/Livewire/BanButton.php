<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

class BanButton extends Component
{
    use WireToast;

    public User $user;

    public function ban()
    {
        $this->authorize('ban', $this->user);

        $this->user->update(['banned_at' => now()]);

        toast()->success('User has been banned!')->push();
    }

    public function unban()
    {
        $this->authorize('ban', $this->user);

        $this->user->update(['banned_at' => null]);

        toast()->success('User has been unbanned!')->push();
    }

    public function render()
    {
        return view('livewire.ban-button');
    }
}
