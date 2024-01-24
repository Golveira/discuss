<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class UploadAvatar extends Component
{
    use WithFileUploads;

    #[Validate('required|image|max:2048')]
    public $avatar;

    public function updatedAvatar(): void
    {
        $this->validate();

        $user = Auth::user();

        $user->avatar_path = $this->avatar->store('avatars', 'public');

        $user->save();

        $this->dispatch('avatar-updated');
    }

    public function render(): View
    {
        return view('livewire.upload-avatar');
    }
}
