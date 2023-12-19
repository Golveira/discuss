<?php

namespace App\Livewire\Settings;

use Livewire\Component;
use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Usernotnull\Toast\Concerns\WireToast;

class DeleteAccount extends Component
{
    use WireToast;

    public function deleteUser(Logout $logout): void
    {
        tap(Auth::user(), $logout(...))->delete();

        toast()->success('Your account has been deleted.')->pushOnNextPage();

        $this->redirect('/', navigate: true);
    }

    public function render()
    {
        return view('livewire.settings.delete-user');
    }
}
